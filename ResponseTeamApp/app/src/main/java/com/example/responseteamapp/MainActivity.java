package com.example.responseteamapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main); // Assuming activity_main.xml exists

        // Example: Redirect to login activity after a short delay or immediately
        // For now, it immediately starts the login activity
        Intent intent = new Intent(MainActivity.this, TeamLoginActivity.class);
        startActivity(intent);
        finish(); // Finish MainActivity so user can't go back to it
    }
}