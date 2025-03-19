<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'imagen',
        'destacado',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'destacado' => 'boolean',
    ];

    public function carritoItems(){
        return $this->hasMany(carritoItem::class, 'producto_id');
    }

    public function ordenItems(){
        return $this->hasMany(OrdenItem::class, 'producto_id');
    }
}
