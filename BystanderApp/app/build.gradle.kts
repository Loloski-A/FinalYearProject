// app/build.gradle.kts

plugins {
    alias(libs.plugins.android.application)
}

android {
    namespace = "com.example.bystanderapp"
    compileSdk = 36

    defaultConfig {
        applicationId = "com.example.bystanderapp"
        minSdk = 24
        targetSdk = 36
        versionCode = 1
        versionName = "1.0"

        testInstrumentationRunner = "androidx.test.runner.AndroidJUnitRunner"
    }

    buildTypes {
        release {
            isMinifyEnabled = false
            proguardFiles(
                getDefaultProguardFile("proguard-android-optimize.txt"),
                "proguard-rules.pro"
            )
        }
    }
    compileOptions {
        sourceCompatibility = JavaVersion.VERSION_1_8
        targetCompatibility = JavaVersion.VERSION_1_8
    }
}

dependencies {

    implementation(libs.appcompat)
    implementation(libs.material)
    implementation(libs.activity)
    implementation(libs.constraintlayout)
    testImplementation(libs.junit)
    androidTestImplementation(libs.ext.junit)
    androidTestImplementation(libs.espresso.core)

    // Volley library for network requests
    implementation("com.android.volley:volley:1.2.1")

    // UPDATED: Added Google Play Services Location dependency
    implementation("com.google.android.gms:play-services-location:21.3.0")

    // *** Google Maps SDK ***
    implementation("com.google.android.gms:play-services-maps:19.2.0")
}
