package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.Button;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.HashMap;
import java.util.Map;

public class MapActivity extends AppCompatActivity {

    private WebView mapWebView;
    private static final String ALL_INCIDENTS_URL = "http://10.0.2.2:8000/api/bystander/all-incidents";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map);

        mapWebView = findViewById(R.id.mapWebView);
        Button backFromMapButton = findViewById(R.id.backFromMapButton);
        backFromMapButton.setOnClickListener(v -> finish());

        setupWebView();
    }

    private void setupWebView() {
        mapWebView.getSettings().setJavaScriptEnabled(true);
        mapWebView.setWebViewClient(new WebViewClient() {
            @Override
            public void onPageFinished(WebView view, String url) {
                super.onPageFinished(view, url);
                // Once the HTML page is loaded, fetch the incidents
                fetchAndDisplayIncidents();
            }
        });
        // Load the local HTML file from the assets folder
        mapWebView.loadUrl("file:///android_asset/map_view.html");
    }

    private void fetchAndDisplayIncidents() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication error. Please log in again.", Toast.LENGTH_LONG).show();
            startActivity(new Intent(this, LoginActivity.class));
            finish();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, ALL_INCIDENTS_URL,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray incidentsArray = jsonObject.getJSONArray("incidents");

                        // Inject the JSON data into the WebView to be processed by the JavaScript
                        mapWebView.evaluateJavascript("javascript:addIncidentsToMap('" + incidentsArray.toString() + "')", null);

                    } catch (Exception e) {
                        e.printStackTrace();
                        Toast.makeText(this, "Failed to parse incident data.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    Toast.makeText(this, "Failed to fetch incidents for map.", Toast.LENGTH_SHORT).show();
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
