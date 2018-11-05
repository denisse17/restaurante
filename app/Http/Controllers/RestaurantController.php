<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Categoria;

class RestaurantController extends Controller
{
    public function index(){ 
        $categorias= Categoria::all();
        if (request()->categoria) {
            $productos = Producto::with('categorias')->whereHas('categorias', function ($query) {
                $query->where('ficha', request()->categoria);
            })->get();
           $categorias=Categoria::all();
        }else{
            $productos= Producto::inRandomOrder()->take(5)->get();
            $categorias=Categoria::all();
        }

        return view('restaurant.index')->with([
            'productos'=>$productos,
            'categorias'=>$categorias,
        ]);

    }

    public function verDetalles($ficha){
        $categorias=Categoria::all();
        $producto= Producto::where('ficha', $ficha)-> first();
        return view('restaurant.producto')->with([
            'producto'=>$producto,
            'categorias'=>$categorias,
        ]);
    }


}
