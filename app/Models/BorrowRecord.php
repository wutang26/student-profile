<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowRecord extends Model
{
    use HasFactory;
     protected $fillable = [

        // BORROWER INFO
        'force_number',
        'borrower_name',
        'position',

        // ITEM INFO
        'store_item_id',
        'category',
        'quantity',

        // BORROW DETAILS
        'borrow_date',
        'purpose',

        // ISSUING INFO
        'issued_by',
        'issuer_role',

        // COMPANY INFO
        'company',

        // RETURN TRACKING
        'return_date',
        'status',

        // EXTRA
        'note',
    ];

    /**
     * ITEM RELATIONSHIP
     */
    public function item()
    {
        return $this->belongsTo(StoreItem::class, 'store_item_id');
    }

    /**
     * OPTIONAL: SCOPE FOR BORROWED ONLY
     */
    public function scopeBorrowed($query)
    {
        return $query->where('status', 'borrowed');
    }

    /**
     * OPTIONAL: SCOPE FOR RETURNED ONLY
     */
    public function scopeReturned($query)
    {
        return $query->where('status', 'returned');
    }
}
