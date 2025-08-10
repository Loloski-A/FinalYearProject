package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import androidx.cardview.widget.CardView;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    private TextView welcomeText, noRecentIncidentsText;
    private Button logoutButton;
    private CardView cardReportIncident, cardMyReports, cardNotifications, cardViewMap, cardFirstAid;
    private ListView recentIncidentsListView;
    private IncidentMainAdapter adapter;
    private ArrayList<Incident> recentIncidentsList = new ArrayList<>();

    private static final String LOGOUT_URL = "http://10.0.2.2:8000/api/logout";
    private static final String ALL_INCIDENTS_URL = "http://10.0.2.2:8000/api/bystander/all-incidents";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        initViews();
        setupWelcomeMessage();
        setupListeners();
        fetchRecentIncidents();
    }

    private void initViews() {
        welcomeText = findViewById(R.id.welcomeText);
        logoutButton = findViewById(R.id.logoutButton);
        cardReportIncident = findViewById(R.id.card_report_incident);
        cardMyReports = findViewById(R.id.card_my_reports);
        cardNotifications = findViewById(R.id.card_notifications);
        cardViewMap = findViewById(R.id.card_view_map);
        cardFirstAid = findViewById(R.id.card_first_aid);
        recentIncidentsListView = findViewById(R.id.recentIncidentsListView);
        noRecentIncidentsText = findViewById(R.id.noRecentIncidentsText);

        adapter = new IncidentMainAdapter(this, recentIncidentsList);
        recentIncidentsListView.setAdapter(adapter);
    }

    private void setupWelcomeMessage() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        String userName = sharedPreferences.getString(LoginActivity.USER_NAME_KEY, "Bystander");
        welcomeText.setText("Welcome, " + userName + "!");
    }

    private void setupListeners() {
        cardReportIncident.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, ReportIncidentActivity.class)));
        cardMyReports.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, MyReportsActivity.class)));
        cardNotifications.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, NotificationsActivity.class)));
        cardViewMap.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, MapActivity.class)));
        cardFirstAid.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, FirstAidActivity.class)));
        logoutButton.setOnClickListener(v -> logout());
    }

    private void fetchRecentIncidents() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);
        if (token == null) return;

        StringRequest stringRequest = new StringRequest(Request.Method.GET, ALL_INCIDENTS_URL,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray incidentsArray = jsonObject.getJSONArray("incidents");
                        recentIncidentsList.clear();

                        if (incidentsArray.length() == 0) {
                            noRecentIncidentsText.setVisibility(View.VISIBLE);
                            recentIncidentsListView.setVisibility(View.GONE);
                        } else {
                            for (int i = 0; i < incidentsArray.length(); i++) {
                                JSONObject incidentObj = incidentsArray.getJSONObject(i);
                                recentIncidentsList.add(new Incident(
                                        incidentObj.getString("incident_type"),
                                        incidentObj.getString("status"),
                                        incidentObj.getString("reported_at"),
                                        incidentObj.optString("location_name", "N/A"),
                                        incidentObj.getString("description"),
                                        incidentObj.getString("severity")
                                ));
                            }
                            adapter.notifyDataSetChanged();
                            noRecentIncidentsText.setVisibility(View.GONE);
                            recentIncidentsListView.setVisibility(View.VISIBLE);
                        }
                    } catch (Exception e) {
                        Toast.makeText(this, "Error parsing recent incidents.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> Toast.makeText(this, "Failed to fetch recent incidents.", Toast.LENGTH_SHORT).show()) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                headers.put("Authorization", "Bearer " + token);
                return headers;
            }
        };
        Volley.newRequestQueue(this).add(stringRequest);
    }

    private void logout() {
        // Make the API call to invalidate the token on the server
        performLogoutRequest();

        // Clear local data and navigate to the login screen
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear().apply(); // Clears all data from shared preferences

        Toast.makeText(this, "Logged out successfully", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(MainActivity.this, LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    private void performLogoutRequest() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) return; // No token, no need to call the server

        StringRequest stringRequest = new StringRequest(Request.Method.POST, LOGOUT_URL,
                response -> {
                    // Token successfully invalidated on the server
                },
                error -> {
                    // An error occurred, but we will still log the user out locally
                }) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                headers.put("Authorization", "Bearer " + token);
                headers.put("Accept", "application/json");
                return headers;
            }
        };
        Volley.newRequestQueue(this).add(stringRequest);
    }
}
