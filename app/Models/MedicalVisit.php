<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalVisit extends Model
{
    use SoftDeletes;

    protected $table = 'medical_visits';

    protected $fillable = [
        'pet_id',
        'visit_date',
        'reason',
        'diagnosis',
        'treatment',
        'notes'
    ];

    public function pet(){
        return $this->belongsTo(Pet::class, 'pet_id');
    }
}
