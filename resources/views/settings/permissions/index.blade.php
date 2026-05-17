@extends('layouts.admin')

@section('content')

@php $i = 0; @endphp

<h1 class="page-title">Permissions Summary</h1>

<!-- SUMMARY CARDS -->
<div class="card-grid">

    <div class="card">
        <h2>Total Permissions</h2>
        <p>{{ $permissions->count() }}</p>
    </div>

    <div class="card">
        <h2>Active Permissions</h2>
        <p>{{ $permissions->where('status','active')->count() }}</p>
    </div>

    <div class="card">
        <h2>Pending / Others</h2>
        <p>{{ $permissions->where('status','!=','active')->count() }}</p>
    </div>

</div>

<!-- SUCCESS -->
@if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

<br>

<!-- TABLE AREA -->
<div class="table-wrapper">

    @auth
    @role('super-admin|admin')
    <a href="{{ route('settings.permissions.create') }}" class="btn-create">
        Register Permission
    </a>
    @endrole
    @endauth

    <table class="table">

        <thead>
            <tr>
                <th>Id</th>
                <th>Permission Name</th>
                <th>Module</th>
                <th>Description</th>
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

        @foreach ($permissions as $permission)
        <tr>

            <td>{{ ++$i }}</td>
            <td>{{ $permission->name }}</td>
            <td>{{ $permission->module }}</td>
            <td>{{ $permission->description }}</td>
            <td>{{ $permission->created_at->format('d M Y, h:i A') }}</td>

            <!-- STATUS -->
            <td>
                <span class="status {{ $permission->status }}">
                    {{ ucfirst($permission->status) }}
                </span>
            </td>

            <!-- ACTIONS -->
            @auth
            @role('super-admin|admin')
            <td class="action-col">

                <a href="{{ route('settings.permissions.edit', $permission->id) }}" class="btn-edit">
                    Edit
                </a>

                <form action="{{ route('settings.permissions.deletePermission', $permission->id) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this permission?');"
                      class="inline-form">
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
   SUMMARY CARD GRID FIX
========================= */
.card-grid{
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
    margin-bottom: 20px;
}

/* =========================
   STATUS BADGES
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

/* INACTIVE / OTHERS */
.status.inactive,
.status.pending,
.status.other{
    background: #fee2e2;
    color: #991b1b;
}

/* =========================
   ACTION COLUMN FIX
========================= */
.action-col{
    display: flex;
    align-items: center;
    gap: 10px;
    white-space: nowrap;
}

/* INLINE FORM */
.inline-form{
    display: inline;
}

/* =========================
   BUTTON POLISH (EDIT / DELETE ALIGNMENT)
========================= */
.btn-delete{
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
.btn-edit{
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: 0.2s ease;

    /* SAME STYLE SYSTEM AS DELETE */
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: #fff;
    box-shadow: 0 2px 6px rgba(29, 78, 216, 0.25);
}

/* =========================
   TABLE IMPROVEMENT (SMOOTH LOOK)
========================= */
.table-wrapper{
    overflow-x: auto;
}

/* hover effect improvement */
.table tbody tr:hover{
    background: #f8fafc;
    transition: 0.2s;
}

/* =========================
   CARD STYLING CONSISTENCY
========================= */
.card{
    background: #fff;
    padding: 18px;
    border-radius: 14px;
    border: 1px solid #eef2f7;
    box-shadow: 0 8px 20px rgba(15, 23, 42, 0.05);
}

/* =========================
   RESPONSIVE FIX
========================= */
@media (max-width: 768px){
    .card-grid{
        grid-template-columns: 1fr;
    }

    .action-col{
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>
@endsection