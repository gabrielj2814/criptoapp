@extends("dashboard.dashboard")
@section("head")
    <title>pagina de inicio</title>
@endsection
@section("main")
    <header>
        <nav class="menu-desktop">
            <ul class="lista-items-menu">
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Suscripciones</a></li>
                <li><a href="#">Predicciones</a></li>
            </ul>
            <div>
                <button class="boton"> Perfil </button>
                <button class="boton"> Log Out </button>
            </div>
        </nav>
    </header>
    <section>
        {{-- <h2>hola</h2> --}}
    </section>
@endsection
