@extends('layouts.admin')

@section('content')

<style>
/* HEADER */
.page-header {
    margin-bottom: 20px;
}
.subtitle {
    color: #64748b;
    font-size: 14px;
}

/* TOP BAR */
.top-bar {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
}

.search-box {
    padding: 8px 12px;
    border-radius: 8px;
    border: 1px solid #cbd5e1;
    width: 250px;
}

/* TABLE CARD */
.table-card {
    background: #fff;
    border-radius: 12px;
    padding: 15px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}

/* TABLE */
.modern-table {
    width: 100%;
    border-collapse: collapse;
}

.modern-table th {
    text-align: left;
    padding: 12px;
    background: #f1f5f9;
    font-size: 13px;
}

.modern-table td {
    padding: 12px;
    border-top: 1px solid #e2e8f0;
}

/* HOVER */
.modern-table tbody tr:hover {
    background: #f9fafb;
}

/* ROLE BADGES */
.role-badge {
    padding: 5px 10px;
    border-radius: 20px;
    font-size: 12px;
    color: #fff;
}

/* Role Colors */
.role-admin { background: #ef4444; }
.role-instructor { background: #3b82f6; }
.role-karani { background: #10b981; }
.role-katibu { background: #8b5cf6; }
.role-commandant { background: #f59e0b; }
.role-adjutant { background: #6366f1; }
.role-chiefinstructor { background: #0ea5e9; }
.role-chiefmatron { background: #ec4899; }
.role-company_sergeant_major { background: #14b8a6; }

/* ACTION BUTTONS */
.actions a,
.actions button {
    border: none;
    padding: 6px 8px;
    margin-right: 5px;
    border-radius: 6px;
    cursor: pointer;
}

.btn-view { background: #0ea5e9; color: white; }
.btn-edit { background: #f59e0b; color: white; }
.btn-delete { background: #ef4444; color: white; }

/* EMPTY */
.empty {
    text-align: center;
    padding: 20px;
    color: #94a3b8;
}

/* BUTTON */
.btn-primary {
    background: #3b82f6;
    color: #fff;
    padding: 8px 14px;
    border-radius: 8px;
    text-decoration: none;
}
.search-btn {
    background: #3b82f6;
    color: #fff;
    padding: 8px 14px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 14px;
}

.search-btn:hover {
    background: #2563eb;
}
</style>

<div class="page-header">
    <h2><i class="bi bi-people"></i> Staff Management</h2>
    <p class="subtitle">View and manage all registered staff</p>
</div>

<!-- TOP BAR -->
<div class="top-bar">

    <form method="GET" action="{{ route('staff.index') }}" style="display:flex; gap:10px;">

        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}"
            placeholder="Search by name, service no, email..." 
            class="search-box"
        >

        <button type="submit" class="btn-primary">
            <i class="bi bi-search"></i> Search
        </button>

    </form>

 @can('view students')
    <a href="{{ route('staff.create') }}" class="btn-primary">
        <i class="bi bi-plus-circle"></i> Add Staff
    </a>
@endcan

</div>

<!-- TABLE CARD -->
<div class="table-card">
    <table class="modern-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Service No</th>
                <th>Rank</th>
                <th>Department</th>
                <th>Role</th>
                <th>Contact</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($staffs as $staff )
            <tr>
                <td>{{ $loop->iteration }}</td>

                <td>
                    <strong>{{ $staff->first_name }} {{ $staff->last_name }}</strong><br>
                    <small>{{ $staff->email }}</small>
                </td>

                <td>{{ $staff->force_number }}</td>
                <td>{{ $staff->rank }}</td>
                <td>{{ $staff->department }}</td>

                <td>
                    <span class="role-badge role-{{ $staff->role }}">
                        {{ ucfirst(str_replace('_',' ', $staff->role)) }}
                    </span>
                </td>

                <td>
                    <small>{{ $staff->phone }}</small>
                </td>

                <td class="actions">
                    <a href="{{ route('staff.show', $staff->id) }}" class="btn-view"><i class="bi bi-eye"></i></a>

               @can('view students')
                    <a href="{{ route('staff.edit', $staff->id) }}" class="btn-edit"><i class="bi bi-pencil"></i></a>

         
                <form action="{{ route('staff.destroy', $staff->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn-delete"
                        onclick="return confirm('Are you sure you want to delete this staff?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            @endcan
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="empty">No staff registered</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection