<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_id',
        'billing_period',
        'due_date',
        'amount',
        'late_fee',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'billing_period' => 'date',
            'due_date' => 'date',
            'amount' => 'decimal:2',
            'late_fee' => 'decimal:2',
        ];
    }

    public function rental()
    {
        return $this->belongsTo(Rental::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
