package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Arrays;

public class TeamDashboardActivity extends AppCompatActivity {

    private ListView assignedIncidentsListView;
    private TextView noAssignedIncidentsText;
    private Button viewProfileButton, logoutButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_dashboard);

        assignedIncidentsListView = findViewById(R.id.assignedIncidentsListView);
        noAssignedIncidentsText = findViewById(R.id.noAssignedIncidentsText);
        viewProfileButton = findViewById(R.id.viewProfileButton);
        logoutButton = findViewById(R.id.logoutButton);

        // Simulate fetching assigned incidents for the team
        ArrayList<String> assignedIncidents = new ArrayList<>(Arrays.asList(
                "Incident #123: Fire at Westlands (Status: Assigned)",
                "Incident #456: Accident on Thika Road (Status: En Route)"
        ));

        if (assignedIncidents.isEmpty()) {
            assignedIncidentsListView.setVisibility(View.GONE);
            noAssignedIncidentsText.setVisibility(View.VISIBLE);
        } else {
            assignedIncidentsListView.setVisibility(View.VISIBLE);
            noAssignedIncidentsText.setVisibility(View.GONE);
            ArrayAdapter<String> adapter = new ArrayAdapter<>(this,
                    android.R.layout.simple_list_item_1, assignedIncidents);
            assignedIncidentsListView.setAdapter(adapter);

            assignedIncidentsListView.setOnItemClickListener((parent, view, position, id) -> {
                String selectedIncident = assignedIncidents.get(position);
                Toast.makeText(TeamDashboardActivity.this, "Viewing: " + selectedIncident, Toast.LENGTH_SHORT).show();
                // In a real app, parse incident ID and pass to IncidentDetailActivity
                Intent intent = new Intent(TeamDashboardActivity.this, TeamIncidentDetailActivity.class);
                intent.putExtra("incident_info", selectedIncident); // Pass some info for demo
                startActivity(intent);
            });
        }

        viewProfileButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(TeamDashboardActivity.this, TeamProfileActivity.class);
                startActivity(intent);
            }
        });

        logoutButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Toast.makeText(TeamDashboardActivity.this, "Logging out...", Toast.LENGTH_SHORT).show();
                Intent intent = new Intent(TeamDashboardActivity.this, TeamLoginActivity.class);
                startActivity(intent);
                finish(); // Close dashboard and go back to login
            }
        });
    }
}
