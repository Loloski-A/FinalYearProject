package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.Toast;

public class TeamMapActivity extends AppCompatActivity {

    private WebView mapWebView;
    private Button btnGetDirections;
    private double incidentLat, incidentLng;
    private String incidentLocationName;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_map);

        mapWebView = findViewById(R.id.mapWebView);
        btnGetDirections = findViewById(R.id.btn_get_directions);

        // Get incident location data passed from the detail activity
        if (getIntent().getExtras() != null) {
            incidentLat = getIntent().getDoubleExtra("incident_lat", 0.0);
            incidentLng = getIntent().getDoubleExtra("incident_lng", 0.0);
            incidentLocationName = getIntent().getStringExtra("incident_location_name");
        } else {
            Toast.makeText(this, "No incident location provided.", Toast.LENGTH_LONG).show();
            finish();
            return;
        }

        setupWebView();
        btnGetDirections.setOnClickListener(v -> getDirections());
    }

    private void setupWebView() {
        mapWebView.getSettings().setJavaScriptEnabled(true);
        mapWebView.setWebViewClient(new WebViewClient() {
            @Override
            public void onPageFinished(WebView view, String url) {
                super.onPageFinished(view, url);
                // Once the HTML page is loaded, call the JavaScript function to show the incident
                String jsCall = String.format("javascript:showIncidentOnMap(%f, %f, '%s')",
                        incidentLat, incidentLng, incidentLocationName);
                mapWebView.evaluateJavascript(jsCall, null);
            }
        });
        // Load the local HTML file from the assets folder
        mapWebView.loadUrl("file:///android_asset/team_map_view.html");
    }

    private void getDirections() {
        // Create a Uri for Google Maps navigation
        Uri gmmIntentUri = Uri.parse("google.navigation:q=" + incidentLat + "," + incidentLng);
        Intent mapIntent = new Intent(Intent.ACTION_VIEW, gmmIntentUri);
        mapIntent.setPackage("com.google.android.apps.maps");

        if (mapIntent.resolveActivity(getPackageManager()) != null) {
            startActivity(mapIntent);
        } else {
            Toast.makeText(this, "Google Maps app is not installed.", Toast.LENGTH_SHORT).show();
        }
    }
}
