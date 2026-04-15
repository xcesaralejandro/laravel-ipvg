<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pet extends Model
{
    use SoftDeletes;
    
    protected $table = 'pets';

    protected $fillable = [
        'user_id',
        'name',
        'species',
        'birth_date',
        'gender',
        'weight',
        'color',
        'photo'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function medicalVisits(){
        return $this->hasMany(MedicalVisit::class, 'pet_id', 'id');
    }
}
