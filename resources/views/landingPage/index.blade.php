<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Bootstrap CSS --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >

    <title>{{__('Concurso de Automoviles')}}</title>
</head>
<body class="text-bg-dark">

    <div class="container mt-5">

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif

        @if(isset($randomUser))
            <div class="alert alert-info">
                Usuario Ganador!!
                {{ $randomUser->name }} {{ $randomUser->lastName }}
            </div>
        @endif

        <h2 class="text-center mb-4">{{__('Formulario de Registro')}}</h2>
        <form action="{{ route('landingPage.store') }}" method="POST">
          @csrf

          <div class="row mb-3">
            <div class="col">
              <label for="name" class="form-label">{{__('Nombre')}}</label>
              <input type="text" class="form-control" id="name" name="name" required>

              @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col">
              <label for="lastName" class="form-label">{{__('Apellido')}}</label>
              <input type="text" class="form-control" id="lastName" name="lastName" required>

              @error('lastName')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="dni" class="form-label">{{__('Cédula')}}</label>
              <input type="number" class="form-control" id="dni" name="dni" required>
              @error('dni')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="col">
              <label for="department" class="form-label">{{__('Departamento')}}</label>
              <select class="form-select" id="department" name="department">
                <option value="">{{__('Selecciona')}}...</option>

                    @foreach ($departamentCities as $option)
                        <option value="{{$option['id']}}">{{$option['departamento']}}</option>
                    @endforeach

              </select>
            </div>
          </div>

          <div class="row mb-3">
            <div class="col">
              <label for="city" class="form-label">{{__('Ciudad')}}</label>
              <select class="form-select" id="city" name="city">
                <option value="">{{__('Selecciona')}}...</option>
              </select>
            </div>
            <div class="col">
              <label for="phone" class="form-label">{{__('Celular')}}</label>
              <input type="number" class="form-control" id="phone" name="phone" required>
              @error('phone')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">{{__('Correo Electrónico')}}</label>
            <input type="email" class="form-control" id="email" name="email" required>
          </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

          <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="habeasData" name="habeasData" required>
            <label class="form-check-label" for="habeasData">
              “{{__('habeasData')}}”
            </label>
          </div>
          <button type="submit" class="btn btn-primary">{{__('Registrar')}}</button>
        </form>
      </div>

    {{-- Bootstrap JS --}}
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>

    <script>
        // Obtener referencias a los select
        const departmentSelect = document.getElementById('department');
        const citySelect = document.getElementById('city');

        // Datos de ciudades según departamento
        const departamentosYCiudades = {!! json_encode($departamentCities) !!};

        // Función para actualizar las opciones del select de ciudades
        function updateCityOptions() {
            // Obtener el valor seleccionado del select de departamentos
            const selectedDepartmentId = departmentSelect.value;

            // Buscar el departamento seleccionado en los datos
            const selectedDepartment = departamentosYCiudades.find(dep => dep.id === parseInt(selectedDepartmentId));

            // Limpiar las opciones actuales del select de ciudades
            citySelect.innerHTML = '<option value="">{{__('Selecciona')}}...</option>';

            // Si se encontró el departamento seleccionado
            if (selectedDepartment) {
                // Iterar sobre las ciudades del departamento y agregarlas como opciones al select de ciudades
                selectedDepartment.ciudades.forEach(ciudad => {
                    const option = document.createElement('option');
                    option.value = ciudad;
                    option.textContent = ciudad;
                    citySelect.appendChild(option);
                });
            }
        }

        // Agregar un event listener al select de departamentos para actualizar las ciudades cuando cambie la selección
        departmentSelect.addEventListener('change', updateCityOptions);

        // Llamar a la función una vez al principio para asegurar que las ciudades se carguen correctamente
        updateCityOptions();
    </script>

</body>
</html>
