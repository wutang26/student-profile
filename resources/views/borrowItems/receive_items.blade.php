@extends('layouts.admin')

@section('content')

<style>
.page-wrapper {
    padding: 20px;
    background: #f4f6f9;
}

/* CARD */
.card-modern {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* HEADER */
.card-header-modern {
    background: linear-gradient(135deg, #16a34a, #15803d);
    color: white;
    padding: 16px 20px;
}

/* BODY */
.card-body-modern {
    padding: 25px;
}

/* GRID */
.grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 15px;
}

.full { grid-column: span 2; }

/* INPUT */
label {
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 5px;
    display: block;
}

input, textarea {
    width: 100%;
    padding: 11px;
    border-radius: 10px;
    border: 1px solid #ddd;
}

input:focus, textarea:focus {
    border-color: #16a34a;
    box-shadow: 0 0 0 3px rgba(22,163,74,0.15);
}

/* FOOTER */
.card-footer-modern {
    padding: 15px 25px;
    background: #fafafa;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* BUTTON */
.btn-return {
    background: #16a34a;
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    border: none;
}

/* BADGE */
.badge-info {
    background: #e0f2fe;
    color: #0369a1;
    padding: 5px 10px;
    border-radius: 8px;
    font-size: 12px;
}
</style>

<div class="page-wrapper">

    <!-- HEADER -->
    <div class="mb-4">
        <h4>📥 Receive Returned Item</h4>
        <small class="text-muted">Confirm and record returned store item</small>
    </div>

    <form method="POST" action="{{ route('borrow.return', $record->id) }}">
        @csrf
        @method('PATCH')

        <div class="card-modern">

            <!-- HEADER -->
            <div class="card-header-modern">
                <h5>✔ Return Item</h5>
            </div>

            <!-- BODY -->
            <div class="card-body-modern">

                <div class="grid-2">
                    <div>
                        <label>Force Number</label>
                        <input type="text" value="{{ $record->force_number }}" disabled>
                    </div>
                    
                    <div>
                        <label>Borrower</label>
                        <input type="text" value="{{ $record->borrower_name }}" disabled>
                    </div>

                    <div>
                        <label>Item</label>
                        <input type="text" value="{{ $record->item->name }}" disabled>
                    </div>

                    <div>
                        <label>Quantity Borrowed</label>
                        <input type="text" value="{{ $record->quantity }}" disabled>
                    </div>

                    <div>
                        <label>Borrow Date</label>
                        <input type="text" value="{{ $record->borrow_date }}" disabled>
                    </div>

                    <div>
                        <label>Company</label>
                        <input type="text" value="{{ $record->company }}" disabled>
                    </div>

                    <!-- RETURN NOTE -->
                    <div class="full">
                        <label>Return Note (optional)</label>
                        <textarea name="note" rows="3"></textarea>
                    </div>

                </div>

            </div>

            <!-- FOOTER -->
            <div class="card-footer-modern">
                <small class="badge-info">Stock will be restored automatically</small>
                <button class="btn-return">✔ Confirm Return</button>
            </div>

        </div>

    </form>

</div>

@endsection