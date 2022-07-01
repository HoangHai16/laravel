<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The roles that belong to the User
     *
     */
    public function roles()
    {
        // Do 2 bảng map vs nhau mqh n n nên dùng belong...,
        // Tham số truyền vào, class, bảng, 2 khóa ngoại
        return $this->belongsToMany(Role::class);
    }
    public function checkPermissionAccess(){
        // B1: Lay tat ca cac quyen cua user dang login vao he thong
        // B2: So sanh gtri dua vao route hien tai xem co ton tai trong cac quyen ma minh lay duoc k
        // $roles = auth()->user()->roles;
        // dd($roles);
    }
}
