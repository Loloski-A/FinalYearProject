package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
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
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class MainActivity extends AppCompatActivity {

    private ListView recentIncidentsListView;
    private TextView noRecentIncidentsText;
    private TextView welcomeText; // Added TextView for the welcome message
    private IncidentMainAdapter adapter;
    private ArrayList<Incident> recentIncidentsList = new ArrayList<>();

    private static final String LOGOUT_URL = "http://10.0.2.2:8000/api/logout";
    private static final String ALL_INCIDENTS_URL = "http://10.0.2.2:8000/api/bystander/all-incidents";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Initialize UI
        recentIncidentsListView = findViewById(R.id.recentIncidentsListView);
        noRecentIncidentsText = findViewById(R.id.noRecentIncidentsText);
        welcomeText = findViewById(R.id.welcomeText); // Initialize the welcome TextView
        setupFeatureButtons();

        // --- UPDATED: Set the welcome message ---
        setWelcomeMessage();

        // Setup adapter for the incident list
        adapter = new IncidentMainAdapter(this, recentIncidentsList);
        recentIncidentsListView.setAdapter(adapter);

        // Fetch recent incidents from the server
        fetchRecentIncidents();
    }

    private void setWelcomeMessage() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        String userName = sharedPreferences.getString(LoginActivity.USER_NAME_KEY, "Bystander"); // Default to "Bystander" if name not found
        welcomeText.setText("Welcome, " + userName + "!");
    }

    private void setupFeatureButtons() {
        Button reportIncidentButton = findViewById(R.id.reportIncidentButton);
        Button myReportsButton = findViewById(R.id.myReportsButton);
        Button notificationsButton = findViewById(R.id.notificationsButton);
        Button mapButton = findViewById(R.id.mapButton);
        Button firstAidButton = findViewById(R.id.firstAidButton);
        Button logoutButton = findViewById(R.id.logoutButton);

        reportIncidentButton.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, ReportIncidentActivity.class)));
        myReportsButton.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, MyReportsActivity.class)));
        notificationsButton.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, NotificationsActivity.class)));
        mapButton.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, MapActivity.class)));
        firstAidButton.setOnClickListener(v -> startActivity(new Intent(MainActivity.this, FirstAidActivity.class)));
        logoutButton.setOnClickListener(v -> logoutUser());
    }

    private void fetchRecentIncidents() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            // Handle not logged in state
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, ALL_INCIDENTS_URL,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray incidentsArray = jsonObject.getJSONArray("incidents");
                        recentIncidentsList.clear();

                        if (incidentsArray.length() == 0) {
                            recentIncidentsListView.setVisibility(View.GONE);
                            noRecentIncidentsText.setVisibility(View.VISIBLE);
                        } else {
                            for (int i = 0; i < incidentsArray.length(); i++) {
                                JSONObject incidentObject = incidentsArray.getJSONObject(i);
                                String type = incidentObject.getString("incident_type");
                                String status = incidentObject.getString("status");
                                String locationName = incidentObject.optString("location_name", "N/A");
                                String reportedAt = incidentObject.getString("reported_at");
                                String description = incidentObject.getString("description");
                                String severity = incidentObject.getString("severity");

                                recentIncidentsList.add(new Incident(type, status, reportedAt, locationName, description, severity));
                            }
                            adapter.notifyDataSetChanged();
                            recentIncidentsListView.setVisibility(View.VISIBLE);
                            noRecentIncidentsText.setVisibility(View.GONE);
                        }
                    } catch (Exception e) {
                        e.printStackTrace();
                    }
                },
                error -> {
                    Toast.makeText(this, "Failed to load recent incidents.", Toast.LENGTH_SHORT).show();
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

    private void logoutUser() {
        performLogoutRequest();
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.remove(LoginActivity.AUTH_TOKEN_KEY);
        editor.remove(LoginActivity.USER_NAME_KEY); // Also remove the user's name on logout
        editor.apply();
        Toast.makeText(this, "Logged out successfully", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(MainActivity.this, LoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    private void performLogoutRequest() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);
        if (token == null) return;

        StringRequest stringRequest = new StringRequest(Request.Method.POST, LOGOUT_URL,
                response -> {},
                error -> {}) {
            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                headers.put("Authorization", "Bearer " + token);
                return headers;
            }
        };
        Volley.newRequestQueue(this).add(stringRequest);
    }
}
