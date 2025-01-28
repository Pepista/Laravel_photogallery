<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class ProfileController extends Authenticatable
{
    use HasFactory, Notifiable;

    // Povolené atributy pro hromadné přiřazení
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Chráněné atributy, které nelze hromadně přiřadit
    protected $guarded = [];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
