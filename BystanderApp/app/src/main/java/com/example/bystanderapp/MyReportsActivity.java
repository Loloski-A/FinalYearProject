package com.example.bystanderapp;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class MyReportsActivity extends AppCompatActivity {

    private ListView reportsListView;
    private TextView noReportsText;
    private ProgressBar progressBar;
    private Button backToMainButton;
    private ReportAdapter adapter;
    private ArrayList<Incident> incidentsList = new ArrayList<>();

    private static final String MY_REPORTS_URL = "http://10.0.2.2:8000/api/bystander/my-reports";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_reports);

        reportsListView = findViewById(R.id.reportsListView);
        noReportsText = findViewById(R.id.noReportsText);
        backToMainButton = findViewById(R.id.backToMainButton);
        // Add a ProgressBar with id 'progressBar' to your XML for this to work
        // progressBar = findViewById(R.id.progressBar);

        adapter = new ReportAdapter(this, incidentsList);
        reportsListView.setAdapter(adapter);

        backToMainButton.setOnClickListener(v -> finish());

        reportsListView.setOnItemClickListener((parent, view, position, id) -> {
            Incident selectedIncident = incidentsList.get(position);
            showReportDetailsDialog(selectedIncident);
        });

        fetchMyReports();
    }

    private void showReportDetailsDialog(Incident incident) {
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_report_details, null);

        TextView title = dialogView.findViewById(R.id.dialogReportTitle);
        TextView type = dialogView.findViewById(R.id.dialogReportType);
        TextView status = dialogView.findViewById(R.id.dialogReportStatus);
        TextView severity = dialogView.findViewById(R.id.dialogReportSeverity);
        TextView location = dialogView.findViewById(R.id.dialogReportLocation);
        TextView date = dialogView.findViewById(R.id.dialogReportDate);
        TextView description = dialogView.findViewById(R.id.dialogReportDescription);

        title.setText(incident.getIncidentType());
        type.setText("Type: " + incident.getIncidentType());
        status.setText(incident.getFullStatus());
        severity.setText(incident.getSeverity());
        location.setText(incident.getLocationName());
        date.setText(incident.getFullReportedAt());
        description.setText(incident.getDescription());

        new AlertDialog.Builder(this)
                .setView(dialogView)
                .setPositiveButton("Close", null)
                .show();
    }

    private void fetchMyReports() {
        // showProgressBar(true);
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication error. Please log in again.", Toast.LENGTH_LONG).show();
            startActivity(new Intent(this, LoginActivity.class));
            finish();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, MY_REPORTS_URL,
                response -> {
                    // showProgressBar(false);
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray reportsArray = jsonObject.getJSONArray("reports");
                        incidentsList.clear();

                        if (reportsArray.length() == 0) {
                            reportsListView.setVisibility(View.GONE);
                            noReportsText.setVisibility(View.VISIBLE);
                        } else {
                            for (int i = 0; i < reportsArray.length(); i++) {
                                JSONObject reportObject = reportsArray.getJSONObject(i);
                                String type = reportObject.getString("incident_type");
                                String status = reportObject.getString("status");
                                String date = reportObject.getString("reported_at");
                                String locationName = reportObject.optString("location_name", "N/A");
                                String desc = reportObject.getString("description");
                                String sev = reportObject.getString("severity");

                                incidentsList.add(new Incident(type, status, date, locationName, desc, sev));
                            }
                            adapter.notifyDataSetChanged();
                            reportsListView.setVisibility(View.VISIBLE);
                            noReportsText.setVisibility(View.GONE);
                        }
                    } catch (Exception e) {
                        e.printStackTrace();
                        Toast.makeText(this, "Failed to parse reports.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    // showProgressBar(false);
                    String errorMessage = "Failed to fetch reports. Please try again.";
                    if (error.networkResponse != null && error.networkResponse.data != null) {
                        try {
                            String body = new String(error.networkResponse.data, StandardCharsets.UTF_8);
                            JSONObject jsonObject = new JSONObject(body);
                            if (jsonObject.has("message")) {
                                errorMessage = jsonObject.getString("message");
                            }
                        } catch (Exception e) {
                            // Parsing error
                        }
                    }
                    Toast.makeText(this, errorMessage, Toast.LENGTH_LONG).show();
                }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                headers.put("Authorization", "Bearer " + token);
                headers.put("Accept", "application/json");
                return headers;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void showProgressBar(boolean show) {
        if (progressBar != null) {
            progressBar.setVisibility(show ? View.VISIBLE : View.GONE);
        }
    }
}
