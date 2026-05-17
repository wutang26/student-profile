@extends('layouts.admin')

@section('content')

<h1 class="page-title">Dashboard</h1>

<!-- BACK -->
<div class="back-link">
    <a href="{{ route('settings.roles.index') }}">&larr; Back</a>
</div>

<!-- CARD -->
<div class="form-card">

    <h2 class="form-title">Register Role</h2>

    <form method="POST" action="{{ route('settings.roles.storeRole') }}" class="form">
        @csrf

        <h3 class="section-title">Basic Information</h3>

        <div class="form-grid">

            <!-- Role Name -->
            <div class="form-group">
                <label>Role Name</label>
                <input type="text" name="lable" required>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description</label>
                <textarea name="description"></textarea>
            </div>

            <!-- Status -->
            <div class="form-group">
                <label>Status</label>
                <select name="is_active" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

        </div>

        <!-- PERMISSIONS -->
        <h3 class="section-title">Permissions</h3>

        <div class="permission-box">

            @foreach ($permissions as $module => $modulePermissions)

                <div class="module-card">

                    <div class="module-title">
                        {{ ucfirst($module) }}
                    </div>

                    <div class="permission-grid">

                        @foreach ($modulePermissions as $permission)
                            <label class="checkbox-item">
                                <input type="checkbox"
                                       name="permissions[]"
                                       value="{{ $permission->id }}">
                                <span>{{ $permission->label ?? $permission->name }}</span>
                            </label>
                        @endforeach

                    </div>

                </div>

            @endforeach

        </div>

        <!-- BUTTON -->
        <div class="form-actions">
            <button type="submit" class="btn-primary">
                Save Role
            </button>
        </div>

    </form>

</div>

<style>
 /* =========================
   DESIGN SYSTEM
========================= */
:root{
    --primary:#2563eb;
    --primary-dark:#1d4ed8;
    --bg:#f1f5f9;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --border:#e2e8f0;
    --shadow:0 10px 25px rgba(0,0,0,0.06);
}

/* =========================
   CARD CONTAINER
========================= */
.form-card{
    background: var(--card);
    padding: 28px;
    border-radius: 16px;
    border: 1px solid var(--border);
    box-shadow: var(--shadow);
    max-width: 1000px;
    margin: auto;
}

/* =========================
   TITLE
========================= */
.form-title{
    font-size: 20px;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 18px;
}

/* =========================
   SECTION TITLE
========================= */
.section-title{
    font-size: 15px;
    font-weight: 700;
    color: var(--text);
    margin: 20px 0 12px;
    border-left: 4px solid var(--primary);
    padding-left: 10px;
}

/* =========================
   FORM GRID
========================= */
.form-grid{
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
    margin-bottom: 15px;
}

/* =========================
   FORM GROUP
========================= */
.form-group{
    display: flex;
    flex-direction: column;
}

.form-group label{
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 6px;
    color: var(--muted);
}

.form-group input,
.form-group select,
.form-group textarea{
    padding: 10px 12px;
    border: 1px solid var(--border);
    border-radius: 10px;
    font-size: 14px;
    background: #fff;
    transition: 0.2s;
    outline: none;
}

/* FOCUS */
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus{
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

/* =========================
   PERMISSION BOX
========================= */
.permission-box{
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* MODULE CARD (MODERN LOOK)
========================= */
.module-card{
    background: linear-gradient(180deg, #ffffff, #f8fafc);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 16px;
    transition: 0.2s;
}

.module-card:hover{
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

/* MODULE TITLE */
.module-title{
    font-size: 14px;
    font-weight: 800;
    color: var(--text);
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* OPTIONAL DOT */
.module-title::before{
    content:'';
    width:8px;
    height:8px;
    background: var(--primary);
    border-radius: 50%;
}

/* =========================
   PERMISSION GRID
========================= */
.permission-grid{
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 10px;
}

/* =========================
   CHECKBOX ITEM (MODERN CARD STYLE)
========================= */
.checkbox-item{
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13px;
    color: var(--text);
    cursor: pointer;
    padding: 8px 10px;
    border-radius: 10px;
    border: 1px solid transparent;
    transition: 0.2s;
    background: #fff;
}

.checkbox-item:hover{
    border-color: var(--primary);
    background: #eff6ff;
}

/* CHECKBOX */
.checkbox-item input{
    width: 16px;
    height: 16px;
    accent-color: var(--primary);
    cursor: pointer;
}

/* =========================
   TEXTAREA FIX
========================= */
.form-group textarea{
    min-height: 90px;
    resize: vertical;
}

/* =========================
   BUTTON
========================= */
.btn-primary{
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    border: none;
    padding: 12px 20px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: 0.2s;
}

.btn-primary:hover{
    transform: translateY(-2px);
    opacity: 0.95;
}

/* =========================
   RESPONSIVE
========================= */
@media(max-width:768px){
    .form-grid{
        grid-template-columns: 1fr;
    }

    .permission-grid{
        grid-template-columns: 1fr;
    }
}
</style>
@endsection