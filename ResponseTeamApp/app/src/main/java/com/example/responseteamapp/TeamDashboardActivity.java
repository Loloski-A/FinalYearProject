package com.example.responseteamapp;

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
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class TeamDashboardActivity extends AppCompatActivity {
    private ListView assignedIncidentsListView;
    private TextView noAssignedIncidentsText;
    private IncidentAdapter adapter;
    private ArrayList<Incident> incidentsList = new ArrayList<>();
    private Button logoutButton;
    private CardView cardViewProfile, cardNotifications;

    private static final String INCIDENTS_URL = "http://10.0.2.2:8000/api/team/dashboard/incidents";
    private static final String LOGOUT_URL = "http://10.0.2.2:8000/api/logout";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_dashboard);

        initViews();
        setupListeners();
        fetchAssignedIncidents();
    }

    private void initViews() {
        assignedIncidentsListView = findViewById(R.id.assignedIncidentsListView);
        noAssignedIncidentsText = findViewById(R.id.noAssignedIncidentsText);
        logoutButton = findViewById(R.id.logoutButton);
        cardViewProfile = findViewById(R.id.card_view_profile);
        cardNotifications = findViewById(R.id.card_notifications);

        adapter = new IncidentAdapter(this, incidentsList);
        assignedIncidentsListView.setAdapter(adapter);
    }

    private void setupListeners() {
        assignedIncidentsListView.setOnItemClickListener((parent, view, position, id) -> {
            Incident selectedIncident = incidentsList.get(position);
            Intent intent = new Intent(this, TeamIncidentDetailActivity.class);
            intent.putExtra("incident", selectedIncident);
            startActivity(intent);
        });

        cardViewProfile.setOnClickListener(v -> startActivity(new Intent(this, TeamProfileActivity.class)));
        cardNotifications.setOnClickListener(v -> startActivity(new Intent(this, TeamNotificationsActivity.class)));
        logoutButton.setOnClickListener(v -> logout());
    }

    @Override
    protected void onResume() {
        super.onResume();
        fetchAssignedIncidents();
    }

    private void fetchAssignedIncidents() {
        SharedPreferences sharedPreferences = getSharedPreferences(TeamLoginActivity.SHARED_PREFS, MODE_PRIVATE);
        String token = sharedPreferences.getString(TeamLoginActivity.AUTH_TOKEN_KEY, null);

        StringRequest stringRequest = new StringRequest(Request.Method.GET, INCIDENTS_URL,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray incidentsArray = jsonObject.getJSONArray("incidents");
                        incidentsList.clear();

                        if (incidentsArray.length() == 0) {
                            noAssignedIncidentsText.setVisibility(View.VISIBLE);
                            assignedIncidentsListView.setVisibility(View.GONE);
                        } else {
                            for (int i = 0; i < incidentsArray.length(); i++) {
                                JSONObject incidentObj = incidentsArray.getJSONObject(i);
                                String reporterName = "Unknown";
                                if (incidentObj.has("reporter") && !incidentObj.isNull("reporter")) {
                                    reporterName = incidentObj.getJSONObject("reporter").getString("name");
                                }
                                incidentsList.add(new Incident(
                                        incidentObj.getInt("id"),
                                        incidentObj.getString("incident_type"),
                                        incidentObj.getString("status"),
                                        incidentObj.getString("description"),
                                        incidentObj.optString("location_name", "N/A"),
                                        incidentObj.getDouble("latitude"),
                                        incidentObj.getDouble("longitude"),
                                        incidentObj.getString("reported_at"),
                                        reporterName
                                ));
                            }
                            adapter.notifyDataSetChanged();
                            noAssignedIncidentsText.setVisibility(View.GONE);
                            assignedIncidentsListView.setVisibility(View.VISIBLE);
                        }
                    } catch (Exception e) {
                        Toast.makeText(this, "Error parsing incidents.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> Toast.makeText(this, "Failed to fetch incidents.", Toast.LENGTH_SHORT).show()) {
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

    private void logout() {
        // First, make the API call to invalidate the token on the server
        performLogoutRequest();

        // Then, clear the local token and navigate to the login screen
        SharedPreferences sharedPreferences = getSharedPreferences(TeamLoginActivity.SHARED_PREFS, MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.clear().apply(); // Use clear() to remove all stored preferences

        Toast.makeText(this, "Logged out successfully", Toast.LENGTH_SHORT).show();
        Intent intent = new Intent(this, TeamLoginActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        startActivity(intent);
        finish();
    }

    private void performLogoutRequest() {
        SharedPreferences sharedPreferences = getSharedPreferences(TeamLoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(TeamLoginActivity.AUTH_TOKEN_KEY, null);

        // If there's no token, no need to make a server call
        if (token == null) return;

        StringRequest stringRequest = new StringRequest(Request.Method.POST, LOGOUT_URL,
                response -> {
                    // Success, the token was invalidated on the server
                },
                error -> {
                    // Error, but we will still log the user out locally
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
