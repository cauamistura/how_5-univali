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

    public function scopeByActive($query, $status = null)
    {
        if ($status === true) {
            return $query->where('ativo', true);
        } elseif ($status === false) {
            return $query->where('ativo', false);
        }

        // Se nenhum valor for passado, retorne todos os registros
        return $query;
    }

    public function scopeByUser($query, $user_id)
    {
        return $query->where('vendedor_id', $user_id);
    }

    public function vendedor()
    {
        return $this->belongsTo(User::class);
    }
}
