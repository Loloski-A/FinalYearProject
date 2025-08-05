package com.example.bystanderapp;

import android.Manifest;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.location.Location;
import android.location.LocationManager;
import android.os.Bundle;
import android.provider.Settings;
import android.text.TextUtils;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Spinner;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.ActivityCompat;
import androidx.core.content.ContextCompat;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.location.Priority; // Added this import
import com.google.android.gms.tasks.CancellationTokenSource;

import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.HashMap;
import java.util.Map;

public class ReportIncidentActivity extends AppCompatActivity {

    private EditText incidentTypeEditText, locationEditText, descriptionEditText;
    private Spinner severitySpinner;
    private Button submitIncidentButton, getLocationButton;
    private ProgressBar progressBar;

    private FusedLocationProviderClient fusedLocationClient;
    private static final int LOCATION_PERMISSION_REQUEST_CODE = 1;
    private double latitude = 0.0;
    private double longitude = 0.0;

    private static final String REPORT_INCIDENT_URL = "http://10.0.2.2:8000/api/bystander/report-incident";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_report_incident);

        // Initialize UI elements
        incidentTypeEditText = findViewById(R.id.incidentTypeEditText);
        locationEditText = findViewById(R.id.locationEditText);
        descriptionEditText = findViewById(R.id.descriptionEditText);
        severitySpinner = findViewById(R.id.severitySpinner);
        submitIncidentButton = findViewById(R.id.submitIncidentButton);
        getLocationButton = findViewById(R.id.getLocationButton);
        progressBar = findViewById(R.id.progressBar);

        fusedLocationClient = LocationServices.getFusedLocationProviderClient(this);

        // Setup the Severity Spinner
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.severity_levels, android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        severitySpinner.setAdapter(adapter);

        // Set button listeners
        getLocationButton.setOnClickListener(v -> getCurrentLocation());
        submitIncidentButton.setOnClickListener(v -> attemptSubmitReport());

        // Automatically try to get location on screen load
        getCurrentLocation();
    }

    private void getCurrentLocation() {
        if (ContextCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
            ActivityCompat.requestPermissions(this, new String[]{Manifest.permission.ACCESS_FINE_LOCATION}, LOCATION_PERMISSION_REQUEST_CODE);
            return;
        }

        LocationManager locationManager = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
        if (!locationManager.isProviderEnabled(LocationManager.GPS_PROVIDER)) {
            showEnableGpsDialog();
            return;
        }

        fusedLocationClient.getCurrentLocation(Priority.PRIORITY_HIGH_ACCURACY, new CancellationTokenSource().getToken())
                .addOnSuccessListener(this, location -> {
                    if (location != null) {
                        latitude = location.getLatitude();
                        longitude = location.getLongitude();
                        Toast.makeText(this, "Location acquired: " + latitude + ", " + longitude, Toast.LENGTH_SHORT).show();
                    } else {
                        Toast.makeText(this, "Could not get location. Please set a location in the emulator's extended controls.", Toast.LENGTH_LONG).show();
                    }
                })
                .addOnFailureListener(this, e -> {
                    Toast.makeText(this, "Failed to get location: " + e.getMessage(), Toast.LENGTH_LONG).show();
                });
    }

    private void showEnableGpsDialog() {
        new AlertDialog.Builder(this)
                .setTitle("Enable GPS")
                .setMessage("Location services are required to get your current location. Please enable GPS.")
                .setPositiveButton("Settings", (dialog, which) -> {
                    Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                    startActivity(intent);
                })
                .setNegativeButton("Cancel", null)
                .show();
    }


    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        super.onRequestPermissionsResult(requestCode, permissions, grantResults);
        if (requestCode == LOCATION_PERMISSION_REQUEST_CODE) {
            if (grantResults.length > 0 && grantResults[0] == PackageManager.PERMISSION_GRANTED) {
                getCurrentLocation();
            } else {
                Toast.makeText(this, "Location permission is required to report an incident.", Toast.LENGTH_LONG).show();
            }
        }
    }

    private void attemptSubmitReport() {
        final String incidentType = incidentTypeEditText.getText().toString().trim();
        final String description = descriptionEditText.getText().toString().trim();
        final String severity = severitySpinner.getSelectedItem().toString();
        final String locationName = locationEditText.getText().toString().trim();

        if (TextUtils.isEmpty(incidentType) || TextUtils.isEmpty(description) || latitude == 0.0) {
            Toast.makeText(this, "Please fill all fields and get your location.", Toast.LENGTH_LONG).show();
            return;
        }

        performSubmitRequest(incidentType, severity, description, locationName);
    }

    private void performSubmitRequest(String incidentType, String severity, String description, String locationName) {
        progressBar.setVisibility(View.VISIBLE);
        submitIncidentButton.setEnabled(false);

        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication error. Please log in again.", Toast.LENGTH_LONG).show();
            startActivity(new Intent(this, LoginActivity.class));
            finish();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.POST, REPORT_INCIDENT_URL,
                response -> {
                    progressBar.setVisibility(View.GONE);
                    submitIncidentButton.setEnabled(true);
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        String message = jsonObject.getString("message");
                        Toast.makeText(ReportIncidentActivity.this, message, Toast.LENGTH_LONG).show();
                        finish();
                    } catch (Exception e) {
                        Toast.makeText(ReportIncidentActivity.this, "Report submitted, but failed to parse response.", Toast.LENGTH_SHORT).show();
                        finish();
                    }
                },
                error -> {
                    progressBar.setVisibility(View.GONE);
                    submitIncidentButton.setEnabled(true);
                    String errorMessage = "Failed to submit report. Please try again.";
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
                            // Parsing error, use the default message
                        }
                    }
                    Toast.makeText(ReportIncidentActivity.this, errorMessage, Toast.LENGTH_LONG).show();
                }) {
            @Override
            protected Map<String, String> getParams() {
                Map<String, String> params = new HashMap<>();
                params.put("incident_type", incidentType);
                params.put("severity", severity);
                params.put("description", description);
                params.put("latitude", String.valueOf(latitude));
                params.put("longitude", String.valueOf(longitude));
                // *** FIXED: Changed key from locationName to location_name ***
                params.put("location_name", locationName);
                return params;
            }

            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String, String> headers = new HashMap<>();
                headers.put("Authorization", "Bearer " + token);
                return headers;
            }
        };

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
}
