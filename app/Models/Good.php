<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    /** @use HasFactory<\Database\Factories\GoodFactory> */
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'user_id'];



    public function user() {

    return $this->belongsTo(User::class, 'user_id');
    
    }
}
