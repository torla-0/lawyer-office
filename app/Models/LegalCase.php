<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegalCase extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'case_type_id',
        'description',
        'user_id',
        'status',
        'lawyer_id',
        'start_date',
        'end_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function caseType()
    {
        return $this->belongsTo(CaseType::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
    public function lawyer()
    {
        return $this->belongsTo(Lawyer::class);
    }
}
