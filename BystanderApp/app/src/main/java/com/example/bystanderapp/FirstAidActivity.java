package com.example.bystanderapp;

import androidx.appcompat.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import java.util.ArrayList;
import java.util.Arrays;

public class FirstAidActivity extends AppCompatActivity {

    private EditText searchFirstAidEditText;
    private ListView firstAidTopicsListView;
    private Button backFromFirstAidButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_first_aid);

        searchFirstAidEditText = findViewById(R.id.searchFirstAidEditText);
        firstAidTopicsListView = findViewById(R.id.firstAidTopicsListView);
        backFromFirstAidButton = findViewById(R.id.backFromFirstAidButton);

        // Simulate first aid topics
        ArrayList<String> firstAidTopics = new ArrayList<>(Arrays.asList(
                "CPR Basics",
                "Bleeding Control",
                "Choking (Adults)",
                "Burns (Minor)",
                "Fractures and Sprains",
                "Allergic Reactions"
        ));

        // Create an ArrayAdapter to populate the ListView
        ArrayAdapter<String> adapter = new ArrayAdapter<>(this,
                android.R.layout.simple_list_item_1, firstAidTopics);
        firstAidTopicsListView.setAdapter(adapter);

        // Set an item click listener for the ListView
        firstAidTopicsListView.setOnItemClickListener((parent, view, position, id) -> {
            String selectedTopic = firstAidTopics.get(position);
            Toast.makeText(FirstAidActivity.this, "Viewing guide for: " + selectedTopic, Toast.LENGTH_SHORT).show();
            // In a real application, you would typically launch a new activity here
            // to display the detailed first aid guide for the selected topic.
            // Example:
            // Intent intent = new Intent(FirstAidActivity.this, FirstAidDetailActivity.class);
            // intent.putExtra("topic", selectedTopic);
            // startActivity(intent);
        });

        // Implement basic search functionality for the EditText
        searchFirstAidEditText.addTextChangedListener(new android.text.TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                // Not used in this implementation
            }

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                // Filter the list view items as text changes
                adapter.getFilter().filter(s);
            }

            @Override
            public void afterTextChanged(android.text.Editable s) {
                // Not used in this implementation
            }
        });

        // Set click listener for the "Back to Dashboard" button
        backFromFirstAidButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                finish(); // Close this activity and return to the previous one (MainActivity)
            }
        });
    }
}
