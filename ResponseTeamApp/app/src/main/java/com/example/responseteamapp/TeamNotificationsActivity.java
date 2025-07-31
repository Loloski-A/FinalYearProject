package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import java.util.ArrayList;
import java.util.List;

public class TeamNotificationsActivity extends AppCompatActivity {

    private ListView lvNotifications;
    private TextView tvNoNotifications;
    private ArrayAdapter<String> adapter;
    private List<String> notificationsList;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_notifications);

        lvNotifications = findViewById(R.id.lv_notifications);
        tvNoNotifications = findViewById(R.id.tv_no_notifications);

        notificationsList = new ArrayList<>();
        // Example notifications (replace with data fetched from your backend)
        notificationsList.add("New Incident Assigned: Fire at Central Market (High Severity)");
        notificationsList.add("Incident #1234 Status Update: En Route");
        notificationsList.add("Admin Alert: Mandatory Team Meeting on Friday at 10 AM.");
        notificationsList.add("Incident #5678 Resolved: Medical Emergency at Park Street.");

        adapter = new ArrayAdapter<>(this, android.R.layout.simple_list_item_1, notificationsList);
        lvNotifications.setAdapter(adapter);

        if (notificationsList.isEmpty()) {
            tvNoNotifications.setVisibility(View.VISIBLE);
            lvNotifications.setVisibility(View.GONE);
        } else {
            tvNoNotifications.setVisibility(View.GONE);
            lvNotifications.setVisibility(View.VISIBLE);
        }

        // You might want to implement a refresh mechanism or pull new notifications from your API
    }
}