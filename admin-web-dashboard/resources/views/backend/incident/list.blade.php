@extends('backend.layouts.app')

@section('content')

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Incident Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Incidents</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!--end::App Content Header-->

    <!--begin::App Content-->
    <div class="app-content">
        <div class="container-fluid">
            @include('_message')

            <!-- Small Box Widgets Section -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>{{ $totalIncidents }}</h3>
                            <p>Total Incidents</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M10.29 3.86c.77-1.33 2.66-1.33 3.43 0l7.35 12.7c.75 1.3-.2 2.93-1.72 2.93H4.66c-1.52 0-2.47-1.63-1.72-2.93l7.35-12.7zM12 9.5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0112 9.5zm0 7a.875.875 0 100-1.75.875.875 0 000 1.75z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>{{ $pendingIncidents }}</h3>
                            <p>Pending</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5zM12 4.5a7.5 7.5 0 110 15 7.5 7.5 0 010-15zm.75 3a.75.75 0 00-1.5 0v5.25c0 .414.336.75.75.75h3.75a.75.75 0 000-1.5H12.75V7.5z" clip-rule="evenodd"></path></svg>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info">
                        <div class="inner">
                            <h3>{{ $activeResponseIncidents }}</h3>
                            <p>Active Response</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2c-.347 0-.693.076-1.013.226C9.914 2.658 9.074 3.327 8.36 4.14l-.845-.845c-.293-.293-.768-.293-1.06 0l-.707.707c-.293.293-.293.768 0 1.06l.845.845c-.813.714-1.482 1.554-1.914 2.527C2.076 11.307 2 11.653 2 12c0 .347.076.693.226 1.013.432.973 1.101 1.813 1.914 2.527l-.845.845c-.293.293.293.768 0 1.06l.707.707c.293.293.768.293 1.06 0l.845-.845c.714.813 1.554 1.482 2.527 1.914.32.15.666.226 1.013.226s.693-.076 1.013-.226c.973-.432 1.813-1.101 2.527-1.914l.845.845c.293.293.768.293 1.06 0l.707-.707c-.293-.293-.768-.293-1.06 0l-.845.845C14.074 3.327 13.234 2.658 12.261 2.226A1.5 1.5 0 0012 2zm0 6c2.209 0 4 1.791 4 4s-1.791 4-4 4-4-1.791-4-4 1.791-4 4-4z"/></svg>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>{{ $resolvedIncidents }}</h3>
                            <p>Resolved</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M19.937 5.937a1 1 0 011.414 1.414l-10 10a1 1 0 01-1.414 0l-5-5a1 1 0 011.414-1.414L10 15.586l9.937-9.937z" clip-rule="evenodd"/></svg>
                    </div>
                </div>
            </div>

            <!-- Filter Incidents Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Incidents</h2>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <input type="text" id="search-incidents-input" placeholder="Search incidents..." class="form-input w-full sm:w-80 p-2 border border-gray-300 rounded-md">
                    <select id="status-filter" class="form-select w-full sm:w-auto p-2 border border-gray-300 rounded-md">
                        <option value="all">All Statuses</option>
                        <option value="Pending">Pending</option>
                        <option value="Assigned">Assigned</option>
                        <option value="En Route">En Route</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                    </select>
                    <select id="severity-filter" class="form-select w-full sm:w-auto p-2 border border-gray-300 rounded-md">
                        <option value="all">All Severities</option>
                        <option value="Critical">Critical</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                    </select>
                </div>
            </div>

            <!-- All Incidents Table Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">All Incidents</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Severity</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reported By</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Time</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="incidents-table-body" class="bg-white divide-y divide-gray-200">
                            @forelse ($allIncidents as $incident)
                            <tr class="incident-row" data-status="{{ $incident->status }}" data-severity="{{ $incident->severity }}">
                                <td class="px-6 py-4 whitespace-nowrap">{{ $incident->incident_type }}</td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">{{ $incident->status }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap"><span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">{{ $incident->severity }}</span></td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $incident->location_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $incident->reporter->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $incident->reported_at->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-2">
                                        <button class="assign-team-button text-purple-600 hover:text-purple-900" data-incident-id="{{ $incident->id }}" data-incident-title="{{ $incident->incident_type }} at {{ $incident->location_name }}">Assign</button>
                                        <button class="edit-incident-button text-green-600 hover:text-green-900" data-incident='@json($incident)'>Edit</button>
                                        <form action="{{ route('admin.incident.destroy', $incident->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this incident?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">No incidents found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- Assign Team Modal --}}
<div id="assign-team-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Assign Team to Incident</h3>
            <button id="close-assign-team-modal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        <p class="text-gray-700 mb-4">Select a team for incident: <span id="incident-title-assign" class="font-semibold"></span></p>
        <form id="assign-team-form" action="" method="POST">
            @csrf
            <div class="mb-4">
                <label for="team-select-assign" class="block text-sm font-medium text-gray-700 mb-1">Select Team</label>
                <select id="team-select-assign" name="team_id" class="form-select w-full p-2 border border-gray-300 rounded-md" required>
                    <option value="">Select a team</option>
                    @foreach ($responseTeams as $team)
                        <option value="{{ $team->id }}">{{ $team->name }} ({{ $team->team_type }})</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-assign-team-modal" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">Assign Team</button>
            </div>
        </form>
    </div>
</div>

{{-- Edit Incident Modal --}}
<div id="edit-incident-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Edit Incident</h3>
        <form id="edit-incident-form" action="" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="edit-incident-type" class="block text-sm font-medium text-gray-700">Incident Type</label>
                    <input type="text" id="edit-incident-type" name="incident_type" class="form-input w-full mt-1" required>
                </div>
                <div>
                    <label for="edit-location-name" class="block text-sm font-medium text-gray-700">Location</label>
                    <input type="text" id="edit-location-name" name="location_name" class="form-input w-full mt-1" required>
                </div>
                <div>
                    <label for="edit-status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select id="edit-status" name="status" class="form-select w-full mt-1">
                        <option value="Pending">Pending</option>
                        <option value="Assigned">Assigned</option>
                        <option value="En Route">En Route</option>
                        <option value="Resolved">Resolved</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <div>
                    <label for="edit-severity" class="block text-sm font-medium text-gray-700">Severity</label>
                    <select id="edit-severity" name="severity" class="form-select w-full mt-1">
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Critical">Critical</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label for="edit-description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea id="edit-description" name="description" rows="3" class="form-textarea w-full mt-1"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" id="cancel-edit-incident-modal" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-md text-white bg-green-500 hover:bg-green-600">Save Changes</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Assign Team Modal Logic ---
    const assignTeamModal = document.getElementById('assign-team-modal');
    const assignTeamForm = document.getElementById('assign-team-form');
    const incidentTitleAssignSpan = document.getElementById('incident-title-assign');

    document.querySelectorAll('.assign-team-button').forEach(button => {
        button.addEventListener('click', function() {
            const incidentId = this.dataset.incidentId;
            const incidentTitle = this.dataset.incidentTitle;

            assignTeamForm.action = `/admin/incident/${incidentId}/assign`;
            incidentTitleAssignSpan.textContent = incidentTitle;
            assignTeamModal.classList.remove('hidden');
        });
    });

    document.getElementById('close-assign-team-modal').addEventListener('click', () => assignTeamModal.classList.add('hidden'));
    document.getElementById('cancel-assign-team-modal').addEventListener('click', () => assignTeamModal.classList.add('hidden'));

    // --- Edit Incident Modal Logic ---
    const editIncidentModal = document.getElementById('edit-incident-modal');
    const editIncidentForm = document.getElementById('edit-incident-form');
    const closeEditModalButton = document.getElementById('close-edit-incident-modal');
    const cancelEditModalButton = document.getElementById('cancel-edit-incident-modal');

    document.querySelectorAll('.edit-incident-button').forEach(button => {
        button.addEventListener('click', function() {
            const incident = JSON.parse(this.dataset.incident);

            editIncidentForm.action = `/admin/incident/${incident.id}`;

            document.getElementById('edit-incident-type').value = incident.incident_type;
            document.getElementById('edit-location-name').value = incident.location_name;
            document.getElementById('edit-status').value = incident.status;
            document.getElementById('edit-severity').value = incident.severity;
            document.getElementById('edit-description').value = incident.description;

            editIncidentModal.classList.remove('hidden');
        });
    });

    closeEditModalButton.addEventListener('click', () => editIncidentModal.classList.add('hidden'));
    cancelEditModalButton.addEventListener('click', () => editIncidentModal.classList.add('hidden'));

    // --- Filtering Logic ---
    const searchInput = document.getElementById('search-incidents-input');
    const statusFilter = document.getElementById('status-filter');
    const severityFilter = document.getElementById('severity-filter');
    const tableBody = document.getElementById('incidents-table-body');
    const allRows = tableBody.querySelectorAll('.incident-row');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const severityValue = severityFilter.value;

        allRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            const rowStatus = row.dataset.status;
            const rowSeverity = row.dataset.severity;

            const matchesSearch = rowText.includes(searchTerm);
            const matchesStatus = statusValue === 'all' || rowStatus === statusValue;
            const matchesSeverity = severityValue === 'all' || rowSeverity === severityValue;

            if (matchesSearch && matchesStatus && matchesSeverity) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', filterTable);
    statusFilter.addEventListener('change', filterTable);
    severityFilter.addEventListener('change', filterTable);
});
</script>
@endsection
