<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    Use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
    ];

    public function carritoItems(){
        return $this->hasMany(CarritoItem::class, 'usuario_id');
    }

    public function ordenes(){
        return $this->hasMany(Orden::class, 'usuario_id');
    }
}
