package com.example.responseteamapp;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;
import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import java.util.List;

public class IncidentAdapter extends ArrayAdapter<Incident> {
    public IncidentAdapter(@NonNull Context context, List<Incident> incidents) {
        super(context, 0, incidents);
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        Incident incident = getItem(position);
        if (convertView == null) {
            // You will need to create a layout file named 'list_item_incident.xml'
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.list_item_incident, parent, false);
        }

        TextView tvType = convertView.findViewById(R.id.incidentTypeTextView);
        TextView tvLocation = convertView.findViewById(R.id.incidentLocationTextView);
        TextView tvStatus = convertView.findViewById(R.id.incidentStatusTextView);

        if (incident != null) {
            tvType.setText(incident.getIncidentType());
            tvLocation.setText(incident.getLocationName());
            tvStatus.setText("Status: " + incident.getStatus());
        }

        return convertView;
    }
}