<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StoreItem;

class StoreItemController extends Controller
{
    public function index()
    {
        $items = StoreItem::latest()->get();
        return view('storeItems.index', compact('items'));
    }

    public function create()
    {
        return view('storeItems.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'nullable',
            'quantity' => 'required|integer',
            'description' => 'nullable'
        ]);

        $data['available_quantity'] = $data['quantity'];

        StoreItem::create($data);

        return redirect()->route('storeItems.index')
            ->with('success', 'Item added successfully');
    }

    public function edit(StoreItem $storeItem)
    {
        return view('storeItems.edit', compact('storeItem'));
    }

    public function update(Request $request, StoreItem $storeItem)
    {
        $data = $request->validate([
            'name' => 'required',
            'category' => 'nullable',
            'quantity' => 'required|integer',
            'description' => 'nullable'
        ]);

        $storeItem->update($data);

        return redirect()->route('storeItems.index')
            ->with('success', 'Updated successfully');
    }

    public function destroy(StoreItem $storeItem)
    {
        $storeItem->delete();

        return back()->with('success', 'Deleted successfully');
    }
}
