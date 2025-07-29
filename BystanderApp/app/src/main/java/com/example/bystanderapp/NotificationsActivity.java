package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Arrays;

public class NotificationsActivity extends AppCompatActivity {

    private ListView notificationsListView;
    private TextView noNotificationsText;
    private Button backFromNotificationsButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notifications);

        notificationsListView = findViewById(R.id.notificationsListView);
        noNotificationsText = findViewById(R.id.noNotificationsText);
        backFromNotificationsButton = findViewById(R.id.backFromNotificationsButton);

        // Simulate fetching notifications
        ArrayList<String> notifications = new ArrayList<>(Arrays.asList(
                "Incident #123: Help is on the way!",
                "New incident reported near you: Fire in CBD.",
                "Incident #456: Status updated to 'Resolved'."
        ));

        if (notifications.isEmpty()) {
            notificationsListView.setVisibility(View.GONE);
            noNotificationsText.setVisibility(View.VISIBLE);
        } else {
            notificationsListView.setVisibility(View.VISIBLE);
            noNotificationsText.setVisibility(View.GONE);
            ArrayAdapter<String> adapter = new ArrayAdapter<>(this,
                    android.R.layout.simple_list_item_1, notifications);
            notificationsListView.setAdapter(adapter);

            notificationsListView.setOnItemClickListener((parent, view, position, id) -> {
                String selectedNotification = notifications.get(position);
                Toast.makeText(NotificationsActivity.this, "Viewing: " + selectedNotification, Toast.LENGTH_SHORT).show();
                // In a real app, you might navigate to incident details or other relevant screen
            });
        }

        backFromNotificationsButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish(); // Go back to MainActivity
            }
        });
    }
}
