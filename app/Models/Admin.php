<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'admin'; // Menentukan guard yang digunakan untuk model Admin
    protected $table = 'admins'; // Nama tabel yang sesuai dengan model Admin
    protected $primaryKey = 'id'; // Primary key dari tabel Admin


    // Metode untuk memeriksa peran pengguna
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
