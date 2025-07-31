package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.ImageView; // Import ImageView

public class TeamProfileActivity extends AppCompatActivity {

    private TextView teamNameTextView, teamTypeTextView, teamMembersTextView, teamContactTextView;
    private Button backFromProfileButton;
    private ImageView teamProfileImageView; // Declare ImageView

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_profile);

        // Initialize UI elements
        teamNameTextView = findViewById(R.id.teamNameTextView);
        teamTypeTextView = findViewById(R.id.teamTypeTextView);
        teamMembersTextView = findViewById(R.id.teamMembersTextView);
        teamContactTextView = findViewById(R.id.teamContactTextView);
        backFromProfileButton = findViewById(R.id.backFromProfileButton);
        teamProfileImageView = findViewById(R.id.ic_team_placeholder); // Initialize ImageView

        // For demonstration, set dummy data
        teamNameTextView.setText("Fire Brigade Alpha");
        teamTypeTextView.setText("Type: Fire Response");
        teamMembersTextView.setText("Members: 5");
        teamContactTextView.setText("Contact: +254 7XX XXX XXX");

        // Set a placeholder image for the team profile
        // You'll need to add an actual drawable named 'ic_team_placeholder' to your res/drawable folder
        // For example, a simple vector asset or a generic icon.
        // For now, let's use a generic Android drawable if ic_team_placeholder isn't created yet
        try {
            teamProfileImageView.setImageResource(R.drawable.ic_team_placeholder);
        } catch (Exception e) {
            // Fallback if the custom drawable doesn't exist yet
            teamProfileImageView.setImageResource(android.R.drawable.ic_menu_myplaces);
        }


        backFromProfileButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish(); // Go back to TeamDashboardActivity
            }
        });
    }
}
