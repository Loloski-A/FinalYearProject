package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.splashscreen.SplashScreen;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.TextUtils;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.HashMap;
import java.util.Map;

public class TeamLoginActivity extends AppCompatActivity {

    private EditText teamEmailEditText, teamPasswordEditText;
    private Button teamLoginButton;
    private TextView tvRegisterLink;
    private ProgressBar progressBar;

    private static final String LOGIN_URL = "http://10.0.2.2:8000/api/login";
    public static final String SHARED_PREFS = "teamSharedPrefs";
    public static final String AUTH_TOKEN_KEY = "teamAuthToken";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        SplashScreen.installSplashScreen(this);
        super.onCreate(savedInstanceState);

        // If user is already logged in, go straight to the dashboard
        if (isLoggedIn()) {
            startActivity(new Intent(this, TeamDashboardActivity.class));
            finish();
            return;
        }

        setContentView(R.layout.activity_team_login);

        teamEmailEditText = findViewById(R.id.teamEmailEditText);
        teamPasswordEditText = findViewById(R.id.teamPasswordEditText);
        teamLoginButton = findViewById(R.id.teamLoginButton);
        tvRegisterLink = findViewById(R.id.tv_register_link);
        progressBar = findViewById(R.id.progressBar);

        teamLoginButton.setOnClickListener(v -> attemptLogin());
        tvRegisterLink.setOnClickListener(v -> {
            startActivity(new Intent(this, TeamRegisterActivity.class));
        });
    }

    private boolean isLoggedIn() {
        SharedPreferences sharedPreferences = getSharedPreferences(SHARED_PREFS, MODE_PRIVATE);
        return sharedPreferences.getString(AUTH_TOKEN_KEY, null) != null;
    }

    private void attemptLogin() {
        String email = teamEmailEditText.getText().toString().trim();
        String password = teamPasswordEditText.getText().toString().trim();

        if (TextUtils.isEmpty(email) || !Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            teamEmailEditText.setError("Please enter a valid email");
            return;
        }
        if (TextUtils.isEmpty(password)) {
            teamPasswordEditText.setError("Password is required");
            return;
        }

        performLoginRequest(email, password);
    }

    private void performLoginRequest(String email, String password) {
        progressBar.setVisibility(View.VISIBLE);
        teamLoginButton.setEnabled(false);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, LOGIN_URL,
                response -> {
                    progressBar.setVisibility(View.GONE);
                    teamLoginButton.setEnabled(true);
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONObject user = jsonObject.getJSONObject("user");

                        // IMPORTANT: Check if the user is a Response Team member (is_role == 2)
                        if (user.getInt("is_role") == 2) {
                            String token = jsonObject.getString("access_token");
                            saveAuthToken(token);
                            Toast.makeText(this, "Login Successful!", Toast.LENGTH_SHORT).show();
                            startActivity(new Intent(this, TeamDashboardActivity.class));
                            finish();
                        } else {
                            Toast.makeText(this, "Access Denied: This is not a Response Team account.", Toast.LENGTH_LONG).show();
                        }
                    } catch (Exception e) {
                        Toast.makeText(this, "Failed to parse login response.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    progressBar.setVisibility(View.GONE);
                    teamLoginButton.setEnabled(true);
                    String errorMessage = "Login failed. Please check your credentials.";
                    if (error.networkResponse != null && error.networkResponse.data != null) {
                        try {
                            String body = new String(error.networkResponse.data, StandardCharsets.UTF_8);
                            JSONObject errorJson = new JSONObject(body);
                            if (errorJson.has("message")) {
                                errorMessage = errorJson.getString("message");
                            }
                        } catch (Exception e) {
                            // Could not parse error
                        }
                    }
                    Toast.makeText(this, errorMessage, Toast.LENGTH_LONG).show();
                }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("email", email);
                params.put("password", password);
                return params;
            }
        };
        Volley.newRequestQueue(this).add(stringRequest);
    }

    private void saveAuthToken(String token) {
        SharedPreferences sharedPreferences = getSharedPreferences(SHARED_PREFS, MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();
        editor.putString(AUTH_TOKEN_KEY, token);
        editor.apply();
    }
}
