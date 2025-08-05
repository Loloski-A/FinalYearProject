package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class TeamLoginActivity extends AppCompatActivity {

    private EditText teamEmailEditText, teamPasswordEditText;
    private Button teamLoginButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_team_login);

        teamEmailEditText = findViewById(R.id.teamEmailEditText);
        teamPasswordEditText = findViewById(R.id.teamPasswordEditText);
        teamLoginButton = findViewById(R.id.teamLoginButton);

        teamLoginButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                String email = teamEmailEditText.getText().toString().trim();
                String password = teamPasswordEditText.getText().toString().trim();

                if (email.isEmpty() || password.isEmpty()) {
                    Toast.makeText(TeamLoginActivity.this, "Please enter email and password", Toast.LENGTH_SHORT).show();
                } else {
                    // Placeholder for actual team login logic (e.g., Firebase Auth, your backend API)
                    // You'd verify credentials against your team database/API
                    if (email.equals("team@example.com") && password.equals("team123")) {
                        Toast.makeText(TeamLoginActivity.this, "Team Login Successful!", Toast.LENGTH_SHORT).show();
                        Intent intent = new Intent(TeamLoginActivity.this, TeamDashboardActivity.class);
                        startActivity(intent);
                        finish(); // Close login activity
                    } else {
                        Toast.makeText(TeamLoginActivity.this, "Invalid team credentials", Toast.LENGTH_SHORT).show();
                    }
                }
            }
        });
    }
}
