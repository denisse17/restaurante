<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public function presentPrice()
    {
        return money_format('$%i', $this->precio / 100);
    }
    
    public function categorias(){
        return $this->belongsToMany('App\Categoria');
    }
}
