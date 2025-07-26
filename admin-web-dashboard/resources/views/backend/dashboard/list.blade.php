@extends('backend.layouts.app')

@section('content')

      <!--begin::App Main-->
      <main class="app-main">
        <!--begin::App Content Header-->
        <div class="app-content-header">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <div class="col-sm-6"><h3 class="mb-0">Dashboard</h3></div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
              </div>
            </div>
            <!--end::Row-->
          </div>
          <!--end::Container-->
        </div>
        <!--end::App Content Header-->
        <!--begin::App Content-->
        <div class="app-content">
          <!--begin::Container-->
          <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
              <!--begin::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 1-->
               <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>3</h3>
                    <p>Total Incidents</p>
                </div>
                <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                >
                    <path
                    fill-rule="evenodd"
                    d="M10.29 3.86c.77-1.33 2.66-1.33 3.43 0l7.35 12.7c.75 1.3-.2 2.93-1.72 2.93H4.66c-1.52 0-2.47-1.63-1.72-2.93l7.35-12.7zM12 9.5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0112 9.5zm0 7a.875.875 0 100-1.75.875.875 0 000 1.75z"
                    clip-rule="evenodd"
                    ></path>
                </svg>
                </div>
                <!--end::Small Box Widget 1-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 2-->
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>1</h3>
                    <p>Pending</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    >
                    <path
                        fill-rule="evenodd"
                        d="M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5zM12 4.5a7.5 7.5 0 110 15 7.5 7.5 0 010-15zm.75 3a.75.75 0 00-1.5 0v5.25c0 .414.336.75.75.75h3.75a.75.75 0 000-1.5H12.75V7.5z"
                        clip-rule="evenodd"
                    ></path>
                 </svg>
                </div>
                <!--end::Small Box Widget 2-->
              </div>
              <!--end::Col-->
              <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-info">
                  <div class="inner">
                    <h3>2</h3>
                    <p>Active Response</p>
                  </div>
                  <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    >
                    <path
                        d="M12 2c-.347 0-.693.076-1.013.226C9.914 2.658 9.074 3.327 8.36 4.14l-.845-.845c-.293-.293-.768-.293-1.06 0l-.707.707c-.293.293-.293.768 0 1.06l.845.845c-.813.714-1.482 1.554-1.914 2.527C2.076 11.307 2 11.653 2 12c0 .347.076.693.226 1.013.432.973 1.101 1.813 1.914 2.527l-.845.845c-.293.293-.293.768 0 1.06l.707.707c-.293.293-.768.293 0 1.06l.845-.845c.714.813 1.554 1.482 2.527 1.914.32.15.666.226 1.013.226s.693-.076 1.013-.226c.973-.432 1.813-1.101 2.527-1.914l.845.845c.293.293.768.293 1.06 0l.707-.707c.293-.293.293-.768 0-1.06l-.845-.845c.813-.714 1.482-1.554 1.914-2.527.15-.32.226-.666.226-1.013s-.076-.693-.226-1.013c-.432-.973-1.101-1.813-1.914-2.527l.845-.845c.293-.293.293-.768 0-1.06l-.707-.707c-.293-.293-.768-.293-1.06 0l-.845.845C14.074 3.327 13.234 2.658 12.261 2.226A1.5 1.5 0012 2zm0 6c2.209 0 4 1.791 4 4s-1.791 4-4 4-4-1.791-4-4 1.791-4 4-4z"
                    />
                  </svg>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
               <div class="col-lg-3 col-6">
                <!--begin::Small Box Widget 4-->
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>0</h3>
                    <p>Resolved</p>
                  </div>
                 <svg
                    class="small-box-icon"
                    fill="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true"
                    >
                    <path
                        fill-rule="evenodd"
                        d="M19.937 5.937a1 1 0 011.414 1.414l-10 10a1 1 0 01-1.414 0l-5-5a1 1 0 011.414-1.414L10 15.586l9.937-9.937z"
                        clip-rule="evenodd"
                    />
                 </svg>
                </div>
                <!--end::Small Box Widget 4-->
              </div>
              <!--end::Col-->
            </div>
            <!--end::Row-->

            <!-- Main Content Row: Active Incidents and Map/Teams -->
                <div class="row mt-4">
                    <!-- Active Incidents Section (now col-lg-7) -->
                    <div class="col-lg-7 col-md-12 mb-4"> {{-- Added mb-4 for spacing on smaller screens --}}
                        <div class="max-w-4xl bg-white rounded-lg shadow-md p-6 ml-0 mr-auto">
                            <!-- Header section -->
                            <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800 mb-2">Active Incidents</h1>
                            <p class="text-gray-600 mb-6">Monitor and coordinate emergency responses</p>

                            <!-- Incident list container -->
                            <div class="space-y-4">
                                <!-- Incident Card 1: Critical Fire -->
                                <div class="border border-gray-200 rounded-lg p-4 sm:p-6 flex flex-col md:flex-row md:items-start justify-between gap-4">
                                    <div class="flex-grow">
                                        <!-- Status and Assignment Tags -->
                                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">CRITICAL</span>
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">PENDING</span>
                                            <span class="text-gray-800 font-semibold text-base sm:text-lg">Fire</span>
                                        </div>

                                        <!-- Incident Description -->
                                        <p class="text-gray-700 text-base sm:text-lg font-medium mb-3">Building fire on 3rd floor, people trapped</p>

                                        <!-- Incident Details (Location, Date/Time, Reporter) -->
                                        <div class="text-gray-500 text-sm flex flex-wrap items-center gap-x-4 gap-y-2 mb-3">
                                            <span class="flex items-center">
                                                <!-- Location Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                Westlands, Nairobi
                                            </span>
                                            <span class="flex items-center">
                                                <!-- Date/Time Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                2024-01-15 14:30
                                            </span>
                                            <span class="flex items-center">
                                                <!-- Reporter Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                John Doe
                                            </span>
                                        </div>

                                        <!-- Assigned To information (if available) - Not present for this incident -->
                                    </div>

                                    <!-- Action Button -->
                                    <div class="flex-shrink-0 md:self-center">
                                        <button class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-red-500 hover:bg-red-600">
                                            Assign Team
                                        </button>
                                    </div>
                                </div>

                                <!-- Incident Card 2: High Accident -->
                                <div class="border border-gray-200 rounded-lg p-4 sm:p-6 flex flex-col md:flex-row md:items-start justify-between gap-4">
                                    <div class="flex-grow">
                                        <!-- Status and Assignment Tags -->
                                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800">HIGH</span>
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">ASSIGNED</span>
                                            <span class="text-gray-800 font-semibold text-base sm:text-lg">Accident</span>
                                        </div>

                                        <!-- Incident Description -->
                                        <p class="text-gray-700 text-base sm:text-lg font-medium mb-3">Multi-vehicle collision, injuries reported</p>

                                        <!-- Incident Details (Location, Date/Time, Reporter) -->
                                        <div class="text-gray-500 text-sm flex flex-wrap items-center gap-x-4 gap-y-2 mb-3">
                                            <span class="flex items-center">
                                                <!-- Location Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                Uhuru Highway
                                            </span>
                                            <span class="flex items-center">
                                                <!-- Date/Time Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                2024-01-15 14:45
                                            </span>
                                            <span class="flex items-center">
                                                <!-- Reporter Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                Jane Smith
                                            </span>
                                        </div>

                                        <!-- Assigned To information -->
                                        <div class="text-blue-600 text-sm flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857m7.443 0H17V4a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h2.5M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h2.5"></path></svg>
                                            Assigned to: <span class="font-medium ml-1">Ambulance Unit 3</span>
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="flex-shrink-0 md:self-center">
                                        <button class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-blue-500 hover:bg-blue-600">
                                            Mark En Route
                                        </button>
                                    </div>
                                </div>

                                <!-- Incident Card 3: Medium Flood -->
                                <div class="border border-gray-200 rounded-lg p-4 sm:p-6 flex flex-col md:flex-row md:items-start justify-between gap-4">
                                    <div class="flex-grow">
                                        <!-- Status and Assignment Tags -->
                                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">MEDIUM</span>
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">ENROUTE</span>
                                            <span class="text-gray-800 font-semibold text-base sm:text-lg">Flood</span>
                                        </div>

                                        <!-- Incident Description -->
                                        <p class="text-gray-700 text-base sm:text-lg font-medium mb-3">Flash flooding affecting residential area</p>

                                        <!-- Incident Details (Location, Date/Time, Reporter) -->
                                        <div class="text-gray-500 text-sm flex flex-wrap items-center gap-x-4 gap-y-2 mb-3">
                                            <span class="flex items-center">
                                                <!-- Location Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                                Mathare
                                            </span>
                                            <span class="flex items-center">
                                                <!-- Date/Time Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                2024-01-15 13:15
                                            </span>
                                            <span class="flex items-center">
                                                <!-- Reporter Icon -->
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                                Community Leader
                                            </span>
                                        </div>

                                        <!-- Assigned To information -->
                                        <div class="text-blue-600 text-sm flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H2v-2a3 3 0 015.356-1.857m7.443 0H17V4a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h2.5M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h2.5"></path></svg>
                                            Assigned to: <span class="font-medium ml-1">Rescue Team Alpha</span>
                                        </div>
                                    </div>

                                    <!-- Action Button -->
                                    <div class="flex-shrink-0 md:self-center">
                                        <button class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-green-500 hover:bg-green-600">
                                            Mark Resolved
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Map View and Response Teams Section (new col-lg-5) -->
                    <div class="col-lg-5 col-md-12">
                        <div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col">
                            <!-- Tab Navigation -->
                            <ul class="nav nav-tabs flex justify-end mb-4" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active px-4 py-2 text-sm font-medium text-gray-700 rounded-t-lg hover:text-blue-600 focus:outline-none" id="map-tab" data-bs-toggle="tab" data-bs-target="#map-view" type="button" role="tab" aria-controls="map-view" aria-selected="true">Map View</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link px-4 py-2 text-sm font-medium text-gray-700 rounded-t-lg hover:text-blue-600 focus:outline-none" id="teams-tab" data-bs-toggle="tab" data-bs-target="#response-teams" type="button" role="tab" aria-controls="response-teams" aria-selected="false">Response Teams</button>
                                </li>
                            </ul>

                            <!-- Tab Content -->
                            <div class="tab-content flex-grow" id="myTabContent">
                                <!-- Map View Tab Pane -->
                                <div class="tab-pane fade show active" id="map-view" role="tabpanel" aria-labelledby="map-tab">
                                    <h2 class="text-lg font-semibold text-gray-800 mb-3">Incident Locations</h2>
                                    <p class="text-gray-600 text-sm mb-4">Real-time incident mapping for Nairobi</p>
                                    <div class="relative w-full h-64 bg-gray-200 rounded-md overflow-hidden flex items-center justify-center">
                                        {{-- Placeholder for a map. In a real application, you'd integrate a map library like Leaflet.js or Google Maps API here. --}}
                                        <img src="https://placehold.co/400x256/E0E0E0/333333?text=Map+Placeholder" alt="Map Placeholder" class="w-full h-full object-cover">
                                        <div class="absolute top-2 right-2 bg-white p-2 rounded-md shadow-sm text-sm text-gray-700">
                                            Nairobi, Kenya<br>
                                            1.2921° S, 36.8219° E
                                        </div>
                                        {{-- Map Markers/Icons (example positions) --}}
                                        <div class="absolute" style="top: 30%; left: 20%;">
                                            <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
                                        </div>
                                        <div class="absolute" style="top: 60%; left: 70%;">
                                            <svg class="w-6 h-6 text-orange-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
                                        </div>
                                        <div class="absolute" style="top: 80%; left: 40%;">
                                            <svg class="w-6 h-6 text-yellow-500" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5S10.62 6.5 12 6.5s2.5 1.12 2.5 2.5S13.38 11.5 12 11.5z"/></svg>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h3 class="text-md font-semibold text-gray-800 mb-2">Legend</h3>
                                        <div class="flex flex-wrap gap-x-4 gap-y-2 text-sm text-gray-700">
                                            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-red-500 mr-2"></span>Pending</span>
                                            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-blue-500 mr-2"></span>Assigned</span>
                                            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-orange-500 mr-2"></span>En Route</span>
                                            <span class="flex items-center"><span class="w-3 h-3 rounded-full bg-green-500 mr-2"></span>Resolved</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Response Teams Tab Pane -->
                                <div class="tab-pane fade" id="response-teams" role="tabpanel" aria-labelledby="teams-tab">
                                    <!-- Quick Assignment Section -->
                                    <div class="mb-6 pb-4 border-b border-gray-200">
                                        <h2 class="text-lg font-semibold text-gray-800 mb-2 flex items-center">
                                            <svg class="w-5 h-5 mr-2 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                            Quick Assignment
                                        </h2>
                                        <p class="text-gray-600 text-sm mb-3">Assign teams to pending incidents</p>
                                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 relative">
                                            <p class="font-medium text-gray-800 mb-2">Building fire on 3rd floor, people trapped</p>
                                            <p class="text-sm text-gray-500 mb-3">Westlands, Nairobi</p>

                                            {{-- Custom Select Dropdown --}}
                                            <div class="custom-select-wrapper">
                                                <div class="custom-select-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                                                    <span id="selected-team-display" class="flex items-center">Select team</span>
                                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                                                </div>
                                                <div class="custom-options absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                                    <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="1">
                                                        <span class="inline-flex items-center">
                                                            <svg class="w-5 h-5 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M19 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6.5 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM5 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm14-5H5c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 12H5V7h14v10z"/>
                                                            </svg>
                                                            Fire Brigade Alpha
                                                        </span>
                                                    </div>
                                                    <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="4">
                                                        <span class="inline-flex items-center">
                                                            <svg class="w-5 h-5 text-purple-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                            </svg>
                                                            Police Unit 7
                                                        </span>
                                                    </div>
                                                    <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="5">
                                                        <span class="inline-flex items-center">
                                                            <svg class="w-5 h-5 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/>
                                                            </svg>
                                                            Medical Team Beta
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Hidden native select to store value if needed for form submission --}}
                                            <select id="hidden-team-select" name="assigned_team_id" class="hidden">
                                                <option value="">Select team</option>
                                                <option value="1">Fire Brigade Alpha</option>
                                                <option value="4">Police Unit 7</option>
                                                <option value="5">Medical Team Beta</option>
                                            </select>
                                        </div>
                                    </div>

                                    <h2 class="text-lg font-semibold text-gray-800 mb-3 flex items-center">
                                        <svg class="w-5 h-5 mr-2 text-gray-700" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                        Response Teams
                                    </h2>
                                    <p class="text-gray-600 text-sm mb-4">Current status of all emergency response teams</p>
                                    <div class="space-y-3">
                                        <!-- Team Card 1: Fire Brigade Alpha -->
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center">
                                                <svg class="w-7 h-7 text-red-500 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M19 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6.5 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM5 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm14-5H5c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 12H5V7h14v10z"/>
                                                </svg>
                                                <div>
                                                    <p class="font-medium text-gray-800">Fire Brigade Alpha</p>
                                                    <p class="text-sm text-gray-500">Central Station &bull; 8 members</p>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-800">AVAILABLE</span>
                                        </div>
                                        <!-- Team Card 2: Ambulance Unit 3 -->
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center">
                                                <svg class="w-7 h-7 text-blue-500 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12-4c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5V4h14v16z"/>
                                                </svg>
                                                <div>
                                                    <p class="font-medium text-gray-800">Ambulance Unit 3</p>
                                                    <p class="text-sm text-gray-500">En route to Uhuru Highway &bull; 3 members &bull; ETA: 5 min</p>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-200 text-orange-800">BUSY</span>
                                        </div>
                                        <!-- Team Card 3: Rescue Team Alpha -->
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center">
                                                <svg class="w-7 h-7 text-green-500 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/>
                                                </svg>
                                                <div>
                                                    <p class="font-medium text-gray-800">Rescue Team Alpha</p>
                                                    <p class="text-sm text-gray-500">Mathare &bull; 6 members &bull; ETA: 12 min</p>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-orange-200 text-orange-800">BUSY</span>
                                        </div>
                                        <!-- Team Card 4: Police Unit 7 -->
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center">
                                                <svg class="w-7 h-7 text-purple-500 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                                </svg>
                                                <div>
                                                    <p class="font-medium text-gray-800">Police Unit 7</p>
                                                    <p class="text-sm text-gray-500">Westlands &bull; 4 members</p>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-800">AVAILABLE</span>
                                        </div>
                                        <!-- Team Card 5: Medical Team Beta -->
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border border-gray-200">
                                            <div class="flex items-center">
                                                <svg class="w-7 h-7 text-red-500 mr-3" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/>
                                                </svg>
                                                <div>
                                                    <p class="font-medium text-gray-800">Medical Team Beta</p>
                                                    <p class="text-sm text-gray-500">Kenyatta Hospital &bull; 5 members</p>
                                                </div>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-200 text-green-800">AVAILABLE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Main Content Row-->
        </div>
        <!--end::App Content Header-->
      </main>
      <!--end::App Main-->
          {{-- JavaScript for Custom Select --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const customSelectTrigger = document.querySelector('.custom-select-trigger');
            const customOptions = document.querySelector('.custom-options');
            const selectedTeamDisplay = document.getElementById('selected-team-display');
            const hiddenTeamSelect = document.getElementById('hidden-team-select');

            // Toggle dropdown visibility
            customSelectTrigger.addEventListener('click', function() {
                customOptions.classList.toggle('hidden');
            });

            // Handle option selection
            customOptions.querySelectorAll('.custom-option').forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const textContent = this.innerHTML; // Get the full HTML content including SVG

                    selectedTeamDisplay.innerHTML = textContent; // Set the display with icon and text
                    hiddenTeamSelect.value = value; // Update the hidden native select for form submission
                    customOptions.classList.add('hidden'); // Hide dropdown
                });
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!customSelectTrigger.contains(event.target) && !customOptions.contains(event.target)) {
                    customOptions.classList.add('hidden');
                }
            });
        });
    </script>

@endsection
