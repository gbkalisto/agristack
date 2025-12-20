<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FarmerDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'aadhaar_file',
        'land_papers',
        'bank_passbook',
        'photo',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
