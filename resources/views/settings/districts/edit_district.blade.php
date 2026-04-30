@extends('layouts.admin')

@section('content')

<style>
    /* PAGE TITLE */
    .page-title {
        font-size: 28px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* GRID */
    .grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 20px;
    }

    /* BACK LINK */
    .back-link {
        color: #2563eb;
        text-decoration: none;
        font-size: 14px;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    /* CARD */
    .card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        max-width: 700px;
        margin: auto;
    }

    .card h2 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 22px;
        font-weight: bold;
    }

    /* SECTION TITLE */
    .section-title {
        font-size: 16px;
        font-weight: 600;
        border-bottom: 1px solid #e5e7eb;
        padding-bottom: 5px;
        margin-bottom: 15px;
    }

    /* FORM GRID */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    @media (max-width: 768px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }

    /* FORM GROUP */
    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        margin-bottom: 6px;
        font-weight: 500;
        font-size: 14px;
    }

    /* INPUTS */
    .form-input {
        padding: 10px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        font-size: 14px;
        outline: none;
    }

    .form-input:focus {
        border-color: #2563eb;
    }

    /* BUTTON */
    .btn {
        background: #2563eb;
        color: #fff;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn:hover {
        background: #1d4ed8;
    }

    .btn-center {
        text-align: center;
        margin-top: 30px;
    }
</style>

<h1 class="page-title">Districts</h1>

<div class="grid">

    <!-- Back Button -->
    <div>
        <a href="{{ route('settings.district') }}" class="back-link">
            &larr; Back
        </a>
    </div>

    <!-- Form Card -->
    <div class="card">

        <h2>Edit District</h2>

        <form method="POST" action="{{ route('settings.districts.updateDistrict', $district->id) }}">
            @csrf
            @method('PUT')

            <div class="section-title">
                Basic Information
            </div>

            <div class="form-grid">

                <!-- District Name -->
                <div class="form-group">
                    <label>District Name</label>
                    <input type="text"
                           name="name"
                           class="form-input"
                           required
                           value="{{ old('name', $district->name) }}">
                </div>

                <!-- Region -->
                <div class="form-group">
                    <label>Region</label>
                    <select name="region_id" class="form-input" required>
                        <option value="">-- Select Region --</option>

                        @foreach ($regions as $region)
                            <option value="{{ $region->id }}"
                                {{ old('region_id', $district->region_id) == $region->id ? 'selected' : '' }}>
                                {{ $region->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <!-- Submit -->
            <div class="btn-center">
                <button type="submit" class="btn">
                    Update District
                </button>
            </div>

        </form>

    </div>
</div>

@endsection