<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes';
    
    protected $fillable = [
        'usuario_id',
        'monto_total',
        'estado',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function items()
    {
        return $this->hasMany(OrdenItem::class, 'orden_id');
    }
}