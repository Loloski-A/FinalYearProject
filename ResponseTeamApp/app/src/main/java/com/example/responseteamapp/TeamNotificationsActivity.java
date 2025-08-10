package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;
import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import org.json.JSONArray;
import org.json.JSONObject;
import java.nio.charset.StandardCharsets;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

public class TeamNotificationsActivity extends AppCompatActivity {

    private ListView lvNotifications;
    private TextView tvNoNotifications;
    private NotificationAdapter adapter;
    private ArrayList<Notification> notificationsList = new ArrayList<>();

    private static final String NOTIFICATIONS_URL = "http://10.0.2.2:8000/api/team/notifications";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_notifications);

        lvNotifications = findViewById(R.id.lv_notifications);
        tvNoNotifications = findViewById(R.id.tv_no_notifications);

        // Set up the custom adapter
        adapter = new NotificationAdapter(this, notificationsList);
        lvNotifications.setAdapter(adapter);

        // Fetch notifications from the backend
        fetchNotifications();
    }

    private void fetchNotifications() {
        SharedPreferences sharedPreferences = getSharedPreferences(TeamLoginActivity.SHARED_PREFS, MODE_PRIVATE);
        final String token = sharedPreferences.getString(TeamLoginActivity.AUTH_TOKEN_KEY, null);

        if (token == null) {
            Toast.makeText(this, "Authentication Error.", Toast.LENGTH_LONG).show();
            return;
        }

        StringRequest stringRequest = new StringRequest(Request.Method.GET, NOTIFICATIONS_URL,
                response -> {
                    try {
                        JSONObject jsonObject = new JSONObject(response);
                        JSONArray notificationsArray = jsonObject.getJSONArray("notifications");
                        notificationsList.clear();

                        if (notificationsArray.length() == 0) {
                            tvNoNotifications.setVisibility(View.VISIBLE);
                            lvNotifications.setVisibility(View.GONE);
                        } else {
                            for (int i = 0; i < notificationsArray.length(); i++) {
                                JSONObject notificationObj = notificationsArray.getJSONObject(i);
                                notificationsList.add(new Notification(
                                        notificationObj.getString("title"),
                                        notificationObj.getString("message")
                                ));
                            }
                            adapter.notifyDataSetChanged();
                            tvNoNotifications.setVisibility(View.GONE);
                            lvNotifications.setVisibility(View.VISIBLE);
                        }
                    } catch (Exception e) {
                        Toast.makeText(this, "Error parsing notifications.", Toast.LENGTH_SHORT).show();
                    }
                },
                error -> {
                    String errorMessage = "Failed to fetch notifications.";
                    if (error.networkResponse != null && error.networkResponse.data != null) {
                        try {
                            String body = new String(error.networkResponse.data, StandardCharsets.UTF_8);
                            errorMessage = new JSONObject(body).getString("message");
                        } catch (Exception e) {}
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

        Volley.newRequestQueue(this).add(stringRequest);
    }
}
