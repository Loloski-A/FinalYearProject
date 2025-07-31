package com.example.responseteamapp;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;

public class TeamMapActivity extends AppCompatActivity implements OnMapReadyCallback {

    private GoogleMap mMap;
    private Button btnGetDirections;
    private double incidentLat, incidentLng;
    private String incidentLocationName;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_map);

        // Get incident location from intent (example)
        if (getIntent().getExtras() != null) {
            incidentLat = getIntent().getDoubleExtra("incident_lat", 0.0);
            incidentLng = getIntent().getDoubleExtra("incident_lng", 0.0);
            incidentLocationName = getIntent().getStringExtra("incident_location_name");
        } else {
            // Default to a known location if no incident data is passed
            incidentLat = -1.286389; // Example: Nairobi
            incidentLng = 36.817223; // Example: Nairobi
            incidentLocationName = "Nairobi City Centre";
            Toast.makeText(this, "No incident location provided, showing default.", Toast.LENGTH_LONG).show();
        }

        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        if (mapFragment != null) {
            mapFragment.getMapAsync(this);
        }

        btnGetDirections = findViewById(R.id.btn_get_directions);
        btnGetDirections.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                getDirections();
            }
        });
    }

    @Override
    public void onMapReady(@NonNull GoogleMap googleMap) {
        mMap = googleMap;

        // Add a marker for the incident location and move the camera
        LatLng incidentLocation = new LatLng(incidentLat, incidentLng);
        mMap.addMarker(new MarkerOptions().position(incidentLocation).title(incidentLocationName));
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(incidentLocation, 15)); // Zoom level 15
    }

    private void getDirections() {
        // Open Google Maps app for directions
        Uri gmmIntentUri = Uri.parse("google.navigation:q=" + incidentLat + "," + incidentLng + "&mode=d"); // d for driving
        Intent mapIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
        mapIntent.setPackage("com.google.android.apps.maps");

        if (mapIntent.resolveActivity(getPackageManager()) != null) {
            startActivity(mapIntent);
        } else {
            Toast.makeText(this, "Google Maps app not found. Please install it.", Toast.LENGTH_SHORT).show();
        }
    }
}