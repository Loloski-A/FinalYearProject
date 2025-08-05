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

public class IncidentMainAdapter extends ArrayAdapter<Incident> {

    public IncidentMainAdapter(@NonNull Context context, List<Incident> incidents) {
        super(context, 0, incidents);
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        Incident incident = getItem(position);
        if (convertView == null) {
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.list_item_incident_main, parent, false);
        }

        TextView tvType = convertView.findViewById(R.id.mainIncidentType);
        TextView tvLocation = convertView.findViewById(R.id.mainIncidentLocation);
        TextView tvStatus = convertView.findViewById(R.id.mainIncidentStatus);

        if (incident != null) {
            tvType.setText(incident.getIncidentType());
            tvLocation.setText(incident.getLocationName());
            tvStatus.setText("Status: " + incident.getStatus());
        }

        return convertView;
    }
}
