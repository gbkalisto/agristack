<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];
    protected $guarded = [];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function landDetail()
    {
        return $this->hasOne(FarmerLandDetail::class);
    }

    public function cropDetail()
    {
        return $this->hasOne(FarmerCropDetail::class);
    }

    public function bankDetail()
    {
        return $this->hasOne(FarmerBankDetail::class);
    }

    public function documents()
    {
        return $this->hasOne(FarmerDocument::class);
    }
    public function residentialDetail()
    {
        return $this->hasOne(FarmerResidentialDetail::class);
    }
    public function filledByAdmin()
    {
        return $this->belongsTo(AdminUser::class, 'filled_by_admin_user_id');
    }
}
