<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'preco',
        'src',
        'ativo',
        'vendedor'
    ];

    public function vendedor()
    {
        return $this->belongsTo(User::class);
    }
}
