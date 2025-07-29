package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        // Find buttons by their IDs
        Button reportIncidentButton = findViewById(R.id.reportIncidentButton);
        Button myReportsButton = findViewById(R.id.myReportsButton);
        Button notificationsButton = findViewById(R.id.notificationsButton);
        Button mapButton = findViewById(R.id.mapButton);
        Button firstAidButton = findViewById(R.id.firstAidButton);
        // The livestreamButton is commented out as it was removed from the XML layout.
        // Button livestreamButton = findViewById(R.id.livestreamButton);

        // Set OnClickListeners for each button
        reportIncidentButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, ReportIncidentActivity.class);
                startActivity(intent);
            }
        });

        myReportsButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, MyReportsActivity.class);
                startActivity(intent);
            }
        });

        notificationsButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, NotificationsActivity.class);
                startActivity(intent);
            }
        });

        mapButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, MapActivity.class);
                startActivity(intent);
            }
        });

        firstAidButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(MainActivity.this, FirstAidActivity.class);
                startActivity(intent);
            }
        });

        // The listener for livestreamButton is also commented out to match the XML.
        // if (livestreamButton != null) {
        //     livestreamButton.setOnClickListener(new View.OnClickListener() {
        //         @Override
        //         public void onClick(View v) {
        //             Intent intent = new Intent(MainActivity.this, LivestreamActivity.class);
        //             startActivity(intent);
        //         }
        //     });
        // }
    }
}
