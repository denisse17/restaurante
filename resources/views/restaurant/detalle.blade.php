@extends('restaurant.template')
@section('content')

<div class="container">
    <h1>Detalle del pedido</h1>

    <div>
        <div class="table responsive">
        Usuario
            <table class="table table-striped table-hover table-bordered">
                <tr><td>Nombre: </td><td>{{Auth::user()->nombres . " ". Auth::user()->apellidos}}</td></tr>
                <tr><td>Usuario: </td><td>{{Auth::user()->user}}</td></tr>
                <tr><td>Email: </td><td>{{Auth::user()->email}}</td></tr>
                <tr><td>Dirección: </td><td>{{Auth::user()->direccion}}</td></tr>
            </table>
        </div>
        <div class="table responsive">
        Pedido
            <table class="table table-striped table-hover table-bordered">
                <tr>
                    <td>Producto</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Subtotal</td>
                </tr>
                @foreach($cart as $item)
                <tr>
                    <td>{{$item->nombre}}</td>
                    <td>S/.{{number_format($item->precio, 2)}}</td>
                    <td>{{$item->cantidad}}</td>
                    <td>S/.{{number_format($item->precio*$item->cantidad, 2)}}</td>
                </tr>
                @endforeach
            </table>
            <hr>
            <h3>
                <span>Total: {{number_format($total, 2)}}</span>
            </h3>
            <p><a href="{{route('cart')}}" class="btn btn-warning">Seguir comprando</a>
            <a href="{{route('pago')}}" class="btn btn-primary"><i class="fa fa-paypal"></i> Pagar con paypal</a>
            </p>
        </div>
    </div>
</div>
@stop