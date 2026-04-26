@extends('layoutsGroup.groupdashboard')

@section('content')

<div class="row">

    <!-- ===== STATS ===== -->
    <div class="card col-4">
        <h3>Total Members</h3>
        <h2>{{ $members->count() }}</h2>
    </div>

    <div class="card col-4">
        <h3>Active Loans</h3>
        <h2>{{ $members->count() }}</h2>
    </div>

    <div class="card col-4">
        <h3>Total Disbursed</h3>
        <h2>{{ $members->count() }}</h2>
    </div>

    <!-- ===== SUCCESS MESSAGE ===== -->
    @if (session('success'))
        <div class="card col-12" style="background:#dcfce7; color:#166534;">
            {{ session('success') }}
        </div>
    @endif

    <!-- ===== ACTIONS ===== -->
    @auth
    @role('super-admin|admin')
    <div class="card col-12" style="display:flex; justify-content:space-between; align-items:center;">
        
        <h3>Members Management</h3>

        <div style="display:flex; gap:10px;">
            <a href="{{ route('members.create') }}" class="btn">
                <i class="fas fa-user-plus"></i> Register Member
            </a>

            <a href="{{ route('groups.create') }}" class="btn" style="background:#334155;">
                <i class="fas fa-users"></i> Create Group
            </a>
        </div>

    </div>
    @endrole
    @endauth

    <!-- ===== TABLE ===== -->
    <div class="card col-12">

        <h3 style="margin-bottom:15px;">Members List</h3>

        <div style="overflow-x:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Reg No</th>
                        <th>First Name</th>
                        <th>Middle</th>
                        <th>Last Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Region</th>
                        <th>District</th>
                        <th>Date Joined</th>
                        <th>Status</th>
                        @auth
                        @role('super-admin|admin')
                        <th style="text-align:right;">Actions</th>
                        @endrole
                        @endauth
                    </tr>
                </thead>

                <tbody>
                    @forelse ($members as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $member->member_number }}</td>
                        <td>{{ $member->first_name }}</td>
                        <td>{{ $member->middle_name }}</td>
                        <td>{{ $member->last_name }}</td>
                        <td>{{ $member->phone }}</td>
                        <td>{{ $member->address }}</td>
                        <td>{{ $member->region->name }}</td>
                        <td>{{ $member->district->name }}</td>
                        <td>{{ $member->date_joined }}</td>

                        <!-- STATUS -->
                        <td>
                            <span style="
                                padding:5px 10px;
                                border-radius:20px;
                                font-size:12px;
                                font-weight:600;
                                background:
                                {{ $member->status === 'active' ? '#dcfce7' :
                                   ($member->status === 'pending' ? '#fef9c3' : '#fee2e2') }};
                                color:
                                {{ $member->status === 'active' ? '#166534' :
                                   ($member->status === 'pending' ? '#854d0e' : '#991b1b') }};
                            ">
                                {{ ucfirst($member->status) }}
                            </span>
                        </td>

                        <!-- ACTIONS -->
                        @auth
                        @role('super-admin|admin')
                        <td style="text-align:right;">
                            
                            <a href="{{ route('admin.members.edit', $member->id) }}"
                               class="btn"
                               style="padding:6px 10px; font-size:12px;">
                                Edit
                            </a>

                            <form action="{{ route('admin.members.deleteMember', $member->id) }}"
                                  method="POST"
                                  style="display:inline;"
                                  onsubmit="return confirm('Delete this member?');">
                                @csrf
                                @method('DELETE')

                                <button class="btn"
                                        style="background:#e11d48; padding:6px 10px; font-size:12px;">
                                    Delete
                                </button>
                            </form>

                        </td>
                        @endrole
                        @endauth

                    </tr>

                    @empty
                    <tr>
                        <td colspan="12" style="text-align:center; padding:20px; color:#94a3b8;">
                            No members found
                        </td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>

    </div>

</div>

@endsection