@extends('backend.layouts.app')

@section('content')

<!--begin::App Main-->
<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Resources Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Resources</li>
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

            <!-- Header Section -->
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-semibold text-gray-800">First Aid Guides</h1>
                    <p class="text-gray-600">Manage first aid instructions for various incident types</p>
                </div>
                <button id="add-guide-button" class="px-4 py-2 rounded-md text-white font-medium shadow-sm bg-blue-500 hover:bg-blue-600 flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/></svg>
                    Add New Guide
                </button>
            </div>

            <!-- Filter Resources Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Filter Guides</h2>
                <div class="flex flex-col sm:flex-row items-center gap-4">
                    <input type="text" id="search-guides-input" placeholder="Search guides..." class="form-input w-full sm:w-80 p-2 border border-gray-300 rounded-md">
                    <select id="type-filter" class="form-select w-full sm:w-auto p-2 border border-gray-300 rounded-md">
                        <option value="all">All Types</option>
                        <option value="Fire">Fire</option>
                        <option value="Flood">Flood</option>
                        <option value="Medical">Medical</option>
                        <option value="Accident">Accident</option>
                    </select>
                    <select id="language-filter" class="form-select w-full sm:w-auto p-2 border border-gray-300 rounded-md">
                        <option value="all">All Languages</option>
                        <option value="English">English</option>
                        <option value="Kiswahili">Kiswahili</option>
                    </select>
                </div>
            </div>

            <!-- All Guides Table Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">All First Aid Guides</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Language</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="guides-table-body" class="bg-white divide-y divide-gray-200">
                            @forelse ($allGuides as $guide)
                                <tr class="guide-row" data-type="{{ $guide->incident_type }}" data-language="{{ $guide->language }}">
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $guide->incident_type }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ $guide->title }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ $guide->language }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-3">
                                            <button class="view-guide-button text-blue-600 hover:text-blue-900" data-guide='@json($guide)'>View</button>
                                            <button class="edit-guide-button text-green-600 hover:text-green-900" data-guide='@json($guide)'>Edit</button>
                                            <form action="{{ route('admin.resources.destroy', $guide->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this guide?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No first aid guides found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</main>

{{-- Add/Edit Guide Modal --}}
<div id="guide-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg mx-4">
        <h3 id="guide-modal-title" class="text-xl font-semibold text-gray-800 mb-4">Add New Guide</h3>
        <form id="guide-form" action="" method="POST">
            @csrf
            <input type="hidden" name="_method" id="guide-form-method" value="POST">
            <div class="space-y-4">
                <div>
                    <label for="guide-title" class="block text-sm font-medium text-gray-700">Title</label>
                    <input type="text" id="guide-title" name="title" class="form-input w-full mt-1" required>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="guide-type" class="block text-sm font-medium text-gray-700">Incident Type</label>
                        <select id="guide-type" name="incident_type" class="form-select w-full mt-1">
                            <option value="Fire">Fire</option>
                            <option value="Flood">Flood</option>
                            <option value="Medical">Medical</option>
                            <option value="Accident">Accident</option>
                        </select>
                    </div>
                    <div>
                        <label for="guide-language" class="block text-sm font-medium text-gray-700">Language</label>
                        <select id="guide-language" name="language" class="form-select w-full mt-1">
                            <option value="English">English</option>
                            <option value="Kiswahili">Kiswahili</option>
                        </select>
                    </div>
                </div>
                <div>
                    <label for="guide-content" class="block text-sm font-medium text-gray-700">Content</label>
                    <textarea id="guide-content" name="content" rows="6" class="form-textarea w-full mt-1"></textarea>
                </div>
            </div>
            <div class="flex justify-end space-x-3 mt-6">
                <button type="button" id="cancel-guide-modal" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-md text-white bg-blue-500 hover:bg-blue-600">Save Guide</button>
            </div>
        </form>
    </div>
</div>

{{-- View Guide Details Modal --}}
<div id="view-guide-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg shadow-xl w-full max-w-lg mx-4 flex flex-col max-h-[90vh]">
        <h3 class="text-xl font-semibold text-gray-800 mb-4 p-6 border-b">Guide Details</h3>
        <div id="view-guide-content-wrapper" class="space-y-4 p-6 overflow-y-auto">
            <div>
                <p class="text-sm font-medium text-gray-700">Title:</p>
                <p id="view-guide-title" class="text-gray-900 text-lg"></p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-700">Content:</p>
                <p id="view-guide-content" class="text-gray-800 whitespace-pre-wrap"></p>
            </div>
        </div>
        <div class="flex justify-end mt-auto p-6 border-t">
            <button type="button" id="close-view-guide-modal" class="px-4 py-2 rounded-md bg-gray-200 hover:bg-gray-300">Close</button>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Modal Handling ---
    const guideModal = document.getElementById('guide-modal');
    const guideForm = document.getElementById('guide-form');
    const guideModalTitle = document.getElementById('guide-modal-title');
    const guideFormMethod = document.getElementById('guide-form-method');

    document.getElementById('add-guide-button').addEventListener('click', () => {
        guideForm.action = "{{ route('admin.resources.store') }}";
        guideFormMethod.value = "POST";
        guideModalTitle.textContent = "Add New Guide";
        guideForm.reset();
        guideModal.classList.remove('hidden');
    });

    document.querySelectorAll('.edit-guide-button').forEach(button => {
        button.addEventListener('click', function() {
            const guide = JSON.parse(this.dataset.guide);
            guideForm.action = `/admin/resources/${guide.id}`;
            guideFormMethod.value = "PUT";
            guideModalTitle.textContent = "Edit First Aid Guide";
            document.getElementById('guide-title').value = guide.title;
            document.getElementById('guide-type').value = guide.incident_type;
            document.getElementById('guide-language').value = guide.language;
            document.getElementById('guide-content').value = guide.content;
            guideModal.classList.remove('hidden');
        });
    });

    document.getElementById('cancel-guide-modal').addEventListener('click', () => {
        guideModal.classList.add('hidden');
    });

    const viewModal = document.getElementById('view-guide-modal');
    document.querySelectorAll('.view-guide-button').forEach(button => {
        button.addEventListener('click', function() {
            const guide = JSON.parse(this.dataset.guide);
            document.getElementById('view-guide-title').textContent = guide.title;
            document.getElementById('view-guide-content').textContent = guide.content;
            viewModal.classList.remove('hidden');
        });
    });

    document.getElementById('close-view-guide-modal').addEventListener('click', () => {
        viewModal.classList.add('hidden');
    });

    // --- Filtering Logic ---
    const searchInput = document.getElementById('search-guides-input');
    const typeFilter = document.getElementById('type-filter');
    const languageFilter = document.getElementById('language-filter');
    const tableBody = document.getElementById('guides-table-body');
    const allRows = tableBody.querySelectorAll('.guide-row');

    function filterGuides() {
        const searchTerm = searchInput.value.toLowerCase();
        const typeValue = typeFilter.value;
        const languageValue = languageFilter.value;

        allRows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            const rowType = row.dataset.type;
            const rowLanguage = row.dataset.language;

            const matchesSearch = rowText.includes(searchTerm);
            const matchesType = typeValue === 'all' || rowType === typeValue;
            const matchesLanguage = languageValue === 'all' || rowLanguage === languageValue;

            if (matchesSearch && matchesType && matchesLanguage) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', filterGuides);
    typeFilter.addEventListener('change', filterGuides);
    languageFilter.addEventListener('change', filterGuides);
});
</script>
@endsection
