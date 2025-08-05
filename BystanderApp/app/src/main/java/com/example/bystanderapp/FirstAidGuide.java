package com.example.bystanderapp;

public class FirstAidGuide {
    private final String title;
    private final String content;
    private final String incidentType;

    public FirstAidGuide(String title, String content, String incidentType) {
        this.title = title;
        this.content = content;
        this.incidentType = incidentType;
    }

    public String getTitle() {
        return title;
    }

    public String getContent() {
        return content;
    }

    public String getIncidentType() {
        return "For: " + incidentType;
    }

    // Override toString() so that the ArrayAdapter's default filter works on the title
    @Override
    public String toString() {
        return title;
    }
}
