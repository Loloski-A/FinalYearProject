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
import java.util.Arrays; // Import Arrays

public class MyReportsActivity extends AppCompatActivity {

    private ListView reportsListView;
    private TextView noReportsText;
    private Button backToMainButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_reports);

        reportsListView = findViewById(R.id.reportsListView);
        noReportsText = findViewById(R.id.noReportsText);
        backToMainButton = findViewById(R.id.backToMainButton);

        // Simulate fetching user reports
        ArrayList<String> userReports = new ArrayList<>(Arrays.asList( // Use Arrays.asList
                "Fire at Westlands (Pending)",
                "Accident on Uhuru Highway (Assigned)",
                "Flood in Mathare (En Route)"
        ));

        if (userReports.isEmpty()) {
            reportsListView.setVisibility(View.GONE);
            noReportsText.setVisibility(View.VISIBLE);
        } else {
            reportsListView.setVisibility(View.VISIBLE);
            noReportsText.setVisibility(View.GONE);
            ArrayAdapter<String> adapter = new ArrayAdapter<>(this,
                    android.R.layout.simple_list_item_1, userReports);
            reportsListView.setAdapter(adapter);

            reportsListView.setOnItemClickListener((parent, view, position, id) -> {
                String selectedReport = userReports.get(position);
                Toast.makeText(MyReportsActivity.this, "Details for: " + selectedReport, Toast.LENGTH_SHORT).show();
                // In a real app, you'd launch a ReportDetailActivity here
            });
        }

        backToMainButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish(); // Go back to MainActivity
            }
        });
    }
}
