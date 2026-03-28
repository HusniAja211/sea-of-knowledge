<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Storage;


use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'nik',
        'address',
        'password',
        'role_id',
        'pfp',
    ];

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

    // Helpers methods untuk homepage based role
    public function dashboardRoute(): string
    {
        $role = strtolower(optional($this->role)->name ?? '');
        return match ($role) {
            'admin'  => 'admin.index',
            'seller' => 'seller.index',
            'buyer'  => 'buyer.dashboard',
            default  => 'dashboard',
        };
    }

    // Helpers untuk policy
    public function hasRole(string $role): bool
    {
        return strtolower(optional($this->role)->name) === strtolower($role);
    }

    // Helpers untuk get pfp atribute
   public function getAvatarUrlAttribute()
    {
        if ($this->pfp && Storage::disk('public')->exists($this->pfp)) {
            return asset('storage/' . $this->pfp);
        }

        return asset('storage/avatars/defaultpfp.png');
    }

    //Relasi
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    } 

    public function products()
    {
        return $this->hasMany(Product::class, 'seller_id');
    }
}
