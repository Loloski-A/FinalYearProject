package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.HashMap;
import java.util.Map;

public class TeamIncidentDetailActivity extends AppCompatActivity {

    private TextView detailIncidentId, detailIncidentType, detailIncidentLocation,
            detailIncidentDescription, detailIncidentReporter, detailIncidentTime,
            detailIncidentStatus;
    private Button markEnRouteButton, markResolvedButton, viewOnMapButton, backFromDetailButton;
    private Incident incident;

    private static final String UPDATE_STATUS_URL = "http://10.0.2.2:8000/api/team/incident/";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_incident_detail);

        initViews();

        incident = (Incident) getIntent().getSerializableExtra("incident");

        if (incident != null) {
            populateIncidentDetails();
        } else {
            Toast.makeText(this, "Could not load incident details.", Toast.LENGTH_SHORT).show();
            finish();
        }

        setupButtonListeners();
    }

    private void initViews() {
        detailIncidentId = findViewById(R.id.detailIncidentId);
        detailIncidentType = findViewById(R.id.detailIncidentType);
        detailIncidentLocation = findViewById(R.id.detailIncidentLocation);
        detailIncidentDescription = findViewById(R.id.detailIncidentDescription);
        detailIncidentReporter = findViewById(R.id.detailIncidentReporter);
        detailIncidentTime = findViewById(R.id.detailIncidentTime);
        detailIncidentStatus = findViewById(R.id.detailIncidentStatus);

        markEnRouteButton = findViewById(R.id.markEnRouteButton);
        markResolvedButton = findViewById(R.id.markResolvedButton);
        viewOnMapButton = findViewById(R.id.viewOnMapButton);
        backFromDetailButton = findViewById(R.id.backFromDetailButton);
    }

    private void populateIncidentDetails() {
        detailIncidentId.setText("#INC" + incident.getId());
        detailIncidentType.setText(incident.getIncidentType());
        detailIncidentLocation.setText(incident.getLocationName());
        detailIncidentDescription.setText(incident.getDescription());
        detailIncidentReporter.setText(incident.getReporterName()); // UPDATED: Set the reporter's name
        detailIncidentTime.setText(incident.getReportedAt());
        updateStatusUI(incident.getStatus());
    }

    // ... setupButtonListeners and other methods remain the same ...
    private void setupButtonListeners() {
        markEnRouteButton.setOnClickListener(v -> updateIncidentStatus("En Route"));
        markResolvedButton.setOnClickListener(v -> updateIncidentStatus("Resolved"));

        viewOnMapButton.setOnClickListener(v -> {
            Intent mapIntent = new Intent(TeamIncidentDetailActivity.this, TeamMapActivity.class);
            mapIntent.putExtra("incident_lat", incident.getLatitude());
            mapIntent.putExtra("incident_lng", incident.getLongitude());
            mapIntent.putExtra("incident_location_name", incident.getLocationName());
            startActivity(mapIntent);
        });

        backFromDetailButton.setOnClickListener(v -> finish());
    }

    private void updateIncidentStatus(String newStatus) {
        SharedPreferences sharedPreferences = getSharedPreferences(TeamLoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(TeamLoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication error.", Toast.LENGTH_SHORT).show();
            return;
        }

        String url = UPDATE_STATUS_URL + incident.getId() + "/update-status";

        StringRequest stringRequest = new StringRequest(Request.Method.POST, url,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        Toast.makeText(this, jsonObject.getString("message"), Toast.LENGTH_SHORT).show();
                        updateStatusUI(newStatus);
                    } catch (Exception e) {
                        Toast.makeText(this, "Status updated, but response could not be parsed.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    String errorMessage = "Failed to update status.";
                    if (error.networkResponse != null && error.networkResponse.data != null) {
                        try {
                            String body = new String(error.networkResponse.data, StandardCharsets.UTF_8);
                            errorMessage = new JSONObject(body).getString("message");
                        } catch (Exception e) {}
                    }
                    Toast.makeText(this, errorMessage, Toast.LENGTH_LONG).show();
                }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("status", newStatus);
                return params;
            }

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

    private void updateStatusUI(String status) {
        detailIncidentStatus.setText(status);
        switch (status) {
            case "En Route":
                detailIncidentStatus.setTextColor(ContextCompat.getColor(this, android.R.color.holo_orange_dark));
                break;
            case "Resolved":
                detailIncidentStatus.setTextColor(ContextCompat.getColor(this, android.R.color.holo_green_dark));
                break;
            default:
                detailIncidentStatus.setTextColor(ContextCompat.getColor(this, R.color.colorPrimary));
                break;
        }
    }
}
