<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminQuery extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id', 
        'method', 
        'query'
    ];

    // Relations
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
