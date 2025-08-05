package com.example.bystanderapp;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import java.util.List;

public class ReportAdapter extends ArrayAdapter<Incident> {

    public ReportAdapter(@NonNull Context context, List<Incident> incidents) {
        super(context, 0, incidents);
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        // Get the data item for this position
        Incident incident = getItem(position);

        // Check if an existing view is being reused, otherwise inflate the view
        if (convertView == null) {
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.list_item_report, parent, false);
        }

        // Lookup view for data population
        TextView tvType = convertView.findViewById(R.id.reportTypeTextView);
        TextView tvStatus = convertView.findViewById(R.id.reportStatusTextView);
        TextView tvDate = convertView.findViewById(R.id.reportDateTextView);

        // Populate the data into the template view using the data object
        if (incident != null) {
            tvType.setText(incident.getIncidentType());
            tvStatus.setText(incident.getStatus());
            tvDate.setText(incident.getReportedAt());
        }

        // Return the completed view to render on screen
        return convertView;
    }
}
