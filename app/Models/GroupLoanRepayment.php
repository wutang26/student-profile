<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupLoanRepayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_loan_id',
        'user_id',
        'amount',
        'payment_date'
    ];
}
