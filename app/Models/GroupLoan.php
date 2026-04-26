<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupLoan extends Model
{
    use HasFactory;
    protected $fillable = [
        'group_id',
        'total_amount',
        'interest_rate',
        'duration',
        'start_date'
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function members()
    {
        return $this->hasMany(GroupLoanMember::class);
    }

    public function repayments()
    {
        return $this->hasMany(GroupLoanRepayment::class);
    }

    public function getBalanceAttribute()
    {
        return $this->total_amount - $this->repayments()->sum('amount');
    }
}
