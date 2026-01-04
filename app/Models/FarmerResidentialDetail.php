<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerResidentialDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'residential_type',
        'address_english',
        'address_local',
        'division_id',
        'district_id',
        'block_id',
        'village',
        'pincode',
        'is_latest',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔹 Division relation
    public function division()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    // 🔹 District relation
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }

    // 🔹 Block relation
    public function block()
    {
        return $this->belongsTo(Block::class, 'block_id');
    }
}
