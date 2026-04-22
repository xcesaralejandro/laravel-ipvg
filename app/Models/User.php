<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table = 'users';
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
        'gender',
        'birth_date',
    ];
    protected $hidden = [
        'password'
    ];

    public function pets(){
        return $this->hasMany(Pet::class, 'user_id', 'id');
    }
}
