<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'division_id', 'status'];

    /**
     * Relationship: A District belongs to a Division (Mandal)
     */
    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Relationship: A District has many Blocks
     */
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
}
