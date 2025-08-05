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
              <div class="col-lg-3 col-6">
               <div class="small-box text-bg-danger">
                <div class="inner">
                    <h3>{{ $totalIncidents }}</h3>
                    <p>Total Incidents</p>
                </div>
                <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" d="M10.29 3.86c.77-1.33 2.66-1.33 3.43 0l7.35 12.7c.75 1.3-.2 2.93-1.72 2.93H4.66c-1.52 0-2.47-1.63-1.72-2.93l7.35-12.7zM12 9.5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0112 9.5zm0 7a.875.875 0 100-1.75.875.875 0 000 1.75z" clip-rule="evenodd"></path></svg>
               </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning">
                  <div class="inner">
                    <h3>{{ $pendingIncidents }}</h3>
                    <p>Pending</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5zM12 4.5a7.5 7.5 0 110 15 7.5 7.5 0 010-15zm.75 3a.75.75 0 00-1.5 0v5.25c0 .414.336.75.75.75h3.75a.75.75 0 000-1.5H12.75V7.5z" clip-rule="evenodd"></path></svg>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info">
                  <div class="inner">
                    <h3>{{ $activeResponseIncidents }}</h3>
                    <p>Active Response</p>
                  </div>
                  <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path d="M12 2c-.347 0-.693.076-1.013.226C9.914 2.658 9.074 3.327 8.36 4.14l-.845-.845c-.293-.293-.768-.293-1.06 0l-.707.707c-.293.293-.293.768 0 1.06l.845.845c-.813.714-1.482 1.554-1.914 2.527C2.076 11.307 2 11.653 2 12c0 .347.076.693.226 1.013.432.973 1.101 1.813 1.914 2.527l-.845.845c-.293-.293-.293.768 0 1.06l.707.707c.293.293.768.293 1.06 0l.845-.845c.714.813 1.554 1.482 2.527 1.914.32.15.666.226 1.013.226s.693-.076 1.013-.226c.973-.432 1.813-1.101 2.527-1.914l.845.845c.293.293.768.293 1.06 0l.707-.707c.293-.293.293-.768 0-1.06l-.845-.845c.813-.714 1.482-1.554 1.914-2.527.15-.32.226-.666.226-1.013s-.076-.693-.226-1.013c-.432-.973-1.101-1.813-1.914-2.527l.845-.845c.293-.293-.293-.768 0-1.06l-.707-.707c-.293-.293-.768-.293-1.06 0l-.845.845C14.074 3.327 13.234 2.658 12.261 2.226A1.5 1.5 0 0012 2zm0 6c2.209 0 4 1.791 4 4s-1.791 4-4 4-4-1.791-4-4 1.791-4 4-4z"/></svg>
                </div>
              </div>
               <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success">
                  <div class="inner">
                    <h3>{{ $resolvedIncidents }}</h3>
                    <p>Resolved</p>
                  </div>
                 <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path fill-rule="evenodd" d="M19.937 5.937a1 1 0 011.414 1.414l-10 10a1 1 0 01-1.414 0l-5-5a1 1 0 011.414-1.414L10 15.586l9.937-9.937z" clip-rule="evenodd"/></svg>
                </div>
              </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-7 col-md-12 mb-4">
                    <div class="max-w-4xl bg-white rounded-lg shadow-md p-6 ml-0 mr-auto">
                        <h1 class="text-2xl font-semibold text-gray-800 mb-2">All Incidents</h1>
                        <p class="text-gray-600 mb-6">Monitor and coordinate emergency responses</p>
                        <div class="space-y-4">
                            @forelse ($allIncidents as $incident)
                                <div class="border border-gray-200 rounded-lg p-4 flex flex-col md:flex-row justify-between gap-4">
                                    <div class="flex-grow">
                                        <div class="flex items-center gap-2 mb-2 flex-wrap">
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">{{ $incident->severity }}</span>
                                            <span class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">{{ $incident->status }}</span>
                                            <span class="text-gray-800 font-semibold text-lg">{{ $incident->incident_type }}</span>
                                        </div>
                                        <p class="text-gray-700 text-lg font-medium mb-3">{{ $incident->description }}</p>
                                        <div class="text-gray-500 text-sm flex flex-wrap items-center gap-x-4 gap-y-2 mb-3">
                                            <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657 12 22.314l-5.657-5.657a8 8 0 1 1 11.314 0Z"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 14a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/></svg> {{ $incident->location_name ?? 'N/A' }}</span>
                                            <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/></svg> {{ $incident->reported_at->format('d M Y, H:i') }}</span>
                                            <span class="flex items-center"><svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z"/></svg> {{ $incident->reporter->name ?? 'Unknown' }}</span>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0 md:self-center">
                                        <button class="px-4 py-2 rounded-md text-white font-medium shadow-sm bg-red-500 hover:bg-red-600">Assign Team</button>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-gray-500">No incidents have been reported yet.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 col-md-12">
                    <div class="bg-white rounded-lg shadow-md p-6 h-full flex flex-col">
                        <ul class="nav nav-tabs flex justify-end mb-4" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation"><button class="nav-link active" id="map-tab" data-bs-toggle="tab" data-bs-target="#map-view" type="button" role="tab">Map View</button></li>
                            <li class="nav-item" role="presentation"><button class="nav-link" id="teams-tab" data-bs-toggle="tab" data-bs-target="#response-teams" type="button" role="tab">Response Teams</button></li>
                        </ul>
                        <div class="tab-content flex-grow" id="myTabContent">
                            <div class="tab-pane fade show active" id="map-view" role="tabpanel">
                                <h2 class="text-lg font-semibold text-gray-800 mb-3">Incident Locations</h2>
                                <div id="map" class="w-full rounded-md"></div>
                            </div>
                            <div class="tab-pane fade" id="response-teams" role="tabpanel">
                                <h2 class="text-lg font-semibold text-gray-800 mb-3">Response Teams</h2>
                                <div class="space-y-3">
                                    @forelse ($responseTeams as $team)
                                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg border">
                                            <div>
                                                <p class="font-medium text-gray-800">{{ $team->name }}</p>
                                                <p class="text-sm text-gray-500">{{ $team->team_type }} &bull; {{ $team->members->count() }} members</p>
                                            </div>
                                            <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $team->status == 'Active' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">{{ $team->status }}</span>
                                        </div>
                                    @empty
                                        <p class="text-center text-gray-500">No response teams found.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </main>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize Leaflet Map
        const map = L.map('map').setView([-1.2921, 36.8219], 12); // Centered on Nairobi

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const incidentLocations = @json($incidentLocations);

        const iconMap = {
            'Pending': L.icon({ iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-red.png', shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] }),
            'Assigned': L.icon({ iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png', shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] }),
            'En Route': L.icon({ iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-orange.png', shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] }),
            'Resolved': L.icon({ iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-green.png', shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] })
        };

        incidentLocations.forEach(incident => {
            const icon = iconMap[incident.status] || L.icon({ iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-grey.png', shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png', iconSize: [25, 41], iconAnchor: [12, 41], popupAnchor: [1, -34], shadowSize: [41, 41] });
            L.marker([incident.lat, incident.lng], {icon: icon}).addTo(map)
                .bindPopup(`<b>${incident.type} (${incident.severity})</b><br>${incident.status}`);
        });
    });
</script>
@endsection
