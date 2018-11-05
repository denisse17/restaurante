@extends('restaurant.template')
@section('content')

            <div class="section-menu">
        <div>
            <h3 class="section-menu-title">Descubre nuestro menú</h3>
            <div class="section-menu-nav">

                <ul>
                @foreach ($categorias as $categoria)
                    <li><a href="{{route('tienda.index', ['categoria'=>$categoria->ficha])}}">{{$categoria->nombre }}</a></li>
                    @endforeach

                </ul>
            </div>
            <div class="contenedor-menu">
                <div class="contenido-menu">
                @forelse ($productos as $producto)
                    <div class="item-menu">
                        <div class="item-menu-contenido">
                            <div class="item-menu-imagen"><img src="{{ $producto->imagen }}" alt="hamburguesa" /></div>
                            <div class="item-menu-text">
                                <h6><a href="{{ route('detalle-producto', $producto->ficha) }}">{{ $producto->nombre }}</a></h6>
                                <div class="item-menu-des">
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Cumque doloremque
                                        molestias

                                    </p>
                                </div>
                                <div class="item-menu-precio">S/.{{ $producto->precio }}</div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="text-align: left">No items found</div>
                    @endforelse
                    
                   
                </div>
            </div>
        </div>
    </div>
    @endsection
    