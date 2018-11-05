

@extends('restaurant.template')
@section('content')

<div class="container-detalle">
        <div class="contain-detalle">
            <div class="detalle-producto">
                <div class="img-producto">
                    <div>
                        <img src="{{ $producto-> imagen}}" alt="producto"> </div>
                </div>
                <div class="des-producto">
                    <h3>{{ $producto->nombre}}</h3>
                    <div class="precio-producto">S/.{{number_format($producto->precio, 2)}}</div>
                    <div class="descripcion-producto">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi, dolor. Quidem atque doloremque
                            id, temporibus enim nesciunt asperiores officiis totam repellendus tenetur, illo nulla reprehenderit
                            odit ipsum commodi voluptate reiciendis. Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit. Nesciunt suscipit odit dolorem hic ipsam totam autem est, nulla accusamus fuga sequi expedita
                            cupiditate illo, aliquid nostrum doloremque neque aut praesentium. Lorem ipsum dolor sit amet
                            consectetur adipisicing elit. Quam adipisci, nihil accusamus totam ex blanditiis nostrum repellendus
                            perferendis molestiae nulla doloribus sit delectus dolores iste magnam, cumque dolorum assumenda
                            dicta!
                        </p>
                    </div>
                    <div class="caja-cantidad">
                        <div class="cantidad">
                            <input type="text">
                        </div>
                        <div class="btn-add">
                            <a href="{{route('cart-agregar', $producto->ficha)}}">Agregar a la cesta</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="contain-menu">
            <div class="contain-categorias">
                <div class="lista-menu">
                    <h3>Categorías del menú</h3>
                    <ul>
                         @foreach ($categorias as $categoria)
                    <li><a href="{{route('tienda.index', ['categoria'=>$categoria->ficha])}}">{{$categoria->nombre }}</a></li>
                    @endforeach
                    
                    </ul>
                </div>
            </div>
        </div>
    </div>


@endsection