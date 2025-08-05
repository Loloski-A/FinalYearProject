// app/src/main/java/com/example/bystanderapp/RegisterActivity.java
package com.example.bystanderapp;

import android.os.Bundle;
import android.text.TextUtils;
import android.util.Patterns;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.HashMap;
import java.util.Map;

public class RegisterActivity extends AppCompatActivity {

    // UI Elements
    private EditText editTextFullName, editTextEmail, editTextPassword, editTextPasswordConfirmation;
    private Button buttonRegister;
    private ProgressBar progressBar;

    // *** FIXED URL ***
    // Removed the incorrect Markdown formatting from the URL string.
    private static final String REGISTER_URL = "http://10.0.2.2:8000/api/register/bystander";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        // Initialize UI elements
        editTextFullName = findViewById(R.id.editText_full_name);
        editTextEmail = findViewById(R.id.editText_email);
        editTextPassword = findViewById(R.id.editText_password);
        editTextPasswordConfirmation = findViewById(R.id.editText_password_confirmation);
        buttonRegister = findViewById(R.id.button_register);
        progressBar = findViewById(R.id.progressBar);

        buttonRegister.setOnClickListener(v -> registerUser());
    }

    private void registerUser() {
        // Get user input as strings
        final String fullName = editTextFullName.getText().toString().trim();
        final String email = editTextEmail.getText().toString().trim();
        final String password = editTextPassword.getText().toString().trim();
        final String passwordConfirmation = editTextPasswordConfirmation.getText().toString().trim();

        if (!validateInput(fullName, email, password, passwordConfirmation)) {
            return;
        }

        performRegistrationRequest(fullName, email, password);
    }

    private boolean validateInput(String fullName, String email, String password, String passwordConfirmation) {
        if (TextUtils.isEmpty(fullName)) {
            editTextFullName.setError("Full name is required");
            editTextFullName.requestFocus();
            return false;
        }
        if (TextUtils.isEmpty(email) || !Patterns.EMAIL_ADDRESS.matcher(email).matches()) {
            editTextEmail.setError("Please enter a valid email");
            editTextEmail.requestFocus();
            return false;
        }
        if (TextUtils.isEmpty(password) || password.length() < 8) {
            editTextPassword.setError("Password must be at least 8 characters");
            editTextPassword.requestFocus();
            return false;
        }
        if (!password.equals(passwordConfirmation)) {
            editTextPasswordConfirmation.setError("Passwords do not match");
            editTextPasswordConfirmation.requestFocus();
            return false;
        }
        return true;
    }

    private void performRegistrationRequest(String fullName, String email, String password) {
        progressBar.setVisibility(View.VISIBLE);
        buttonRegister.setEnabled(false);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, REGISTER_URL,
                response -> {
                    progressBar.setVisibility(View.GONE);
                    buttonRegister.setEnabled(true);
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        String message = jsonObject.getString("message");
                        Toast.makeText(RegisterActivity.this, message, Toast.LENGTH_LONG).show();
                        finish();
                    } catch (JSONException e) {
                        Toast.makeText(RegisterActivity.this, "Registration successful, but response was unclear.", Toast.LENGTH_SHORT).show();
                        finish();
                    }
                },
                error -> {
                    progressBar.setVisibility(View.GONE);
                    buttonRegister.setEnabled(true);
                    String errorMessage = "Registration failed! Please try again.";
                    if (error.networkResponse != null && error.networkResponse.data != null) {
                        try {
                            String body = new String(error.networkResponse.data, StandardCharsets.UTF_8);
                            JSONObject jsonObject = new JSONObject(body);
                            if (jsonObject.has("errors")) {
                                JSONObject errors = jsonObject.getJSONObject("errors");
                                if (errors.keys().hasNext()) {
                                    String key = errors.keys().next();
                                    errorMessage = errors.getJSONArray(key).getString(0);
                                }
                            } else if (jsonObject.has("message")) {
                                errorMessage = jsonObject.getString("message");
                            }
                        } catch (Exception e) {
                            // Could not parse the specific error
                        }
                    }
                    Toast.makeText(RegisterActivity.this, errorMessage, Toast.LENGTH_LONG).show();
                }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("name", fullName);
                params.put("email", email);
                params.put("password", password);
                params.put("password_confirmation", password);
                return params;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
