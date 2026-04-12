<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'name',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // IMPORTANTE: Usar 'username' en lugar de 'email' para autenticación
    public function username()
    {
        return 'username';
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}