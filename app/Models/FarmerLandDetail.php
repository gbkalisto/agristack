<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerLandDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'khata_number',
        'plot_numbers',
        'total_land',
        'irrigation_source',
        'ownership_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
