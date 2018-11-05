@extends('restaurant.template')
@section('content')
<div>
    <div>
        @if(count($cart))
        <div><a href="{{route('cart-eliminar-todos')}}">Vaciar cesta</a></div>
        <div>
            <table>
                <thead>
                    <tr>
                        <th class="">&nbsp;</th>
                        <th class="">&nbsp;</th>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $item)
                    <tr>
                        <td><a href="{{route('cart-eliminar',$item->ficha)}}"><i class="fa fa-close"></i>Eliminar</a></td>
                        <td><img src="{{$item->imagen}}" alt=""></td>
                        <td>{{$item->nombre}}</td>
                        <td>S/.{{number_format($item->precio, 2)}}</td>
                        <td><input type="text" min="1" max="100" value="{{$item->cantidad}}" id="producto_{{$item->id}}">
                            <a href="#" class="btn-actualizar" data-href="{{route('cart-actualizar', $item->ficha)}}" data-id="{{$item->id}}"><i class="fa fa-refresh" ></i>Actualizar</a>
                        </td>
                        <td>S/.{{number_format($item->precio * $item->cantidad,2)}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div>
                <h3>
                    <span>Total: S/. {{number_format($total, 2)}}</span>
                </h3>
            </div>
        </div>
        @else
        <h3><span>No hay productos en la cesta</span></h3>
        @endif
    </div>
    <div>
        <a href="{{route('tienda.index')}}">Retornar</a>
        <a href="{{route('detalle-pedido')}}">Continuar</a>
    </div>
</div>
@stop