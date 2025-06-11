<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['laptop_id', 'user_name', 'jumlah', 'total_harga'];

    public function laptop()
    {
        return $this->belongsTo(\App\Models\Laptop::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}