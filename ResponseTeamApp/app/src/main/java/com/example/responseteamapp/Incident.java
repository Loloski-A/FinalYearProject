package com.example.responseteamapp;

import java.io.Serializable;

public class Incident implements Serializable {
    private final int id;
    private final String incidentType;
    private final String status;
    private final String description;
    private final String locationName;
    private final double latitude;
    private final double longitude;
    private final String reportedAt;
    private final String reporterName; // ADDED: Field for the reporter's name

    public Incident(int id, String incidentType, String status, String description, String locationName, double latitude, double longitude, String reportedAt, String reporterName) {
        this.id = id;
        this.incidentType = incidentType;
        this.status = status;
        this.description = description;
        this.locationName = locationName;
        this.latitude = latitude;
        this.longitude = longitude;
        this.reportedAt = reportedAt;
        this.reporterName = reporterName; // ADDED: Initialize the reporter's name
    }

    // Getters for all fields
    public int getId() { return id; }
    public String getIncidentType() { return incidentType; }
    public String getStatus() { return status; }
    public String getDescription() { return description; }
    public String getLocationName() { return locationName; }
    public double getLatitude() { return latitude; }
    public double getLongitude() { return longitude; }
    public String getReportedAt() { return reportedAt; }
    public String getReporterName() { return reporterName; } // ADDED: Getter for the reporter's name
}
