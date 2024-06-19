<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'src',
        'active',
        'seller'
    ];

    public function scopeByActive($query, $status = null)
    {
        if ($status === true) {
            return $query->where('active', true);
        } elseif ($status === false) {
            return $query->where('active', false);
        }

        // Se nenhum valor for passado, retorne todos os registros
        return $query;
    }

    public function scopeByUser($query, $user_id)
    {
        return $query->where('seller', $user_id);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller');        
    }
}
