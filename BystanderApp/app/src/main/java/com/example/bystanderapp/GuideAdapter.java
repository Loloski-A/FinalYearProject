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

public class GuideAdapter extends ArrayAdapter<FirstAidGuide> {

    public GuideAdapter(@NonNull Context context, List<FirstAidGuide> guides) {
        super(context, 0, guides);
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        // Get the data item for this position
        FirstAidGuide guide = getItem(position);

        // Check if an existing view is being reused, otherwise inflate the view
        if (convertView == null) {
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.list_item_guide, parent, false);
        }

        // Lookup view for data population
        TextView tvTitle = convertView.findViewById(R.id.guideTitleTextView);
        TextView tvType = convertView.findViewById(R.id.guideTypeTextView);

        // Populate the data into the template view using the data object
        if (guide != null) {
            tvTitle.setText(guide.getTitle());
            tvType.setText(guide.getIncidentType());
        }

        // Return the completed view to render on screen
        return convertView;
    }
}
