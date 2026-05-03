@extends('layouts.admin')

@section('content')

<style>
/* ===== PAGE LAYOUT ===== */
.page-wrapper {
    padding: 20px;
    background: #f4f6f9;
    min-height: 100vh;
}

/* HEADER CARD */
.page-header {
    background: #fff;
    padding: 18px 22px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    margin-bottom: 20px;
}

.page-title {
    font-size: 20px;
    font-weight: 700;
    margin: 0;
    color: #1e293b;
}

.page-subtitle {
    font-size: 13px;
    color: #6b7280;
}

/* FORM CARD */
.form-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* HEADER */
.form-card-header {
    background: linear-gradient(135deg, #0b8cf5, #06d9ab);
    color: white;
    padding: 16px 20px;
}

/* BODY GRID */
.form-body {
    padding: 25px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

/* FULL WIDTH FIELD */
.full {
    grid-column: span 2;
}

/* LABEL */
.form-group label {
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 6px;
    display: block;
    color: #374151;
}

/* INPUT */
.form-control {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    outline: none;
    transition: 0.2s;
    font-size: 14px;
}

.form-control:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245,158,11,0.15);
}

/* INPUT ICON */
.input-icon {
    display: flex;
    align-items: center;
    background: #f3f4f6;
    border-radius: 10px;
    padding: 0 10px;
}

.input-icon span {
    margin-right: 8px;
}

/* FOOTER */
.form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 18px 25px;
    border-top: 1px solid #eee;
    background: #fafafa;
}

/* BUTTON */
.btn-update {
    background: #f59e0b;
    color: white;
    padding: 12px 22px;
    border: none;
    border-radius: 10px;
    font-weight: 600;
    cursor: pointer;
}

.btn-update:hover {
    background: #d97706;
}

/* MOBILE */
@media(max-width: 768px) {
    .form-body {
        grid-template-columns: 1fr;
    }
}
</style>

<div class="page-wrapper">

    <!-- HEADER -->
    <div class="page-header">
        <h3 class="page-title">✏️ Edit Store Item</h3>
        <p class="page-subtitle">Update store item details (fagio, ndoo, mafyekeo, etc)</p>
    </div>

    <!-- FORM -->
    <form method="POST" action="{{ route('storeItems.update', $storeItem->id) }}">
        @csrf
        @method('PUT')

        <div class="form-card">

            <!-- CARD HEADER -->
            <div class="form-card-header">
                <h5>✏️ Update Store Item</h5>
                <small>Edit item information carefully</small>
            </div>

            <!-- BODY -->
            <div class="form-body">

                <!-- ITEM NAME -->
                <div class="form-group">
                    <label>Item Name</label>
                    <div class="input-icon">
                        <span>📦</span>
                        <input type="text" name="name"
                               value="{{ $storeItem->name }}"
                               class="form-control" required>
                    </div>
                </div>

                <!-- CATEGORY -->
                <div class="form-group">
                    <label>Category</label>
                    <div class="input-icon">
                        <span>🏷️</span>
                        <input type="text" name="category"
                               value="{{ $storeItem->category }}"
                               class="form-control">
                    </div>
                </div>

                <!-- QUANTITY -->
                <div class="form-group">
                    <label>Total Quantity</label>
                    <div class="input-icon">
                        <span>🔢</span>
                        <input type="number" name="quantity"
                               value="{{ $storeItem->quantity }}"
                               class="form-control" required>
                    </div>
                </div>

                <!-- DESCRIPTION -->
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" rows="4"
                              class="form-control">{{ $storeItem->description }}</textarea>
                </div>

            </div>

            <!-- FOOTER -->
            <div class="form-footer">
                <small>💡 Ensure updates do not break stock records</small>
                <button class="btn-update">💾 Update Item</button>
            </div>

        </div>

    </form>

</div>

@endsection