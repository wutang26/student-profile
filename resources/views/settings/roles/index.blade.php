@extends('layouts.admin')

@section('content')

@php $i = 0; @endphp

@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif


<h1 class="page-title">Roles Summary</h1>

<!-- CARDS -->
<div class="card-grid">

    <div class="card">
        <h2>Total Roles</h2>
        <p></p>
    </div>

    <div class="card">
        <h2>Active Roles</h2>
        <p></p>
    </div>

    <div class="card">
        <h2>Total Roles</h2>
        <p></p>
    </div>

</div>

<br>

<!-- TABLE SECTION -->
<div class="table-wrapper">

    @auth
    @role('super-admin|admin')
    <a href="{{ route('settings.roles.create') }}" class="btn-create">
        Register Role
    </a>
    @endrole
    @endauth

    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Role Name</th>
                <th>Description</th>
                <th>Permissions</th>
                <th>Created Date</th>
                <th>Status</th>
                @auth
                @role('super-admin|admin')
                <th>Actions</th>
                @endrole
                @endauth
            </tr>
        </thead>

        <tbody>
        @foreach ($roles as $role)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $role->name }}</td>
                <td>{{ $role->description }}</td>

                <!-- Permissions -->
                <td>
                    @if ($role->permissions->count())
                        <div class="badge-wrap">
                            @foreach ($role->permissions as $permission)
                                <span class="badge">
                                    {{ $permission->label ?? $permission->name }}
                                </span>
                            @endforeach
                        </div>
                    @else
                        <span class="text-muted">No permissions</span>
                    @endif
                </td>

                <td>{{ $role->created_at->format('d M Y, h:i A') }}</td>

                <td>
                    <span class="status {{ $role->status }}">
                        {{ ucfirst($role->status) }}
                    </span>
                </td>

                @auth
                @role('super-admin|admin')
                <td>
                    <a href="{{ route('settings.roles.edit', $role->id) }}" class="btn-edit">
                        Edit
                    </a>

                    <form action="{{ route('settings.roles.deleteRole', $role->id) }}"
                          method="POST"
                          class="inline-form"
                          onsubmit="return confirm('Delete this role?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-delete">
                            Delete
                        </button>
                    </form>
                </td>
                @endrole
                @endauth

            </tr>
        @endforeach
        </tbody>
    </table>

</div>

<style>
    /* =========================
   BADGE WRAPPER (PERMISSIONS)
========================= */
.badge-wrap{
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
}

/* individual permission badge */
.badge{
    display: inline-block;
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
    background: #e0f2fe;
    color: #0369a1;
    border: 1px solid #bae6fd;
}

/* muted text */
.text-muted{
    font-size: 13px;
    color: #94a3b8;
}

/* =========================
   STATUS BADGE IMPROVEMENT
========================= */
.status{
    padding: 4px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: 600;
}

/* ACTIVE */
.status.active{
    background: #dcfce7;
    color: #166534;
}

/* INACTIVE */
.status.inactive{
    background: #fee2e2;
    color: #991b1b;
}

/* PENDING (optional if used) */
.status.pending{
    background: #fef9c3;
    color: #92400e;
}

/* =========================
   ACTION COLUMN FIX
========================= */
.inline-form{
    display: inline;
}

/* spacing between edit/delete */
.table td:last-child{
    display: flex;
    align-items: center;
    gap: 10px;
}

/* =========================
   CARD GRID FIX (optional polish)
========================= */
.card-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

.btn-edit{
    display: inline-flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 8px;
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
    font-size: 13px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: 0.2s ease;
}

/* =========================
   RESPONSIVE
========================= */
@media (max-width: 768px){
    .card-grid{
        grid-template-columns: 1fr;
    }
}
</style>
@endsection