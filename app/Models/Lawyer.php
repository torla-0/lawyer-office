<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lawyer extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'specialization',
        'years_of_exp'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function legalCases()
    {
        return $this->hasMany(LegalCase::class);
    }
    public function appointments(){
        return $this->hasMany(Appointment::class);
    }
}
