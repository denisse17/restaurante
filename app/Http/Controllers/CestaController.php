<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;

class CestaController extends Controller
{

    public function __construct(){
        if(!\Session::has('cesta')) \Session::put('cesta', array());
    }
    //mostrar cesta
    public function mostrar(){
        $cart= \Session::get('cesta');
        $total=$this->total();
        return view('restaurant.cart')->with([
            'cart'=>$cart,
            'total'=>$total
        ]);
    }
    //añadir item
    public function agregar(Producto $producto){
        $cart= \Session::get('cesta');
        $producto->cantidad=1;
        $cart[$producto->ficha]=$producto;
        \Session::put('cesta', $cart);
        return redirect()->route('cart');
    }
    //quitar item

    public function eliminar(Producto $producto){
        $cart=\Session::get('cesta');
        unset($cart[$producto->ficha]);
        \Session::put('cesta', $cart);
        return redirect()->route('cart');
    }

    //Actualizar cesta

    public function actualizar(Producto $producto, $cantidad){
        $cart=\Session::get('cesta');
        $cart[$producto->ficha]->cantidad=$cantidad;
        \Session::put('cesta', $cart);
        return redirect()->route('cart');

    }

    //Vaciar cesta

    public function eliminartodos(){
        \Session::forget('cesta');
        return redirect()->route('cart');
    }

    //total

    private function total(){
        $cart=\Session::get('cesta');
        $total=0;
        foreach($cart as $item){
            $total += $item->precio * $item->cantidad;
        }
        return $total;
    }

    public function detallePedido(){
        if(count(\Session::get('cesta'))<= 0) return redirect()->route('home');
        $cart=\Session::get('cesta');
        $total=$this->total();

        return view('restaurant.detalle')->with([
            'cart'=>$cart,
            'total'=>$total
        ]);
    }
}
