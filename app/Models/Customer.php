<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'nationality'];

    public function details()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}