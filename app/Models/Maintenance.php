<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'tenant_id',
        'title',
        'description',
        'reported_at',
        'status',
        'cost',
        'charged_to',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'reported_at' => 'datetime',
            'cost' => 'decimal:2',
            'completed_at' => 'datetime',
        ];
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
}
