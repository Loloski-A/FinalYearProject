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
                <div class="col-sm-6">
                    <h3 class="mb-0">Incident Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Incidents</li>
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

            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">Incident Management</h1>
                    <p class="text-gray-600">Monitor, track and manage all emergency incidents</p>
                </div>
                {{-- The "Create Incident" button section has been removed as requested. --}}
            </div>

            <!-- Small Box Widgets Section -->
            <div class="row mb-4">
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-danger">
                        <div class="inner">
                            <h3>3</h3>
                            <p>Total Incidents</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10.29 3.86c.77-1.33 2.66-1.33 3.43 0l7.35 12.7c.75 1.3-.2 2.93-1.72 2.93H4.66c-1.52 0-2.47-1.63-1.72-2.93l7.35-12.7zM12 9.5a.75.75 0 01.75.75v3.5a.75.75 0 01-1.5 0v-3.5A.75.75 0 0112 9.5zm0 7a.875.875 0 100-1.75.875.875 0 000 1.75z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-warning">
                        <div class="inner">
                            <h3>1</h3>
                            <p>Pending</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12 2.25a9.75 9.75 0 100 19.5 9.75 9.75 0 000-19.5zM12 4.5a7.5 7.5 0 110 15 7.5 7.5 0 010-15zm.75 3a.75.75 0 00-1.5 0v5.25c0 .414.336.75.75.75h3.75a.75.75 0 000-1.5H12.75V7.5z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-info">
                        <div class="inner">
                            <h3>2</h3>
                            <p>Active Response</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path d="M12 2c-.347 0-.693.076-1.013.226C9.914 2.658 9.074 3.327 8.36 4.14l-.845-.845c-.293-.293-.768-.293-1.06 0l-.707.707c-.293.293-.293.768 0 1.06l.845.845c-.813.714-1.482 1.554-1.914 2.527C2.076 11.307 2 11.653 2 12c0 .347.076.693.226 1.013.432.973 1.101 1.813 1.914 2.527l-.845.845c-.293.293-.293.768 0 1.06l.707.707c-.293.293-.293.768 0 1.06l.845-.845c.714.813 1.554 1.482 2.527 1.914.32.15.666.226 1.013.226s.693-.076 1.013-.226c.973-.432 1.813-1.101 2.527-1.914l.845.845c.293.293.768.293 1.06 0l.707-.707c-.293-.293-.768-.293-1.06 0l-.845.845C14.074 3.327 13.234 2.658 12.261 2.226A1.5 1.5 0012 2zm0 6c2.209 0 4 1.791 4 4s-1.791 4-4 4-4-1.791-4-4 1.791-4 4-4z"/>
                        </svg>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box text-bg-success">
                        <div class="inner">
                            <h3>0</h3>
                            <p>Resolved</p>
                        </div>
                        <svg class="small-box-icon" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path fill-rule="evenodd" d="M19.937 5.937a1 1 0 011.414 1.414l-10 10a1 1 0 01-1.414 0l-5-5a1 1 0 011.414-1.414L10 15.586l9.937-9.937z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filter Incidents Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Incidents</h2>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative w-full sm:w-80">
                        {{-- Increased pl-10 to pl-11 for more space --}}
                        <input type="text" id="search-incidents-input" placeholder="Search incidents..." class="form-input w-full p-2 pl-10 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto sm:ml-auto">
                        {{-- Custom Select for All Status --}}
                        <div class="custom-select-wrapper relative w-full sm:w-36">
                            <div class="custom-select-trigger status-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                                <span id="selected-status-display" class="flex items-center">All Status</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div class="custom-options status-options absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="all" data-display="All Status">
                                    <span class="inline-flex items-center">All Status</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="pending" data-display="Pending">
                                    <span class="inline-flex items-center">Pending</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="assigned" data-display="Assigned">
                                    <span class="inline-flex items-center">Assigned</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="enroute" data-display="En Route">
                                    <span class="inline-flex items-center">En Route</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="resolved" data-display="Resolved">
                                    <span class="inline-flex items-center">Resolved</span>
                                </div>
                            </div>
                            <select id="hidden-status-select" name="status_filter" class="hidden">
                                <option value="all">All Status</option>
                                <option value="pending">Pending</option>
                                <option value="assigned">Assigned</option>
                                <option value="enroute">En Route</option>
                                <option value="resolved">Resolved</option>
                            </select>
                        </div>

                        {{-- Custom Select for All Severity --}}
                        <div class="custom-select-wrapper relative w-full sm:w-36">
                            <div class="custom-select-trigger severity-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                                <span id="selected-severity-display" class="flex items-center">All Severity</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div class="custom-options severity-options absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="all" data-display="All Severity">
                                    <span class="inline-flex items-center">All Severity</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="critical" data-display="Critical">
                                    <span class="inline-flex items-center">Critical</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="high" data-display="High">
                                    <span class="inline-flex items-center">High</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="medium" data-display="Medium">
                                    <span class="inline-flex items-center">Medium</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="low" data-display="Low">
                                    <span class="inline-flex items-center">Low</span>
                                </div>
                            </div>
                            <select id="hidden-severity-select" name="severity_filter" class="hidden">
                                <option value="all">All Severity</option>
                                <option value="critical">Critical</option>
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Incidents Table Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">All Incidents</h2>
                <p id="incident-count-display" class="text-gray-600 text-sm mb-4">Showing 3 of 3 incidents</p>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Severity</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Reported By</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="incidents-table-body" class="bg-white divide-y divide-gray-200">
                            {{-- Incident rows will be dynamically inserted here by JavaScript --}}
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
</main>
<!--end::App Main-->

{{-- View Incident Details Modal --}}
<div id="view-incident-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Incident Details</h3>
            <button id="close-view-incident-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="space-y-4">
            <div>
                <p class="text-sm font-medium text-gray-700">Type:</p>
                <p id="view-incident-type" class="text-gray-900 text-lg font-semibold"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Status:</p>
                <p id="view-incident-status" class="text-gray-900 text-lg font-semibold"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Severity:</p>
                <p id="view-incident-severity" class="text-gray-900 text-lg font-semibold"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Location:</p>
                <p id="view-incident-location" class="text-gray-900 text-lg font-semibold"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Reported By:</p>
                <p id="view-incident-reported-by" class="text-gray-900 text-lg font-semibold"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Time:</p>
                <p id="view-incident-time" class="text-gray-900 text-lg font-semibold"></p>
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="button" id="close-view-incident-modal-bottom" class="px-4 py-2 rounded-md text-gray-700 font-medium shadow-sm transition-colors duration-200 bg-gray-200 hover:bg-gray-300">
                Close
            </button>
        </div>
    </div>
</div>

{{-- Edit Incident Modal --}}
<div id="edit-incident-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Edit Incident</h3>
            <button id="close-edit-incident-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form id="edit-incident-form" action="#" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" id="edit-incident-id" name="incident_id">
            <div class="mb-4">
                <label for="edit-incident-type" class="block text-sm font-medium text-gray-700 mb-1">Incident Type</label>
                <input type="text" id="edit-incident-type" name="type" class="form-input w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="edit-incident-status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <div class="custom-select-wrapper relative">
                    <div class="custom-select-trigger edit-status-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <span id="selected-edit-status-display" class="flex items-center">Select Status</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="custom-options edit-status-options absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="pending" data-display="Pending">
                            <span class="inline-flex items-center">Pending</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="assigned" data-display="Assigned">
                            <span class="inline-flex items-center">Assigned</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="enroute" data-display="En Route">
                            <span class="inline-flex items-center">En Route</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="resolved" data-display="Resolved">
                            <span class="inline-flex items-center">Resolved</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="active" data-display="Active">
                            <span class="inline-flex items-center">Active</span>
                        </div>
                    </div>
                    <select id="hidden-edit-status-select" name="status" class="hidden">
                        <option value="pending">Pending</option>
                        <option value="assigned">Assigned</option>
                        <option value="enroute">En Route</option>
                        <option value="resolved">Resolved</option>
                        <option value="active">Active</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="edit-incident-severity" class="block text-sm font-medium text-gray-700 mb-1">Severity</label>
                <div class="custom-select-wrapper relative">
                    <div class="custom-select-trigger edit-severity-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <span id="selected-edit-severity-display" class="flex items-center">Select Severity</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="custom-options edit-severity-options absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="critical" data-display="Critical">
                            <span class="inline-flex items-center">Critical</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="high" data-display="High">
                            <span class="inline-flex items-center">High</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="medium" data-display="Medium">
                            <span class="inline-flex items-center">Medium</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="low" data-display="Low">
                            <span class="inline-flex items-center">Low</span>
                        </div>
                    </div>
                    <select id="hidden-edit-severity-select" name="severity" class="hidden">
                        <option value="critical">Critical</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="edit-incident-location" class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                <input type="text" id="edit-incident-location" name="location" class="form-input w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="edit-incident-reported-by" class="block text-sm font-medium text-gray-700 mb-1">Reported By</label>
                <input type="text" id="edit-incident-reported-by" name="reported_by" class="form-input w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-6">
                <label for="edit-incident-time" class="block text-sm font-medium text-gray-700 mb-1">Time</label>
                <input type="text" id="edit-incident-time" name="time" class="form-input w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="YYYY-MM-DD HH:MM" required>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-edit-incident-modal" class="px-4 py-2 rounded-md text-gray-700 font-medium shadow-sm transition-colors duration-200 bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-green-500 hover:bg-green-600">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="delete-confirm-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-sm mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Confirm Deletion</h3>
            <button id="close-delete-confirm-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <p class="text-gray-700 mb-6">Are you sure you want to delete this incident? This action cannot be undone.</p>
        <div class="flex justify-end space-x-3">
            <button type="button" id="cancel-delete-confirm-modal" class="px-4 py-2 rounded-md text-gray-700 font-medium shadow-sm transition-colors duration-200 bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>
            <button type="button" id="confirm-delete-button" class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-red-500 hover:bg-red-600">
                Delete
            </button>
        </div>
    </div>
</div>

{{-- Assign Team Modal --}}
<div id="assign-team-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Assign Team to Incident</h3>
            <button id="close-assign-team-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <p class="text-gray-700 mb-4">Select a team to assign to incident: <span id="incident-title-assign" class="font-semibold"></span></p>
        <form id="assign-team-form" action="#" method="POST">
            @csrf
            <input type="hidden" id="assign-incident-id" name="incident_id">
            <div class="mb-4">
                <label for="team-select-assign" class="block text-sm font-medium text-gray-700 mb-1">Select Team</label>
                <div class="custom-select-wrapper relative">
                    <div class="custom-select-trigger assign-team-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <span id="selected-assign-team-display" class="flex items-center">Select a team</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="custom-options assign-team-options absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="" data-display="Select a team">
                            <span class="inline-flex items-center">Select a team</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Fire Brigade Alpha" data-display="Fire Brigade Alpha">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M19 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6.5 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM5 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm14-5H5c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 12H5V7h14v10z"/>
                                </svg>
                                Fire Brigade Alpha
                            </span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Ambulance Unit 3" data-display="Ambulance Unit 3">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 text-blue-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12-4c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5V4h14v16z"/>
                                </svg>
                                Ambulance Unit 3
                            </span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Rescue Team Alpha" data-display="Rescue Team Alpha">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/>
                                </svg>
                                Rescue Team Alpha
                            </span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Police Unit 7" data-display="Police Unit 7">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 text-purple-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                Police Unit 7
                            </span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Medical Team Beta" data-display="Medical Team Beta">
                            <span class="inline-flex items-center">
                                <svg class="w-5 h-5 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/>
                                </svg>
                                Medical Team Beta
                            </span>
                        </div>
                    </div>
                    <select id="hidden-assign-team-select" name="assigned_team" class="hidden">
                        <option value="">Select a team</option>
                        <option value="Fire Brigade Alpha">Fire Brigade Alpha</option>
                        <option value="Ambulance Unit 3">Ambulance Unit 3</option>
                        <option value="Rescue Team Alpha">Rescue Team Alpha</option>
                        <option value="Police Unit 7">Police Unit 7</option>
                        <option value="Medical Team Beta">Medical Team Beta</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-assign-team-modal" class="px-4 py-2 rounded-md text-gray-700 font-medium shadow-sm transition-colors duration-200 bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-blue-500 hover:bg-blue-600">
                    Assign Team
                </button>
            </div>
        </form>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // --- Data Storage (Hardcoded for demonstration) ---
        // In a real application, this data would come from your backend (e.g., Laravel API)
        let allIncidents = [
            {
                id: 1,
                type: "Fire",
                status: "pending",
                severity: "critical",
                location: "Westlands, Nairobi",
                reportedBy: "John Doe",
                time: "2024-01-15 14:30"
            },
            {
                id: 2,
                type: "Accident",
                status: "assigned",
                severity: "high",
                location: "Uhuru Highway",
                reportedBy: "Jane Smith",
                time: "2024-01-15 14:45"
            },
            {
                id: 3,
                type: "Flood",
                status: "enroute",
                severity: "medium",
                location: "Mathare",
                reportedBy: "Community Leader",
                time: "2024-01-15 13:15"
            },
            {
                id: 4,
                type: "Medical",
                status: "resolved",
                severity: "low",
                location: "CBD, Nairobi",
                reportedBy: "Paramedic Team",
                time: "2024-01-15 12:00"
            },
            {
                id: 5,
                type: "Fire",
                status: "active",
                severity: "high",
                location: "Kasarani, Nairobi",
                reportedBy: "Local Resident",
                time: "2024-01-16 09:00"
            }
        ];

        const incidentsTableBody = document.getElementById('incidents-table-body');
        const incidentCountDisplay = document.getElementById('incident-count-display');
        const searchIncidentsInput = document.getElementById('search-incidents-input');

        // --- Function to Render Incidents to the Table ---
        function renderIncidents(incidentsToRender) {
            incidentsTableBody.innerHTML = ''; // Clear existing rows
            if (incidentsToRender.length === 0) {
                incidentsTableBody.innerHTML = `<tr><td colspan="7" class="px-6 py-4 text-center text-gray-500">No incidents found matching your criteria.</td></tr>`;
            }

            incidentsToRender.forEach(incident => {
                const row = document.createElement('tr');
                row.setAttribute('data-incident-id', incident.id);
                row.setAttribute('data-type', incident.type);
                row.setAttribute('data-status', incident.status);
                row.setAttribute('data-severity', incident.severity);
                row.setAttribute('data-location', incident.location);
                row.setAttribute('data-reported-by', incident.reportedBy);
                row.setAttribute('data-time', incident.time);

                // Determine icon and color based on incident type
                let typeIconSvg = '';
                switch (incident.type) {
                    case 'Fire':
                        typeIconSvg = `<svg class="w-6 h-6 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/></svg>`;
                        break;
                    case 'Accident':
                        typeIconSvg = `<svg class="w-6 h-6 text-blue-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12-4c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5V4h14v16z"/></svg>`;
                        break;
                    case 'Flood':
                        typeIconSvg = `<svg class="w-6 h-6 text-yellow-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/></svg>`;
                        break;
                    case 'Medical':
                        typeIconSvg = `<svg class="w-6 h-6 text-green-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/></svg>`;
                        break;
                }

                // Determine status badge color
                let statusBadgeClass = '';
                switch (incident.status) {
                    case 'pending':
                        statusBadgeClass = 'bg-yellow-100 text-yellow-800';
                        break;
                    case 'assigned':
                        statusBadgeClass = 'bg-blue-100 text-blue-800';
                        break;
                    case 'enroute':
                        statusBadgeClass = 'bg-green-100 text-green-800';
                        break;
                    case 'resolved':
                        statusBadgeClass = 'bg-gray-100 text-gray-800'; // Changed to gray for resolved
                        break;
                    case 'active': // Added active status
                        statusBadgeClass = 'bg-red-100 text-red-800';
                        break;
                    default:
                        statusBadgeClass = 'bg-gray-100 text-gray-800';
                }

                // Determine severity badge color
                let severityBadgeClass = '';
                switch (incident.severity) {
                    case 'critical':
                        severityBadgeClass = 'bg-red-100 text-red-800';
                        break;
                    case 'high':
                        severityBadgeClass = 'bg-orange-100 text-orange-800';
                        break;
                    case 'medium':
                        severityBadgeClass = 'bg-yellow-100 text-yellow-800';
                        break;
                    case 'low':
                        severityBadgeClass = 'bg-green-100 text-green-800';
                        break;
                    default:
                        severityBadgeClass = 'bg-gray-100 text-gray-800';
                }


                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            ${typeIconSvg}
                            ${incident.type}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${statusBadgeClass}">${incident.status.charAt(0).toUpperCase() + incident.status.slice(1)}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${severityBadgeClass}">${incident.severity.charAt(0).toUpperCase() + incident.severity.slice(1)}</span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${incident.location}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${incident.reportedBy}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${incident.time}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <button class="view-incident-button text-blue-600 hover:text-blue-900" data-incident-id="${incident.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <button class="edit-incident-button text-green-600 hover:text-green-900" data-incident-id="${incident.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <button class="delete-incident-button text-red-600 hover:text-red-900" data-incident-id="${incident.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                            <button class="assign-team-button px-3 py-1 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-purple-600 hover:bg-purple-700" data-incident-id="${incident.id}" data-incident-title="${incident.type} at ${incident.location}">
                                Assign Team
                            </button>
                        </div>
                    </td>
                `;
                incidentsTableBody.appendChild(row);
            });
            updateIncidentCount(incidentsToRender.length);
            attachActionListeners(); // Re-attach listeners after rendering new rows
        }

        // --- Function to Update Incident Count Display ---
        function updateIncidentCount(count) {
            incidentCountDisplay.textContent = `Showing ${count} of ${allIncidents.length} incidents`;
        }

        // --- Main Filtering Function ---
        function filterIncidents() {
            const searchTerm = searchIncidentsInput.value.toLowerCase().trim();
            const selectedStatus = document.getElementById('hidden-status-select').value;
            const selectedSeverity = document.getElementById('hidden-severity-select').value;

            const filtered = allIncidents.filter(incident => {
                const matchesSearch = (incident.type.toLowerCase().includes(searchTerm) ||
                                     incident.location.toLowerCase().includes(searchTerm) ||
                                     incident.reportedBy.toLowerCase().includes(searchTerm));

                const matchesStatus = (selectedStatus === 'all' || incident.status === selectedStatus);
                const matchesSeverity = (selectedSeverity === 'all' || incident.severity === selectedSeverity);

                return matchesSearch && matchesStatus && matchesSeverity;
            });

            renderIncidents(filtered);
        }

        // --- Reusable Custom Select Function ---
        function initializeCustomSelect(triggerSelector, optionsSelector, displayId, hiddenSelectId) {
            const customSelectTrigger = document.querySelector(triggerSelector);
            const customOptions = document.querySelector(optionsSelector);
            const selectedDisplay = document.getElementById(displayId);
            const hiddenSelect = document.getElementById(hiddenSelectId);

            if (!customSelectTrigger || !customOptions || !selectedDisplay || !hiddenSelect) {
                console.error(`Missing elements for custom select: ${triggerSelector}, ${optionsSelector}, ${displayId}, ${hiddenSelectId}`);
                return;
            }

            // Toggle dropdown visibility
            customSelectTrigger.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent document click from immediately closing
                customOptions.classList.toggle('hidden');
            });

            // Handle option selection
            customOptions.querySelectorAll('.custom-option').forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const displayText = this.getAttribute('data-display');

                    selectedDisplay.textContent = displayText; // Set the display text
                    hiddenSelect.value = value; // Update the hidden native select for form submission
                    customOptions.classList.add('hidden'); // Hide dropdown

                    // Trigger filter on selection change for filter dropdowns
                    if (triggerSelector === '.status-trigger' || triggerSelector === '.severity-trigger') {
                        filterIncidents();
                    }
                });
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(event) {
                if (!customSelectTrigger.contains(event.target) && !customOptions.contains(event.target)) {
                    customOptions.classList.add('hidden');
                }
            });
        }

        // --- Attach Event Listeners for Filtering and Search ---
        searchIncidentsInput.addEventListener('keyup', filterIncidents);

        // Initialize the "All Status" custom select
        initializeCustomSelect('.status-trigger', '.status-options', 'selected-status-display', 'hidden-status-select');

        // Initialize the "All Severity" custom select
        initializeCustomSelect('.severity-trigger', '.severity-options', 'selected-severity-display', 'hidden-severity-select');

        // --- Initial Render of All Incidents ---
        renderIncidents(allIncidents);

        // --- Attach Action Listeners (for View, Edit, Delete, Assign Team buttons) ---
        // This function will be called initially and after every table render
        function attachActionListeners() {
            // Assign Team Modal Logic
            const assignTeamModal = document.getElementById('assign-team-modal');
            const closeAssignTeamModalButton = document.getElementById('close-assign-team-modal');
            const cancelAssignTeamModalButton = document.getElementById('cancel-assign-team-modal');
            const assignTeamButtons = document.querySelectorAll('.assign-team-button');
            const assignIncidentIdInput = document.getElementById('assign-incident-id');
            const incidentTitleAssignSpan = document.getElementById('incident-title-assign');
            const assignTeamForm = document.getElementById('assign-team-form');

            // Initialize custom select for the Assign Team modal
            initializeCustomSelect('.assign-team-trigger', '.assign-team-options', 'selected-assign-team-display', 'hidden-assign-team-select');


            assignTeamButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const incidentId = this.dataset.incidentId;
                    const incidentTitle = this.dataset.incidentTitle; // Get the incident title from data attribute
                    assignIncidentIdInput.value = incidentId;
                    incidentTitleAssignSpan.textContent = incidentTitle; // Set the incident title in the modal
                    assignTeamModal.classList.remove('hidden');

                    // Reset the custom select display and hidden value when opening the modal
                    document.getElementById('selected-assign-team-display').textContent = 'Select a team';
                    document.getElementById('hidden-assign-team-select').value = '';
                });
            });

            if (closeAssignTeamModalButton) {
                closeAssignTeamModalButton.addEventListener('click', function() {
                    assignTeamModal.classList.add('hidden');
                });
            }
            if (cancelAssignTeamModalButton) {
                cancelAssignTeamModalButton.addEventListener('click', function() {
                    assignTeamModal.classList.add('hidden');
                });
            }
            if (assignTeamModal) {
                assignTeamModal.addEventListener('click', function(event) {
                    if (event.target === assignTeamModal) {
                        assignTeamModal.classList.add('hidden');
                    }
                });
            }

            // Handle Assign Team form submission (for demonstration, just logs)
            if (assignTeamForm) {
                assignTeamForm.addEventListener('submit', function(event) {
                    event.preventDefault(); // Prevent default form submission
                    const incidentId = document.getElementById('assign-incident-id').value;
                    const assignedTeam = document.getElementById('hidden-assign-team-select').value;

                    if (assignedTeam) {
                        console.log(`Assigning team "${assignedTeam}" to incident ID: ${incidentId}`);
                        // In a real application, you would make an AJAX request here
                        // e.g., fetch(`/api/incidents/${incidentId}/assign`, {
                        //     method: 'POST',
                        //     headers: {
                        //         'Content-Type': 'application/json',
                        //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // For Laravel
                        //     },
                        //     body: JSON.stringify({ team: assignedTeam })
                        // })
                        // .then(response => response.json())
                        // .then(data => {
                        //     console.log('Assignment successful:', data);
                        //     // Update the incident's status in allIncidents array and re-render
                        //     const incidentIndex = allIncidents.findIndex(inc => inc.id == incidentId);
                        //     if (incidentIndex !== -1) {
                        //         allIncidents[incidentIndex].status = 'assigned'; // Or a more specific status
                        //         renderIncidents(allIncidents); // Re-render to reflect change
                        //     }
                        //     assignTeamModal.classList.add('hidden');
                        // })
                        // .catch(error => console.error('Error assigning team:', error));

                        // For demonstration: Update the incident's status and re-render
                        const incidentIndex = allIncidents.findIndex(inc => inc.id == incidentId);
                        if (incidentIndex !== -1) {
                            allIncidents[incidentIndex].status = 'assigned'; // Update status to assigned
                            renderIncidents(allIncidents); // Re-render to reflect change
                        }
                        assignTeamModal.classList.add('hidden');
                    } else {
                        alert('Please select a team to assign.'); // Use a custom modal in a real app
                    }
                });
            }


            // --- View Incident Details Modal Logic ---
            // (Existing code for View, Edit, Delete buttons remains here)
            const viewIncidentModal = document.getElementById('view-incident-modal');
            const closeViewIncidentModalButton = document.getElementById('close-view-incident-modal');
            const viewIncidentButtons = document.querySelectorAll('.view-incident-button');

            viewIncidentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const incidentId = parseInt(this.dataset.incidentId);
                    const incident = allIncidents.find(inc => inc.id === incidentId);
                    if (incident) {
                        document.getElementById('view-incident-type').textContent = incident.type;
                        document.getElementById('view-incident-status').textContent = incident.status.charAt(0).toUpperCase() + incident.status.slice(1);
                        document.getElementById('view-incident-severity').textContent = incident.severity.charAt(0).toUpperCase() + incident.severity.slice(1);
                        document.getElementById('view-incident-location').textContent = incident.location;
                        document.getElementById('view-incident-reported-by').textContent = incident.reportedBy;
                        document.getElementById('view-incident-time').textContent = incident.time;
                        viewIncidentModal.classList.remove('hidden');
                    }
                });
            });

            if (closeViewIncidentModalButton) {
                closeViewIncidentModalButton.addEventListener('click', function() {
                    viewIncidentModal.classList.add('hidden');
                });
            }
            if (viewIncidentModal) {
                viewIncidentModal.addEventListener('click', function(event) {
                    if (event.target === viewIncidentModal) {
                        viewIncidentModal.classList.add('hidden');
                    }
                });
            }

            // --- Edit Incident Modal Logic ---
            const editIncidentModal = document.getElementById('edit-incident-modal');
            const closeEditIncidentModalButton = document.getElementById('close-edit-incident-modal');
            const cancelEditIncidentModalButton = document.getElementById('cancel-edit-incident-modal');
            const editIncidentButtons = document.querySelectorAll('.edit-incident-button');
            const editIncidentIdInput = document.getElementById('edit-incident-id');
            const editIncidentTypeInput = document.getElementById('edit-incident-type');
            const editIncidentLocationInput = document.getElementById('edit-incident-location');
            const editIncidentReportedByInput = document.getElementById('edit-incident-reported-by');
            const editIncidentTimeInput = document.getElementById('edit-incident-time');
            const editIncidentForm = document.getElementById('edit-incident-form');

            // Initialize custom selects for the Edit Incident modal
            initializeCustomSelect('.edit-status-trigger', '.edit-status-options', 'selected-edit-status-display', 'hidden-edit-status-select');
            initializeCustomSelect('.edit-severity-trigger', '.edit-severity-options', 'selected-edit-severity-display', 'hidden-edit-severity-select');


            editIncidentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const incidentId = parseInt(this.dataset.incidentId);
                    const incident = allIncidents.find(inc => inc.id === incidentId);
                    if (incident) {
                        editIncidentIdInput.value = incident.id;
                        editIncidentTypeInput.value = incident.type;
                        editIncidentLocationInput.value = incident.location;
                        editIncidentReportedByInput.value = incident.reportedBy;
                        editIncidentTimeInput.value = incident.time;

                        // Set custom select for Status
                        document.getElementById('selected-edit-status-display').textContent = incident.status.charAt(0).toUpperCase() + incident.status.slice(1);
                        document.getElementById('hidden-edit-status-select').value = incident.status;

                        // Set custom select for Severity
                        document.getElementById('selected-edit-severity-display').textContent = incident.severity.charAt(0).toUpperCase() + incident.severity.slice(1);
                        document.getElementById('hidden-edit-severity-select').value = incident.severity;

                        editIncidentModal.classList.remove('hidden');
                    }
                });
            });

            if (closeEditIncidentModalButton) {
                closeEditIncidentModalButton.addEventListener('click', function() {
                    editIncidentModal.classList.add('hidden');
                });
            }
            if (cancelEditIncidentModalButton) {
                cancelEditIncidentModalButton.addEventListener('click', function() {
                    editIncidentModal.classList.add('hidden');
                });
            }
            if (editIncidentModal) {
                editIncidentModal.addEventListener('click', function(event) {
                    if (event.target === editIncidentModal) {
                        editIncidentModal.classList.add('hidden');
                    }
                });
            }

            if (editIncidentForm) {
                editIncidentForm.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const incidentId = editIncidentIdInput.value;
                    const updatedIncident = {
                        id: parseInt(incidentId),
                        type: editIncidentTypeInput.value,
                        status: document.getElementById('hidden-edit-status-select').value,
                        severity: document.getElementById('hidden-edit-severity-select').value,
                        location: editIncidentLocationInput.value,
                        reportedBy: editIncidentReportedByInput.value,
                        time: editIncidentTimeInput.value
                    };

                    const incidentIndex = allIncidents.findIndex(inc => inc.id == incidentId);
                    if (incidentIndex !== -1) {
                        allIncidents[incidentIndex] = updatedIncident;
                        filterIncidents(); // Re-render with updated data
                        editIncidentModal.classList.add('hidden');
                    }
                });
            }

            // --- Delete Confirmation Modal Logic ---
            const deleteConfirmModal = document.getElementById('delete-confirm-modal');
            const closeDeleteConfirmModalButton = document.getElementById('close-delete-confirm-modal');
            const cancelDeleteConfirmModalButton = document.getElementById('cancel-delete-confirm-modal');
            const confirmDeleteButton = document.getElementById('confirm-delete-button');
            const deleteIncidentButtons = document.querySelectorAll('.delete-incident-button');

            let incidentToDeleteId = null;

            deleteIncidentButtons.forEach(button => {
                button.addEventListener('click', function() {
                    incidentToDeleteId = parseInt(this.dataset.incidentId);
                    deleteConfirmModal.classList.remove('hidden');
                });
            });

            if (closeDeleteConfirmModalButton) {
                closeDeleteConfirmModalButton.addEventListener('click', function() {
                    deleteConfirmModal.classList.add('hidden');
                    incidentToDeleteId = null;
                });
            }
            if (cancelDeleteConfirmModalButton) {
                cancelDeleteConfirmModalButton.addEventListener('click', function() {
                    deleteConfirmModal.classList.add('hidden');
                    incidentToDeleteId = null;
                });
            }
            if (deleteConfirmModal) {
                deleteConfirmModal.addEventListener('click', function(event) {
                    if (event.target === deleteConfirmModal) {
                        deleteConfirmModal.classList.add('hidden');
                        incidentToDeleteId = null;
                    }
                });
            }

            if (confirmDeleteButton) {
                confirmDeleteButton.addEventListener('click', function() {
                    if (incidentToDeleteId !== null) {
                        allIncidents = allIncidents.filter(incident => incident.id !== incidentToDeleteId);
                        filterIncidents();
                        deleteConfirmModal.classList.add('hidden');
                        incidentToDeleteId = null;
                    }
                });
            }
        } // End of attachActionListeners function
    });
</script>

@endsection
