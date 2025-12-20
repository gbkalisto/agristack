<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerCropDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'main_crop',
        'secondary_crop',
        'season',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
