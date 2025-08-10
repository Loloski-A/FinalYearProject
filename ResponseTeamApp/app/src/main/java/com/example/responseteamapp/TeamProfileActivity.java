package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
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

public class TeamProfileActivity extends AppCompatActivity {

    private TextView teamNameTextView, teamTypeTextView, teamMembersTextView, teamContactTextView;
    private Button backFromProfileButton;

    private static final String PROFILE_URL = "http://10.0.2.2:8000/api/team/profile";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_profile);

        // Initialize UI elements
        teamNameTextView = findViewById(R.id.teamNameTextView);
        teamTypeTextView = findViewById(R.id.teamTypeTextView);
        teamMembersTextView = findViewById(R.id.teamMembersTextView);
        teamContactTextView = findViewById(R.id.teamContactTextView);
        backFromProfileButton = findViewById(R.id.backFromProfileButton);

        backFromProfileButton.setOnClickListener(v -> finish());

        // Fetch the real profile data from the backend
        fetchTeamProfile();
    }

    private void fetchTeamProfile() {
        SharedPreferences sharedPreferences = getSharedPreferences(TeamLoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(TeamLoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication Error. Please log in again.", Toast.LENGTH_LONG).show();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, PROFILE_URL,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONObject profile = jsonObject.getJSONObject("team_profile");

                        // Populate the views with dynamic data from the API
                        teamNameTextView.setText(profile.getString("name"));
                        teamTypeTextView.setText("Type: " + profile.getString("team_type"));
                        teamContactTextView.setText("Contact: " + profile.optString("contact_phone", "N/A"));

                        // Get the dynamic member count from the response and update the TextView
                        int memberCount = profile.getInt("members_count");
                        teamMembersTextView.setText("Members: " + memberCount);

                    } catch (Exception e) {
                        // This will now show a more specific error if parsing fails
                        Toast.makeText(this, "Error parsing profile data: " + e.getMessage(), Toast.LENGTH_LONG).show();
                    }
                },
                error -> {
                    String errorMessage = "Failed to fetch profile.";
                    if (error.networkResponse != null && error.networkResponse.data != null) {
                        try {
                            String body = new String(error.networkResponse.data, StandardCharsets.UTF_8);
                            errorMessage = new JSONObject(body).getString("message");
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

        Volley.newRequestQueue(this).add(stringRequest);
    }
}
