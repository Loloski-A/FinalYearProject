package com.example.bystanderapp;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.view.LayoutInflater;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.ProgressBar;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONObject;

import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class FirstAidActivity extends AppCompatActivity {

    private EditText searchFirstAidEditText;
    private ListView firstAidTopicsListView;
    private Button backFromFirstAidButton;
    private ProgressBar progressBar;
    private GuideAdapter adapter;
    private ArrayList<FirstAidGuide> allGuides = new ArrayList<>();

    private static final String GUIDES_URL = "http://10.0.2.2:8000/api/bystander/first-aid-guides";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first_aid);

        searchFirstAidEditText = findViewById(R.id.searchFirstAidEditText);
        firstAidTopicsListView = findViewById(R.id.firstAidTopicsListView);
        backFromFirstAidButton = findViewById(R.id.backFromFirstAidButton);
        // Add a ProgressBar to your activity_first_aid.xml if you want a loading indicator
        // progressBar = findViewById(R.id.progressBar);

        adapter = new GuideAdapter(this, allGuides);
        firstAidTopicsListView.setAdapter(adapter);

        setupListeners();
        fetchFirstAidGuides();
    }

    private void setupListeners() {
        backFromFirstAidButton.setOnClickListener(v -> finish());

        firstAidTopicsListView.setOnItemClickListener((parent, view, position, id) -> {
            FirstAidGuide selectedGuide = adapter.getItem(position);
            if (selectedGuide != null) {
                showGuideDetails(selectedGuide);
            }
        });

        searchFirstAidEditText.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                adapter.getFilter().filter(s);
            }

            @Override
            public void afterTextChanged(Editable s) {}
        });
    }

    private void showGuideDetails(FirstAidGuide guide) {
        // Inflate the custom layout
        LayoutInflater inflater = this.getLayoutInflater();
        View dialogView = inflater.inflate(R.layout.dialog_guide_details, null);

        // Get the TextViews from the custom layout
        TextView titleTextView = dialogView.findViewById(R.id.dialogGuideTitle);
        TextView contentTextView = dialogView.findViewById(R.id.dialogGuideContent);

        // Set the text for the title and content
        titleTextView.setText(guide.getTitle());
        contentTextView.setText(guide.getContent());

        // Build and show the dialog
        new AlertDialog.Builder(this)
                .setView(dialogView) // Set the custom view
                .setPositiveButton("Close", null)
                .show();
    }

    private void fetchFirstAidGuides() {
        // showProgressBar(true);
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication error. Please log in again.", Toast.LENGTH_LONG).show();
            startActivity(new Intent(this, LoginActivity.class));
            finish();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, GUIDES_URL,
                response -> {
                    // showProgressBar(false);
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray guidesArray = jsonObject.getJSONArray("guides");
                        allGuides.clear();

                        for (int i = 0; i < guidesArray.length(); i++) {
                            JSONObject guideObject = guidesArray.getJSONObject(i);
                            String title = guideObject.getString("title");
                            String content = guideObject.getString("content");
                            String type = guideObject.getString("incident_type");
                            allGuides.add(new FirstAidGuide(title, content, type));
                        }
                        adapter.notifyDataSetChanged();

                    } catch (Exception e) {
                        e.printStackTrace();
                        Toast.makeText(this, "Failed to parse guides.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    // showProgressBar(false);
                    String errorMessage = "Failed to fetch guides. Please try again.";
                    if (error.networkResponse != null && error.networkResponse.data != null) {
                        try {
                            String body = new String(error.networkResponse.data, StandardCharsets.UTF_8);
                            JSONObject jsonObject = new JSONObject(body);
                            if (jsonObject.has("message")) {
                                errorMessage = jsonObject.getString("message");
                            }
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

        RequestQueue requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    private void showProgressBar(boolean show) {
        if (progressBar != null) {
            progressBar.setVisibility(show ? View.VISIBLE : View.GONE);
        }
    }
}
