<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nik',
        'phone',
        'gender',
        'birth_place',
        'birth_date',
        'address',
        'occupation',
        'emergency_contact_name',
        'emergency_contact_phone',
        'identity_document',
    ];

    protected function casts(): array
    {
        return [
            'birth_date' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class);
    }
}
