@if(Auth::check())
<li class="dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i>{{ Auth::user()-> user}}</a>
<ul class="dropdown-menu" role="menu">
    <li><a href="{{route('logout')}}">Salir</a></li>
</ul>
</li>
@else
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-user"></i></a>
    <ul class="dropdown-menu" role="menu">
        <li><a href="{{route('login')}}">Iniciar sesion</a></li>
    </ul>
</li>
@endif