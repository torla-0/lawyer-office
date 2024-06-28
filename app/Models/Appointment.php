<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'agenda',
        'user_id',
        'lawyer_id',
        'date',
        'time',
        'status'
    ];
    // Relations
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function lawyer(){
        return $this->belongsTo(Lawyer::class);
    }
}
