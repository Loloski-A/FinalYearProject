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
                    <h3 class="mb-0">Resources Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Resources</li>
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
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">First Aid Guides</h1>
                    <p class="text-gray-600">Manage first aid instructions for various incident types</p>
                </div>
                <button id="add-guide-button" class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-blue-500 hover:bg-blue-600 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    Add New Guide
                </button>
            </div>

            <!-- Filter Resources Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Guides</h2>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <div class="relative w-full sm:w-80">
                        <input type="text" id="search-guides-input" placeholder="Search guides by title or content..." class="form-input w-full p-2 pl-11 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <svg class="absolute right-3 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto sm:ml-auto">
                        {{-- Custom Select for Incident Type Filter --}}
                        <div class="custom-select-wrapper relative w-full sm:w-40">
                            <div class="custom-select-trigger type-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                                <span id="selected-type-display" class="flex items-center">All Types</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div class="custom-options type-options absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="all" data-display="All Types">
                                    <span class="inline-flex items-center">All Types</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Fire" data-display="Fire">
                                    <span class="inline-flex items-center">Fire</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Flood" data-display="Flood">
                                    <span class="inline-flex items-center">Flood</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Medical" data-display="Medical">
                                    <span class="inline-flex items-center">Medical</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Accident" data-display="Accident">
                                    <span class="inline-flex items-center">Accident</span>
                                </div>
                            </div>
                            <select id="hidden-type-select" name="type_filter" class="hidden">
                                <option value="all">All Types</option>
                                <option value="Fire">Fire</option>
                                <option value="Flood">Flood</option>
                                <option value="Medical">Medical</option>
                                <option value="Accident">Accident</option>
                            </select>
                        </div>

                        {{-- Custom Select for Language Filter --}}
                        <div class="custom-select-wrapper relative w-full sm:w-36">
                            <div class="custom-select-trigger lang-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                                <span id="selected-lang-display" class="flex items-center">All Languages</span>
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            <div class="custom-options lang-options absolute z-10 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="all" data-display="All Languages">
                                    <span class="inline-flex items-center">All Languages</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="English" data-display="English">
                                    <span class="inline-flex items-center">English</span>
                                </div>
                                <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Kiswahili" data-display="Kiswahili">
                                    <span class="inline-flex items-center">Kiswahili</span>
                                </div>
                            </div>
                            <select id="hidden-lang-select" name="language_filter" class="hidden">
                                <option value="all">All Languages</option>
                                <option value="English">English</option>
                                <option value="Kiswahili">Kiswahili</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Guides Table Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">All First Aid Guides</h2>
                <p id="guide-count-display" class="text-gray-600 text-sm mb-4">Showing 3 of 3 guides</p>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Content Snippet</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Language</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="guides-table-body" class="bg-white divide-y divide-gray-200">
                            {{-- Guide rows will be dynamically inserted here by JavaScript --}}
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

{{-- Add New Guide Modal --}}
<div id="add-guide-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Add New First Aid Guide</h3>
            <button id="close-add-guide-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="#" method="POST"> {{-- Replace # with your actual form submission URL --}}
            @csrf {{-- Laravel CSRF token --}}
            <div class="mb-4">
                <label for="guide-type-add" class="block text-sm font-medium text-gray-700 mb-1">Incident Type</label>
                {{-- Custom Select for Incident Type in Modal --}}
                <div class="custom-select-wrapper relative">
                    <div class="custom-select-trigger modal-type-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <span id="selected-modal-type-display" class="flex items-center">Select Type</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="custom-options modal-type-options absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="" data-display="Select Type">
                            <span class="inline-flex items-center">Select Type</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Fire" data-display="Fire">
                            <span class="inline-flex items-center">Fire</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Flood" data-display="Flood">
                            <span class="inline-flex items-center">Flood</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Medical" data-display="Medical">
                            <span class="inline-flex items-center">Medical</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Accident" data-display="Accident">
                            <span class="inline-flex items-center">Accident</span>
                        </div>
                    </div>
                    <select id="hidden-modal-type-select" name="incident_type" class="hidden">
                        <option value="">Select Type</option>
                        <option value="Fire">Fire</option>
                        <option value="Flood">Flood</option>
                        <option value="Medical">Medical</option>
                        <option value="Accident">Accident</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="guide-title-add" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" id="guide-title-add" name="title" class="form-input w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="e.g., Basic Fire Safety" required>
            </div>
            <div class="mb-4">
                <label for="guide-content-add" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea id="guide-content-add" name="content" rows="6" class="form-textarea w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" placeholder="Provide detailed first aid instructions..." required></textarea>
            </div>
            <div class="mb-6">
                <label for="guide-language-add" class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                {{-- Custom Select for Language in Modal --}}
                <div class="custom-select-wrapper relative">
                    <div class="custom-select-trigger modal-lang-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <span id="selected-modal-lang-display" class="flex items-center">Select Language</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="custom-options modal-lang-options absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="" data-display="Select Language">
                            <span class="inline-flex items-center">Select Language</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="English" data-display="English">
                            <span class="inline-flex items-center">English</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Kiswahili" data-display="Kiswahili">
                            <span class="inline-flex items-center">Kiswahili</span>
                        </div>
                    </div>
                    <select id="hidden-modal-lang-select" name="language" class="hidden">
                        <option value="">Select Language</option>
                        <option value="English">English</option>
                        <option value="Kiswahili">Kiswahili</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-add-guide-modal" class="px-4 py-2 rounded-md text-gray-700 font-medium shadow-sm transition-colors duration-200 bg-gray-200 hover:bg-gray-300">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-md text-white font-medium shadow-sm transition-colors duration-200 bg-blue-500 hover:bg-blue-600">
                    Save Guide
                </button>
            </div>
        </form>
    </div>
</div>

{{-- View Guide Details Modal --}}
<div id="view-guide-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Guide Details</h3>
            <button id="close-view-guide-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="space-y-4">
            <div>
                <p class="text-sm font-medium text-gray-700">Incident Type:</p>
                <p id="view-guide-type" class="text-gray-900 text-lg font-semibold"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Title:</p>
                <p id="view-guide-title" class="text-gray-900 text-lg font-semibold"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Content:</p>
                <p id="view-guide-content" class="text-gray-800 text-base leading-relaxed whitespace-pre-wrap"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Language:</p>
                <p id="view-guide-language" class="text-gray-900 text-base"></p>
            </div>
        </div>
        <div class="flex justify-end mt-6">
            <button type="button" id="close-view-guide-modal-bottom" class="px-4 py-2 rounded-md text-gray-700 font-medium shadow-sm transition-colors duration-200 bg-gray-200 hover:bg-gray-300">
                Close
            </button>
        </div>
    </div>
</div>

{{-- Edit Guide Modal --}}
<div id="edit-guide-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-semibold text-gray-800">Edit First Aid Guide</h3>
            <button id="close-edit-guide-modal" class="text-gray-500 hover:text-gray-700">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <form action="#" method="POST"> {{-- Replace # with your actual form submission URL --}}
            @csrf {{-- Laravel CSRF token --}}
            @method('PUT') {{-- For update operations in Laravel --}}
            <input type="hidden" id="edit-guide-id" name="guide_id">
            <div class="mb-4">
                <label for="edit-guide-type" class="block text-sm font-medium text-gray-700 mb-1">Incident Type</label>
                {{-- Custom Select for Incident Type in Edit Modal --}}
                <div class="custom-select-wrapper relative">
                    <div class="custom-select-trigger edit-modal-type-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <span id="selected-edit-modal-type-display" class="flex items-center">Select Type</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="custom-options edit-modal-type-options absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Fire" data-display="Fire">
                            <span class="inline-flex items-center">Fire</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Flood" data-display="Flood">
                            <span class="inline-flex items-center">Flood</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Medical" data-display="Medical">
                            <span class="inline-flex items-center">Medical</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Accident" data-display="Accident">
                            <span class="inline-flex items-center">Accident</span>
                        </div>
                    </div>
                    <select id="hidden-edit-modal-type-select" name="incident_type" class="hidden">
                        <option value="Fire">Fire</option>
                        <option value="Flood">Flood</option>
                        <option value="Medical">Medical</option>
                        <option value="Accident">Accident</option>
                    </select>
                </div>
            </div>
            <div class="mb-4">
                <label for="edit-guide-title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" id="edit-guide-title" name="title" class="form-input w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required>
            </div>
            <div class="mb-4">
                <label for="edit-guide-content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea id="edit-guide-content" name="content" rows="6" class="form-textarea w-full p-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500" required></textarea>
            </div>
            <div class="mb-6">
                <label for="edit-guide-language" class="block text-sm font-medium text-gray-700 mb-1">Language</label>
                {{-- Custom Select for Language in Edit Modal --}}
                <div class="custom-select-wrapper relative">
                    <div class="custom-select-trigger edit-modal-lang-trigger w-full p-2 border border-gray-300 rounded-md bg-white flex items-center justify-between cursor-pointer focus:ring-blue-500 focus:border-blue-500 text-gray-700">
                        <span id="selected-edit-modal-lang-display" class="flex items-center">Select Language</span>
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7"></path></svg>
                    </div>
                    <div class="custom-options edit-modal-lang-options absolute z-20 w-full mt-1 bg-white border border-gray-300 rounded-md shadow-lg hidden">
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="English" data-display="English">
                            <span class="inline-flex items-center">English</span>
                        </div>
                        <div class="custom-option p-2 hover:bg-gray-100 cursor-pointer" data-value="Kiswahili" data-display="Kiswahili">
                            <span class="inline-flex items-center">Kiswahili</span>
                        </div>
                    </div>
                    <select id="hidden-edit-modal-lang-select" name="language" class="hidden">
                        <option value="English">English</option>
                        <option value="Kiswahili">Kiswahili</option>
                    </select>
                </div>
            </div>
            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-edit-guide-modal" class="px-4 py-2 rounded-md text-gray-700 font-medium shadow-sm transition-colors duration-200 bg-gray-200 hover:bg-gray-300">
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
        <p class="text-gray-700 mb-6">Are you sure you want to delete this guide? This action cannot be undone.</p>
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


<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('DOM Content Loaded! Initializing filters and modals.');

        // --- GLOBAL CLICK LISTENER FOR DEBUGGING ---
        // This will log every click on the document body, helping us see what element is actually receiving the click.
        document.body.addEventListener('click', function(event) {
            console.log('Global click detected on:', event.target);
            let currentElement = event.target;
            let path = [];
            while (currentElement && currentElement !== document.body) {
                path.push(currentElement.tagName + (currentElement.id ? '#' + currentElement.id : '') + (currentElement.className ? '.' + currentElement.className.split(' ').join('.') : ''));
                currentElement = currentElement.parentElement;
            }
            console.log('Click path:', path.reverse().join(' > '));
        });


        // --- Reusable Custom Select Function ---
        function initializeCustomSelect(triggerSelector, optionsSelector, displayId, hiddenSelectId) {
            const customSelectTrigger = document.querySelector(triggerSelector);
            const customOptions = document.querySelector(optionsSelector);
            const selectedDisplay = document.getElementById(displayId);
            const hiddenSelect = document.getElementById(hiddenSelectId);

            console.groupCollapsed(`Attempting to initialize custom select for trigger: ${triggerSelector}`);
            console.log(`Trigger element found:`, customSelectTrigger);
            console.log(`Options element found:`, customOptions);
            console.log(`Display element found:`, selectedDisplay);
            console.log(`Hidden select element found:`, hiddenSelect);


            if (!customSelectTrigger || !customOptions || !selectedDisplay || !hiddenSelect) {
                console.error(`ERROR: Missing one or more elements for custom select:
                Trigger Selector: ${triggerSelector} (Found: ${!!customSelectTrigger})
                Options Selector: ${optionsSelector} (Found: ${!!customOptions})
                Display ID: ${displayId} (Found: ${!!selectedDisplay})
                Hidden Select ID: ${hiddenSelectId} (Found: ${!!hiddenSelect})
                Skipping initialization for this select.
            `);
                console.groupEnd();
                return;
            }

            // Toggle dropdown visibility
            customSelectTrigger.addEventListener('click', function(event) {
                event.stopPropagation(); // Prevent document click from immediately closing
                customOptions.classList.toggle('hidden');
                console.log(`CLICKED: Trigger for ${displayId}. Hidden class status after toggle:`, customOptions.classList.contains('hidden') ? 'hidden' : 'visible');
            });

            // Handle option selection
            customOptions.querySelectorAll('.custom-option').forEach(option => {
                option.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    const displayText = this.getAttribute('data-display');

                    selectedDisplay.textContent = displayText; // Set the display text
                    hiddenSelect.value = value; // Update the hidden native select for form submission
                    customOptions.classList.add('hidden'); // Hide dropdown
                    console.log(`SELECTED: Option "${displayText}" for ${displayId}.`);
                    // Trigger filter on selection change (only for main filters)
                    if (triggerSelector === '.type-trigger' || triggerSelector === '.lang-trigger') {
                        filterGuides();
                        console.log('FilterGuides triggered by custom select.');
                    }
                });
            });

            // Hide dropdown when clicking outside
            document.addEventListener('click', function(event) {
                // Ensure the click is not inside the current custom select trigger or options
                if (!customSelectTrigger.contains(event.target) && !customOptions.contains(event.target)) {
                    if (!customOptions.classList.contains('hidden')) { // Only hide if it's currently visible
                        customOptions.classList.add('hidden');
                        console.log(`CLICKED OUTSIDE: Hiding dropdown for ${displayId}.`);
                    }
                }
            });
            console.groupEnd();
        }

        // --- Data Storage (Hardcoded for demonstration) ---
        // In a real application, this data would come from your backend (e.g., Laravel API)
        let allGuides = [
            {
                id: 1,
                type: "Fire",
                title: "Basic Fire Safety",
                content: "In case of a small fire, use a fire extinguisher. Aim at the base of the fire. For larger fires, evacuate immediately and call emergency services. Do not re-enter a burning building.",
                language: "English"
            },
            {
                id: 2,
                type: "Flood",
                title: "Flood Safety Tips",
                content: "If a flood warning is issued, move to higher ground. Do not walk or drive through floodwaters as they can be deeper than they appear. Turn off utilities if advised. Stay informed by listening to local alerts.",
                language: "English"
            },
            {
                id: 3,
                type: "Medical",
                title: "Basic Wound Care",
                content: "Clean the wound gently with soap and water. Apply an antiseptic and cover with a sterile bandage. Change the dressing daily. Seek medical attention if signs of infection appear (redness, swelling, pus).",
                language: "English"
            },
            {
                id: 4,
                type: "Accident",
                title: "Road Accident Response",
                content: "Ensure your safety first. Call emergency services. Do not move injured persons unless they are in immediate danger. Provide basic first aid if trained.",
                language: "English"
            },
            {
                id: 5,
                type: "Fire",
                title: "Usalama wa Moto",
                content: "Katika tukio la moto mdogo, tumia kizima moto. Lenga chini ya moto. Kwa moto mkubwa, ondoka mara moja na piga simu za dharura. Usirudi ndani ya jengo linalowaka.",
                language: "Kiswahili"
            }
        ];

        const guidesTableBody = document.getElementById('guides-table-body');
        const guideCountDisplay = document.getElementById('guide-count-display');
        const searchGuidesInput = document.getElementById('search-guides-input');

        // --- Function to Render Guides to the Table ---
        function renderGuides(guidesToRender) {
            guidesTableBody.innerHTML = ''; // Clear existing rows
            if (guidesToRender.length === 0) {
                guidesTableBody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">No guides found matching your criteria.</td></tr>`;
            }

            guidesToRender.forEach(guide => {
                const row = document.createElement('tr');
                row.setAttribute('data-guide-id', guide.id);
                row.setAttribute('data-type', guide.type);
                row.setAttribute('data-title', guide.title);
                row.setAttribute('data-content', guide.content);
                row.setAttribute('data-language', guide.language);

                let iconSvg = '';
                let iconColor = 'text-gray-500'; // Default color
                switch (guide.type) {
                    case 'Fire':
                        iconSvg = `<svg class="w-6 h-6 text-red-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/></svg>`;
                        break;
                    case 'Flood':
                        iconSvg = `<svg class="w-6 h-6 text-blue-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/></svg>`;
                        break;
                    case 'Medical':
                        iconSvg = `<svg class="w-6 h-6 text-green-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 2c-4.97 0-9 4.03-9 9s4.03 9 9 9 9-4.03 9-9-4.03-9-9-9zm0 16c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7zm-1-10h2v4h-2zm0 5h2v2h-2z"/></svg>`;
                        break;
                    case 'Accident':
                        iconSvg = `<svg class="w-6 h-6 text-yellow-500 mr-2" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M12 10c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm-6 0c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zm12-4c-1.1 0-2 .9-2 2s.9 2 2 2 2-.9 2-2-.9-2-2-2zM19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm0 18H5V4h14v16z"/></svg>`;
                        break;
                }

                row.innerHTML = `
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            ${iconSvg}
                            ${guide.type}
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${guide.title}</td>
                    <td class="px-6 py-4 text-sm text-gray-900 max-w-xs truncate">${guide.content}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${guide.language}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <div class="flex items-center space-x-2">
                            <button class="view-guide-button text-blue-600 hover:text-blue-900" data-guide-id="${guide.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>
                            <button class="edit-guide-button text-green-600 hover:text-green-900" data-guide-id="${guide.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <button class="delete-guide-button text-red-600 hover:text-red-900" data-guide-id="${guide.id}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </td>
                `;
                guidesTableBody.appendChild(row);
            });
            updateGuideCount(guidesToRender.length);
            attachActionListeners(); // Re-attach listeners after rendering new rows
        }

        // --- Function to Update Guide Count Display ---
        function updateGuideCount(count) {
            guideCountDisplay.textContent = `Showing ${count} of ${allGuides.length} guides`;
        }

        // --- Main Filtering Function ---
        function filterGuides() {
            const searchTerm = searchGuidesInput.value.toLowerCase().trim();
            const selectedType = document.getElementById('hidden-type-select').value;
            const selectedLanguage = document.getElementById('hidden-lang-select').value;

            const filtered = allGuides.filter(guide => {
                const matchesSearch = (guide.title.toLowerCase().includes(searchTerm) ||
                                     guide.content.toLowerCase().includes(searchTerm));

                const matchesType = (selectedType === 'all' || guide.type === selectedType);
                const matchesLanguage = (selectedLanguage === 'all' || guide.language === selectedLanguage);

                return matchesSearch && matchesType && matchesLanguage;
            });

            renderGuides(filtered);
        }

        // --- Attach Event Listeners for Filtering and Search ---
        searchGuidesInput.addEventListener('keyup', filterGuides);

        // --- Initial Render of All Guides ---
        renderGuides(allGuides);


        // --- Add New Guide Modal Logic ---
        const addGuideButton = document.getElementById('add-guide-button');
        const addGuideModal = document.getElementById('add-guide-modal');
        const closeAddGuideModalButton = document.getElementById('close-add-guide-modal');
        const cancelAddGuideModalButton = document.getElementById('cancel-add-guide-modal');

        // Initialize custom selects for the Add New Guide modal
        initializeCustomSelect('.modal-type-trigger', '.modal-type-options', 'selected-modal-type-display', 'hidden-modal-type-select');
        initializeCustomSelect('.modal-lang-trigger', '.modal-lang-options', 'selected-modal-lang-display', 'hidden-modal-lang-select');

        if (addGuideButton) {
            addGuideButton.addEventListener('click', function() {
                addGuideModal.classList.remove('hidden');
                // Clear form fields when opening for new entry
                document.getElementById('guide-title-add').value = '';
                document.getElementById('guide-content-add').value = '';
                document.getElementById('selected-modal-type-display').textContent = 'Select Type';
                document.getElementById('hidden-modal-type-select').value = '';
                document.getElementById('selected-modal-lang-display').textContent = 'Select Language';
                document.getElementById('hidden-modal-lang-select').value = '';
            });
        }
        if (closeAddGuideModalButton) {
            closeAddGuideModalButton.addEventListener('click', function() {
                addGuideModal.classList.add('hidden');
            });
        }
        if (cancelAddGuideModalButton) {
            cancelAddGuideModalButton.addEventListener('click', function() {
                addGuideModal.classList.add('hidden');
            });
        }
        if (addGuideModal) {
            addGuideModal.addEventListener('click', function(event) {
                if (event.target === addGuideModal) {
                    addGuideModal.classList.add('hidden');
                }
            });
        }

        // --- Action Buttons (View, Edit, Delete) Logic ---
        // This function will be called initially and after every table render
        function attachActionListeners() {
            // --- View Guide Details Modal Logic ---
            const viewGuideModal = document.getElementById('view-guide-modal');
            const closeViewGuideModalButton = document.getElementById('close-view-guide-modal');
            const closeViewGuideModalBottomButton = document.getElementById('close-view-guide-modal-bottom');
            const viewGuideButtons = document.querySelectorAll('.view-guide-button');

            viewGuideButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const guideId = parseInt(this.dataset.guideId); // Ensure ID is a number
                    const guide = allGuides.find(g => g.id === guideId);
                    if (guide) {
                        document.getElementById('view-guide-type').textContent = guide.type;
                        document.getElementById('view-guide-title').textContent = guide.title;
                        document.getElementById('view-guide-content').textContent = guide.content;
                        document.getElementById('view-guide-language').textContent = guide.language;
                        viewGuideModal.classList.remove('hidden');
                    }
                });
            });
            if (closeViewGuideModalButton) {
                closeViewGuideModalButton.addEventListener('click', function() {
                    viewGuideModal.classList.add('hidden');
                });
            }
            if (closeViewGuideModalBottomButton) {
                closeViewGuideModalBottomButton.addEventListener('click', function() {
                    viewGuideModal.classList.add('hidden');
                });
            }
            if (viewGuideModal) {
                viewGuideModal.addEventListener('click', function(event) {
                    if (event.target === viewGuideModal) {
                        viewGuideModal.classList.add('hidden');
                    }
                });
            }

            // --- Edit Guide Modal Logic ---
            const editGuideModal = document.getElementById('edit-guide-modal');
            const closeEditGuideModalButton = document.getElementById('close-edit-guide-modal');
            const cancelEditGuideModalButton = document.getElementById('cancel-edit-guide-modal');
            const editGuideButtons = document.querySelectorAll('.edit-guide-button');

            editGuideButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const guideId = parseInt(this.dataset.guideId);
                    const guide = allGuides.find(g => g.id === guideId);
                    if (guide) {
                        // Populate hidden ID field
                        document.getElementById('edit-guide-id').value = guide.id;
                        // Populate form fields
                        document.getElementById('edit-guide-title').value = guide.title;
                        document.getElementById('edit-guide-content').value = guide.content;

                        // Set custom select for Incident Type
                        const selectedEditModalTypeDisplay = document.getElementById('selected-edit-modal-type-display');
                        const hiddenEditModalTypeSelect = document.getElementById('hidden-edit-modal-type-select');
                        selectedEditModalTypeDisplay.textContent = guide.type;
                        hiddenEditModalTypeSelect.value = guide.type;

                        // Set custom select for Language
                        const selectedEditModalLangDisplay = document.getElementById('selected-edit-modal-lang-display');
                        const hiddenEditModalLangSelect = document.getElementById('hidden-edit-modal-lang-select');
                        selectedEditModalLangDisplay.textContent = guide.language;
                        hiddenEditModalLangSelect.value = guide.language;

                        editGuideModal.classList.remove('hidden');
                    }
                });
            });
            if (closeEditGuideModalButton) {
                closeEditGuideModalButton.addEventListener('click', function() {
                    editGuideModal.classList.add('hidden');
                });
            }
            if (cancelEditGuideModalButton) {
                cancelEditGuideModalButton.addEventListener('click', function() {
                    editGuideModal.classList.add('hidden');
                });
            }
            if (editGuideModal) {
                editGuideModal.addEventListener('click', function(event) {
                    if (event.target === editGuideModal) {
                        editGuideModal.classList.add('hidden');
                    }
                });
            }

            // --- Delete Confirmation Modal Logic ---
            const deleteConfirmModal = document.getElementById('delete-confirm-modal');
            const closeDeleteConfirmModalButton = document.getElementById('close-delete-confirm-modal');
            const cancelDeleteConfirmModalButton = document.getElementById('cancel-delete-confirm-modal');
            const confirmDeleteButton = document.getElementById('confirm-delete-button');
            const deleteGuideButtons = document.querySelectorAll('.delete-guide-button');

            let guideToDeleteId = null; // Variable to store the ID of the guide to be deleted

            deleteGuideButtons.forEach(button => {
                button.addEventListener('click', function() {
                    guideToDeleteId = parseInt(this.dataset.guideId); // Store the ID
                    deleteConfirmModal.classList.remove('hidden');
                });
            });
            if (closeDeleteConfirmModalButton) {
                closeDeleteConfirmModalButton.addEventListener('click', function() {
                    deleteConfirmModal.classList.add('hidden');
                    guideToDeleteId = null; // Clear the stored ID
                });
            }
            if (cancelDeleteConfirmModalButton) {
                cancelDeleteConfirmModalButton.addEventListener('click', function() {
                    deleteConfirmModal.classList.add('hidden');
                    guideToDeleteId = null; // Clear the stored ID
                });
            }
            if (deleteConfirmModal) {
                deleteConfirmModal.addEventListener('click', function(event) {
                    if (event.target === deleteConfirmModal) {
                        deleteConfirmModal.classList.add('hidden');
                        guideToDeleteId = null; // Clear the stored ID
                    }
                });
            }

            // Handle actual deletion when "Delete" is confirmed
            if (confirmDeleteButton) {
                confirmDeleteButton.addEventListener('click', function() {
                    if (guideToDeleteId !== null) {
                        console.log(`Deleting guide with ID: ${guideToDeleteId}`);
                        // In a real Laravel app, you would make an AJAX request here
                        // e.g., fetch(`/admin/resources/${guideToDeleteId}`, { method: 'DELETE' })
                        // .then(response => { /* handle response, remove row from table */ })
                        // .catch(error => console.error('Error deleting guide:', error));

                        // For demonstration: Remove from allGuides array and re-render
                        allGuides = allGuides.filter(guide => guide.id !== guideToDeleteId);
                        filterGuides(); // Re-render the table with updated data

                        deleteConfirmModal.classList.add('hidden');
                        guideToDeleteId = null; // Clear the stored ID
                    }
                });
            }
        } // End of attachActionListeners function
    });
</script>

@endsection
