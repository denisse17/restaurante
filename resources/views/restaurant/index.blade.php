@extends('restaurant.template')
@section('content')

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
    @foreach($categorias as $categoria)
      <li class="nav-item">
      <!--  <a class="nav-link active" href="{{route('detalle-producto', $categoria->id)}}">{{$categoria-> nombre}}</a>-->
     <!-- <a class="nav-link active" href="{{route('tienda.index', ['categoria'=> $categoria->ficha] )}}">{{$categoria-> nombre}}</a>-->
      <a href="{{route('tienda.index', ['categoria'=>$categoria->ficha])}}">{{$categoria->nombre }}</a>
      </li>
      @endforeach
    </ul>
  </div>
  <div class="card-body">
  @forelse ($productos as $producto)
                    <div class="product">
                        <a href="{{ route('detalle-producto', $producto->ficha) }}"><img src="{{ $producto->imagen }}" alt="producto"></a>
                        <a href="{{ route('detalle-producto', $producto->ficha) }}"><div class="product-name">{{ $producto->nombre }}</div></a>
   
                    </div>
                @empty
                    <div style="text-align: left">No items found</div>
                @endforelse
  </div>
</div>
@stop