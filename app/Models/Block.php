<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Block extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'district_id',
        'status',
    ];

    /**
     * A Block belongs to a District
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    /**
     * Optional helper: Get the Division through District
     * You can call $block->division
     */
    public function division()
    {
        return $this->district ? $this->district->division : null;
    }
}
