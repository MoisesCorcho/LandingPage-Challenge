<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="/css/style.css">
    <title>Gran Concurso De Autos</title>
</head>
<body>

    <section class="showcase">
        <x-home.navbar></x-home.navbar>
        <div class="wider-container">
            @if (session('locale') === 'en')
                <div class="row mu-3">
            @else
                <div class="row">
            @endif
                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif


                <div class="col-md-7 text-white mu2">
                    <p class="lead fs-4 fw-lighter mu-8">{{__('landingText1')}}</p>
                    <h1 class="text2 py-1">
                        {{__('landingText2')}}
                    </h1>
                    <p class="w-75 fw-lighter mt-4">
                        {{__('landingText3')}}
                    </p>
                </div>
                <div class="col-md-5">
                    <div class="d-flex flex-column justify-content-center h-100 md-5">
                        @if(isset($randomUser))
                            <div class="card p-6 bg-secondary pb-1 mu-1">
                        @else
                            <div class="card p-6 bg-secondary pb-2 mu-2">
                        @endif
                            <div class="card-body text-light">
                                <div class="card-title text-center">
                                    <h2 class="fs-1 fst-italic text-uppercase fw-light">
                                        @if(isset($randomUser))
                                            {{__('landingText5')}}
                                        @else
                                            {{__('landingText4')}}
                                        @endif
                                    </h2>
                                </div>

                                @if(isset($randomUser))
                                    <div class="alert alert-info mt-2 text-center winner mt-4">
                                        <div class="display-5">
                                            {{ $randomUser->name }} {{ $randomUser->lastName }}
                                        </div>
                                    </div>
                                @else
                                    <x-form.register-form :departamentCities="$departamentCities">
                                    </x-form.register-form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
</body>
</html>
