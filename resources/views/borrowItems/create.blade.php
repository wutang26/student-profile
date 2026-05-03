@extends('layouts.admin')

@section('content')

<style>
.page-wrapper {
    padding: 20px;
    background: #f4f6f9;
    min-height: 100vh;
}

/* HEADER */
.page-header {
    background: #fff;
    padding: 18px;
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.06);
    margin-bottom: 20px;
}

/* CARD */
.form-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.08);
    overflow: hidden;
}

/* HEADER */
.form-card-header {
    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;
    padding: 15px 20px;
}

/* GRID */
.form-body {
    padding: 25px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.full { grid-column: span 2; }

label {
    font-weight: 600;
    font-size: 13px;
    margin-bottom: 6px;
    display: block;
}

.form-control, select, textarea {
    width: 100%;
    padding: 11px;
    border-radius: 10px;
    border: 1px solid #e5e7eb;
    outline: none;
}

.form-control:focus, select:focus, textarea:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
}

.form-footer {
    padding: 15px 25px;
    background: #fafafa;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.btn-save {
    background: #16a34a;
    color: white;
    padding: 12px 20px;
    border-radius: 10px;
    border: none;
}
</style>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="page-wrapper">

    <!-- HEADER -->
    <div class="page-header">
        <h3>📦 Borrow Store Items</h3>
        <small>Fill all required details before issuing items</small>
    </div>

    <form method="POST" action="{{ route('borrowItems.store') }}">
        @csrf

        <div class="form-card">

            <!-- HEADER -->
            <div class="form-card-header">
                <h5>📤 Borrow Items Form From A Store</h5>
                <!-- <small>From A Store</small> -->
            </div>

            <div class="form-body">

                <!-- FORCE NUMBER -->
                <div>
                    <label>Force Number</label>
                    <input type="text" name="force_number" class="form-control" required>
                </div>

                <!-- BORROWER NAME -->
                <div>
                    <label>Borrower Name</label>
                    <input type="text" name="borrower_name" class="form-control" required>
                </div>

                <!-- POSITION -->
                <div>
                    <label>Position</label>
                    <select name="position">
                        <option value="platoon_leader">Platoon Leader</option>
                        <option value="karani">Karani</option>
                        <option value="oc">OC</option>
                        <option value="company_sergeant_major">Company Sergeant Major</option>
                    </select>
                                        
                </div>

                <!-- ITEM NAME -->
                <div>
                    <label>Item Name</label>
                    <select name="store_item_id">
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- CATEGORY -->
                <div>
                    <label>Category</label>
                    <input type="text" name="category" class="form-control">
                </div>

                <!-- QUANTITY -->
                <div>
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" required>
                </div>

                <!-- BORROW DATE -->
                <div>
                    <label>Borrowing Date</label>
                    <input type="date" name="borrow_date" class="form-control" required>
                </div>

                <!-- PURPOSE -->
                <div class="full">
                    <label>Purpose / Reason</label>
                    <textarea name="purpose" rows="3" class="form-control"></textarea>
                </div>

                <!-- ISSUED BY -->
                <div>
                    <label>Issued By</label>
                    <input type="text" name="issued_by" class="form-control">
                </div>

                <!-- ISSUER POSITION -->
                <div>
                    <label>Issuer Position</label>
                    <select name="issuer_role">
                        <option value="karani">Karani</option>
                        <option value="katibu">Katibu</option>
                        <option value="company_sergeant_major">Company Sergeant Major</option>
                        <option value="instructor">Instructor</option>
                        <option value="adjutant">Adjutant</option>
                        <option value="chiefinstructor">Chief Instructor</option>
                        <option value="chiefmatron">Chief Matron</option>
                        <option value="commandant">Commandant</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <!-- COMPANY -->
                <div>
                    <label>Company</label>
                    <select name="company">
                        <option value="hq-coy">HQ-COY</option>
                        <option value="a-coy">A-COY</option>
                        <option value="b-coy">B-COY</option>
                        <option value="c-coy">C-COY</option>
                    </select>
                </div>

            </div>

            <div class="form-footer">
                <small>💡 Ensure correct details before issuing items</small>
                <button class="btn-save">📤 Borrow Item</button>
            </div>

        </div>

    </form>

</div>

@endsection