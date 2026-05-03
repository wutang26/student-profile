<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowRecord;
use App\Models\StoreItem;

class BorrowRecordController extends Controller
{  

 // =========================
    // LIST BORROWED ITEMS
    // =========================
    public function index(Request $request)
    {
         $query = BorrowRecord::with('item');

            if ($request->search) {
                $query->where('borrower_name', 'like', '%' . $request->search . '%')
                    ->orWhere('force_number', 'like', '%' . $request->search . '%')
                    ->orWhere('company', 'like', '%' . $request->search . '%')
                    ->orWhereHas('item', function ($q) use ($request) {
                        $q->where('name', 'like', '%' . $request->search . '%');
                    });
            }

            $borrows = $query->latest()->get();
            
        // $borrows = BorrowRecord::with('item')
        //     ->latest()
        //     ->get();

        return view('borrowItems.index', compact('borrows'));
    }

    // =========================
    // SHOW CREATE FORM
    // =========================
    public function create()
    {
        
        $items = StoreItem::where('available_quantity', '>', 0)->get();

        return view('borrowItems.create', compact('items'));
    }

    // =========================
    // STORE BORROW RECORD
    // =========================
    public function store(Request $request)
    {
    
        $data = $request->validate([
            'force_number' => 'nullable|string',
            'borrower_name' => 'required|string',

            'position' => 'nullable',

            'store_item_id' => 'required|exists:store_items,id',

            'category' => 'nullable|string',
            'quantity' => 'required|integer|min:1',

            'borrow_date' => 'required|date',
            'purpose' => 'nullable|string',

            'issued_by' => 'nullable|string',
            'issuer_role' => 'nullable',
            'company' => 'nullable',

            'note' => 'nullable|string',
        ]);

        // GET ITEM
        $item = StoreItem::findOrFail($data['store_item_id']);

        // CHECK STOCK
        if ($item->available_quantity < $data['quantity']) {
            return back()->with('error', 'Not enough stock available');
        }

        // REDUCE STOCK
        $item->available_quantity -= $data['quantity'];
        $item->save();

        // SET STATUS
        $data['status'] = 'borrowed';

        // SAVE RECORD
        BorrowRecord::create($data);

        return redirect()->route('borrowItems.index')
            ->with('success', 'Item borrowed successfully');
    }

    // =========================
    // MARK AS RETURNED
    // =========================
    public function updateStatus(BorrowRecord $borrowRecord)
    {
        if ($borrowRecord->status == 'returned') {
            return back()->with('info', 'Already returned');
        }

        // UPDATE STATUS
        $borrowRecord->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        // RESTORE STOCK
        $item = $borrowRecord->item;
        $item->available_quantity += $borrowRecord->quantity;
        $item->save();

        return back()->with('success', 'Item returned successfully');
    }

    //Return Form
    public function showReturnForm(BorrowRecord $borrowRecord)
{
    return view('borrowItems.receive_items', [
        'record' => $borrowRecord
    ]);
}

//Borrow Items Controller
public function returnedItems()
{
    $records = BorrowRecord::with('item')
        ->where('status', 'returned')
        ->latest()
        ->get();

    return view('borrowItems.returned', compact('records'));
}

//Bulk Return Items
public function bulkReturn(Request $request)
{
    $ids = $request->ids;

    if (!$ids) {
        return back()->with('error', 'No items selected');
    }

    $records = BorrowRecord::whereIn('id', $ids)->get();

    foreach ($records as $record) {

        if ($record->status == 'returned') continue;

        $record->update([
            'status' => 'returned',
            'return_date' => now(),
        ]);

        // restore stock
        $item = $record->item;
        $item->available_quantity += $record->quantity;
        $item->save();
    }

    return back()->with('success', 'Items returned successfully');
}
}
