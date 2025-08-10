plugins {
    alias(libs.plugins.android.application)
}

android {
    namespace = "com.example.responseteamapp"
    compileSdk = 36

    defaultConfig {
        applicationId = "com.example.responseteamapp"
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
    implementation("com.google.android.gms:play-services-maps:19.2.0")
    implementation(libs.material)
    implementation(libs.activity)
    implementation(libs.constraintlayout)
    testImplementation(libs.junit)
    androidTestImplementation(libs.ext.junit)
    androidTestImplementation(libs.espresso.core)

    // ADDED: Volley for network requests
    implementation("com.android.volley:volley:1.2.1")

    implementation("androidx.core:core-splashscreen:1.0.1")
}
