package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class MapActivity extends AppCompatActivity {

    private Button backFromMapButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_map);

        backFromMapButton = findViewById(R.id.backFromMapButton);

        backFromMapButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish(); // Go back to MainActivity
            }
        });

        // This Toast is a placeholder to remind about actual map integration.
        // In a real app, you would integrate Google Maps SDK here.
        Toast.makeText(this, "Map functionality requires Google Maps SDK integration.", Toast.LENGTH_LONG).show();
    }
}
