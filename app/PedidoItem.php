<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    protected $table='pedido_items';
    protected $fillable=['precio', 'cantidad', 'producto_id', 'pedido_id'];
    public $timestamps= false;
}
