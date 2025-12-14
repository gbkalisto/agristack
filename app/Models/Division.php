<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];

    /**
     * A Division (Mandal) has many Districts.
     */
    public function districts()
    {
        return $this->hasMany(District::class);
    }
}
