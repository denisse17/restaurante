<?php

namespace App\Http\Controllers;
use App\Categoria;
use App\Producto;
use Illuminate\Http\Request;


class TiendaController extends Controller
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

        return view('restaurant.tienda')->with([
            'productos'=>$productos,
            'categorias'=>$categorias,
        ]);
    }

    public function mostrar($ficha)
   {
        $categorias= Categoria::all();
        $producto = Producto::where('ficha', $ficha)->firstOrFail();
       return view('restaurant.producto')->with([
          'producto' => $producto,
          'categorias'=>$categorias,
     ]);
   }
}
