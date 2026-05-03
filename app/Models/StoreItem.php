<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreItem extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'category',
        'quantity',
        'available_quantity',
        'description'
    ];

    public function borrowRecords()
    {
        return $this->hasMany(BorrowRecord::class);
    }
}
