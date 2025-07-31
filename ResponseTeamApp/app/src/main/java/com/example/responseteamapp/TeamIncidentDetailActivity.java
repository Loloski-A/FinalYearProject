package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class TeamIncidentDetailActivity extends AppCompatActivity {

    private TextView detailIncidentId, detailIncidentType, detailIncidentLocation,
            detailIncidentDescription, detailIncidentReporter, detailIncidentTime,
            detailIncidentStatus;
    private Button markEnRouteButton, markResolvedButton, viewOnMapButton, backFromDetailButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_incident_detail);

        // Initialize UI elements
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

        // Get incident data passed from previous activity (TeamDashboardActivity)
        Intent intent = getIntent();
        if (intent != null && intent.hasExtra("incident_info")) {
            String incidentInfo = intent.getStringExtra("incident_info");
            // In a real app, you'd parse a full Incident object here
            // For demo, we'll just display the string and simulate details
            detailIncidentId.setText("#INC" + (int)(Math.random() * 1000)); // Random ID for demo
            detailIncidentType.setText(incidentInfo.contains("Fire") ? "Fire" : (incidentInfo.contains("Accident") ? "Accident" : "Unknown"));
            detailIncidentLocation.setText(incidentInfo.contains("Westlands") ? "Westlands, Nairobi" : (incidentInfo.contains("Thika Road") ? "Thika Road" : "Unknown Location"));
            detailIncidentDescription.setText("Detailed description for " + detailIncidentType.getText() + " at " + detailIncidentLocation.getText());
            detailIncidentReporter.setText("Bystander App User");
            detailIncidentTime.setText("2024-07-29 10:00");
            detailIncidentStatus.setText(incidentInfo.contains("Assigned") ? "Assigned" : (incidentInfo.contains("En Route") ? "En Route" : "Pending"));
        } else {
            // Fallback if no data is passed
            detailIncidentId.setText("#N/A");
            detailIncidentType.setText("No Incident Selected");
            detailIncidentLocation.setText("N/A");
            detailIncidentDescription.setText("Please select an incident from the dashboard.");
            detailIncidentReporter.setText("N/A");
            detailIncidentTime.setText("N/A");
            detailIncidentStatus.setText("Unknown");
        }


        markEnRouteButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // In a real app, update status in backend
                detailIncidentStatus.setText("En Route");
                detailIncidentStatus.setTextColor(getResources().getColor(android.R.color.holo_orange_dark)); // Example color change
                Toast.makeText(TeamIncidentDetailActivity.this, "Status updated to En Route", Toast.LENGTH_SHORT).show();
            }
        });

        markResolvedButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // In a real app, update status in backend
                detailIncidentStatus.setText("Resolved");
                detailIncidentStatus.setTextColor(getResources().getColor(android.R.color.holo_green_dark)); // Example color change
                Toast.makeText(TeamIncidentDetailActivity.this, "Status updated to Resolved", Toast.LENGTH_SHORT).show();
            }
        });

        viewOnMapButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // In a real app, launch map with incident location
                Toast.makeText(TeamIncidentDetailActivity.this, "Opening map to " + detailIncidentLocation.getText(), Toast.LENGTH_SHORT).show();
                // Example: Intent to open a map app
                // Uri gmmIntentUri = Uri.parse("geo:0,0?q=" + detailIncidentLocation.getText());
                // Intent mapIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
                // mapIntent.setPackage("com.google.android.apps.maps");
                // if (mapIntent.resolveActivity(getPackageManager()) != null) {
                //     startActivity(mapIntent);
                // } else {
                //     Toast.makeText(TeamIncidentDetailActivity.this, "Google Maps app not found.", Toast.LENGTH_SHORT).show();
                // }
            }
        });

        backFromDetailButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish(); // Go back to TeamDashboardActivity
            }
        });
    }
}
