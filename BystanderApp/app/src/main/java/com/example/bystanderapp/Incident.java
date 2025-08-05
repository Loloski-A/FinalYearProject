package com.example.bystanderapp;

public class Incident {
    private final String incidentType;
    private final String status;
    private final String reportedAt;
    private final String locationName;
    private final String description;
    private final String severity;

    public Incident(String incidentType, String status, String reportedAt, String locationName, String description, String severity) {
        this.incidentType = incidentType;
        this.status = status;
        this.reportedAt = reportedAt;
        this.locationName = locationName;
        this.description = description;
        this.severity = severity;
    }

    // Getters for the list view summary
    public String getIncidentType() {
        return incidentType;
    }

    public String getStatus() {
        return "Status: " + status;
    }

    public String getReportedAt() {
        return "Reported on: " + (reportedAt != null && reportedAt.length() > 10 ? reportedAt.substring(0, 10) : "N/A");
    }

    // Getters for the details dialog
    public String getFullStatus() { return "Status: " + status; }
    public String getFullReportedAt() { return "Reported: " + (reportedAt != null && reportedAt.length() > 10 ? reportedAt.substring(0, 10) : "N/A"); }
    public String getLocationName() { return "Location: " + locationName; }
    public String getDescription() { return description; }
    public String getSeverity() { return "Severity: " + severity; }
}
