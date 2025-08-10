package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;
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

public class NotificationsActivity extends AppCompatActivity {

    private ListView notificationsListView;
    private TextView noNotificationsText;
    private Button backFromNotificationsButton;
    private NotificationAdapter adapter;
    private ArrayList<Notification> notificationsList = new ArrayList<>();

    private static final String NOTIFICATIONS_URL = "http://10.0.2.2:8000/api/bystander/notifications";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notifications);

        notificationsListView = findViewById(R.id.notificationsListView);
        noNotificationsText = findViewById(R.id.noNotificationsText);
        backFromNotificationsButton = findViewById(R.id.backFromNotificationsButton);

        adapter = new NotificationAdapter(this, notificationsList);
        notificationsListView.setAdapter(adapter);

        backFromNotificationsButton.setOnClickListener(v -> finish());

        fetchNotifications();
    }

    private void fetchNotifications() {
        SharedPreferences sharedPreferences = getSharedPreferences(LoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(LoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication error. Please log in again.", Toast.LENGTH_LONG).show();
            startActivity(new Intent(this, LoginActivity.class));
            finish();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, NOTIFICATIONS_URL,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray notificationsArray = jsonObject.getJSONArray("notifications");
                        notificationsList.clear();

                        if (notificationsArray.length() == 0) {
                            notificationsListView.setVisibility(View.GONE);
                            noNotificationsText.setVisibility(View.VISIBLE);
                        } else {
                            for (int i = 0; i < notificationsArray.length(); i++) {
                                JSONObject notificationObject = notificationsArray.getJSONObject(i);
                                String title = notificationObject.getString("title");
                                String message = notificationObject.getString("message");
                                notificationsList.add(new Notification(title, message));
                            }
                            adapter.notifyDataSetChanged();
                            notificationsListView.setVisibility(View.VISIBLE);
                            noNotificationsText.setVisibility(View.GONE);
                        }
                    } catch (Exception e) {
                        e.printStackTrace();
                        Toast.makeText(this, "Failed to parse notifications.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    String errorMessage = "Failed to fetch notifications. Please try again.";
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
}
