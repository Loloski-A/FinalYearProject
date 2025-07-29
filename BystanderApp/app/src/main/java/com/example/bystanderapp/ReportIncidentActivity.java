package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;
import android.net.Uri; // For handling image/video URIs

public class ReportIncidentActivity extends AppCompatActivity {

    private EditText incidentTypeEditText, locationEditText, descriptionEditText, contactInfoEditText;
    private Button submitIncidentButton, backButton, getLocationButton, captureImageButton, recordVideoButton;
    private ImageView mediaPreview;

    // Placeholder for media URI (in a real app, this would be handled by camera/gallery intent results)
    private Uri capturedMediaUri = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_report_incident);

        // Initialize UI elements
        incidentTypeEditText = findViewById(R.id.incidentTypeEditText);
        locationEditText = findViewById(R.id.locationEditText);
        descriptionEditText = findViewById(R.id.descriptionEditText);
        contactInfoEditText = findViewById(R.id.contactInfoEditText);
        submitIncidentButton = findViewById(R.id.submitIncidentButton);
        backButton = findViewById(R.id.backButton);
        getLocationButton = findViewById(R.id.getLocationButton);
        captureImageButton = findViewById(R.id.captureImageButton);
        recordVideoButton = findViewById(R.id.recordVideoButton);
        mediaPreview = findViewById(R.id.mediaPreview);

        // Set OnClickListener for Get Location button
        getLocationButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // In a real app, this would trigger GPS/network location services
                Toast.makeText(ReportIncidentActivity.this, "Getting current location...", Toast.LENGTH_SHORT).show();
                // For demonstration, simulate a location
                locationEditText.setText("Simulated Location: Lat 34.0522, Lon -118.2437");
            }
        });

        // Set OnClickListener for Capture Image button
        captureImageButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // In a real app, this would launch camera intent
                Toast.makeText(ReportIncidentActivity.this, "Launching camera for image...", Toast.LENGTH_SHORT).show();
                // Simulate image capture
                mediaPreview.setImageResource(R.drawable.placeholder_image); // You'll need a placeholder_image drawable
                mediaPreview.setVisibility(View.VISIBLE);
                capturedMediaUri = Uri.parse("android.resource://" + getPackageName() + "/" + R.drawable.placeholder_image);
            }
        });

        // Set OnClickListener for Record Video button
        recordVideoButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // In a real app, this would launch video camera intent
                Toast.makeText(ReportIncidentActivity.this, "Launching camera for video...", Toast.LENGTH_SHORT).show();
                // Simulate video capture (can't show video preview easily without a VideoView)
                mediaPreview.setImageResource(R.drawable.placeholder_video); // You'll need a placeholder_video drawable
                mediaPreview.setVisibility(View.VISIBLE);
                capturedMediaUri = Uri.parse("android.resource://" + getPackageName() + "/" + R.drawable.placeholder_video);
            }
        });

        // Set OnClickListener for Submit button
        submitIncidentButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String incidentType = incidentTypeEditText.getText().toString().trim();
                String location = locationEditText.getText().toString().trim();
                String description = descriptionEditText.getText().toString().trim();
                String contactInfo = contactInfoEditText.getText().toString().trim();

                if (incidentType.isEmpty() || location.isEmpty() || description.isEmpty()) {
                    Toast.makeText(ReportIncidentActivity.this, "Please fill in all required fields (Type, Location, Description)", Toast.LENGTH_LONG).show();
                } else {
                    // Here you would gather all data, including capturedMediaUri and send to backend
                    String reportSummary = "Incident Reported:\n" +
                            "Type: " + incidentType + "\n" +
                            "Location: " + location + "\n" +
                            "Description: " + description;
                    if (!contactInfo.isEmpty()) {
                        reportSummary += "\nContact: " + contactInfo;
                    }
                    if (capturedMediaUri != null) {
                        reportSummary += "\nMedia Attached: Yes";
                    }
                    Toast.makeText(ReportIncidentActivity.this, reportSummary, Toast.LENGTH_LONG).show();

                    // In a real app, you'd send data to your backend API here
                    // e.g., using Retrofit, Volley, or Firebase Firestore

                    finish(); // Go back to MainActivity
                }
            }
        });

        // Set OnClickListener for Back button
        backButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish(); // Go back to MainActivity
            }
        });
    }
}
