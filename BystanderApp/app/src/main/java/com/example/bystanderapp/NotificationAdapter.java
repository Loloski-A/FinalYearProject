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

public class NotificationAdapter extends ArrayAdapter<Notification> {

    public NotificationAdapter(@NonNull Context context, List<Notification> notifications) {
        super(context, 0, notifications);
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        Notification notification = getItem(position);

        if (convertView == null) {
            convertView = LayoutInflater.from(getContext()).inflate(R.layout.list_item_notification, parent, false);
        }

        TextView tvTitle = convertView.findViewById(R.id.notificationTitleTextView);
        TextView tvMessage = convertView.findViewById(R.id.notificationMessageTextView);

        if (notification != null) {
            tvTitle.setText(notification.getTitle());
            tvMessage.setText(notification.getMessage());
        }

        return convertView;
    }
}
