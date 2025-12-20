<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class AdminUser extends Authenticatable
{
    use Notifiable;

    protected $table = 'admin_users';

    protected $fillable = [
        'name',
        'user_name',
        'email',
        'mobile',
        'profile_picture',
        'password',
        'role',
        'division_id',
        'district_id',
        'block_id',
        'status',
        'otp',
        'otp_expires_at',
        'otp_verified',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'otp',
        'otp_expires_at',
        'otp_verified',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    // App\Models\AdminUser.php

    public function farmers()
    {
        return $this->hasMany(User::class, 'filled_by_admin_user_id');
    }
}
