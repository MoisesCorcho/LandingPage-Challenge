<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{route('landingPage.index')}}">
            <img src="{{asset('images/logo4.png')}}" alt="Logo" style="max-height: 60px;">
        </a>
        <!-- Botones de selección de idioma y login -->
        <div class="ml-auto">
            <!-- Botón para cambiar idioma -->
            <div class="dropdown d-inline-block">
                <button
                    class="btn btn-secondary dropdown-toggle"
                    type="button"
                    id="languageDropdown"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    {{__('Idioma')}}
                </button>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="languageDropdown">
                    <a class="dropdown-item" href="{{ url('locale/es') }}">Español</a>
                    <a class="dropdown-item" href="{{ url('locale/en') }}">Inglés</a>
                </div>
            </div>
            <!-- Botón de login -->
            <div class="d-inline-block">
                <a class="btn btn-primary ml-2" href="{{route('login')}}">{{ __('Login') }}</a>
            </div>
        </div>
    </div>
</nav>
