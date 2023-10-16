<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'amount',
        'date',
        'reference',
        'expense_category_id',
        'image',
    ];

    public function expensePurpose()
    {
        return $this->belongsTo(ExpensePurpose::class, 'expense_category_id');
    }
}
