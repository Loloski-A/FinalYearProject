@extends('backend.layouts.app')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Team Management</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Teams</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            @include('_message')
            <div class="row">
                <!-- Create New Team Section -->
                <div class="col-md-4">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Create New Team</h3>
                        </div>
                        <form action="{{ route('admin.teams.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Team Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="e.g., Nairobi Fire Unit A" required>
                                </div>
                                <div class="form-group">
                                    <label>Team Type</label>
                                    <input type="text" name="team_type" class="form-control" placeholder="e.g., Fire Response" required>
                                </div>
                                <div class="form-group">
                                    <label>Contact Phone</label>
                                    <input type="text" name="contact_phone" class="form-control" placeholder="Optional contact number">
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create Team</button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Assign Unassigned Members Section -->
                <div class="col-md-8">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Assign New Members</h3>
                        </div>
                        <div class="card-body">
                            @if($unassignedMembers->isEmpty())
                                <p class="text-center text-muted">No unassigned team members found.</p>
                            @else
                                <form action="{{ route('admin.teams.assign') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label>Select Member</label>
                                        <select name="user_id" class="form-control" required>
                                            @foreach($unassignedMembers as $member)
                                                <option value="{{ $member->id }}">{{ $member->name }} ({{ $member->email }})</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Assign to Team</label>
                                        <select name="team_id" class="form-control" required>
                                            @foreach($allTeams as $team)
                                                <option value="{{ $team->id }}">{{ $team->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Role in Team</label>
                                        <input type="text" name="role" class="form-control" placeholder="e.g., Medic, Driver, Lead" required>
                                    </div>
                                    <button type="submit" class="btn btn-info mt-2">Assign Member</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Existing Teams and Members Section -->
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="card-title">Existing Teams</h3>
                </div>
                <div class="card-body">
                    @foreach($allTeams as $team)
                        <div class="mb-4">
                            <h5>{{ $team->name }} ({{ $team->team_type }})</h5>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Member Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($team->members as $member)
                                        <tr>
                                            <td>{{ $member->user->name }}</td>
                                            <td>{{ $member->user->email }}</td>
                                            <td>{{ $member->role }}</td>
                                            <td>
                                                <form action="{{ route('admin.teams.remove', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">No members assigned to this team.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
