@extends('restaurant.template')
@section('content')

<div class="card text-center">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
    @foreach($productos as $producto)
      <li class="nav-item">
        <a class="nav-link active" href="#">{{$producto-> nombre}}</a>
      </li>
      @endforeach
    </ul>
  </div>
</div>

@stop