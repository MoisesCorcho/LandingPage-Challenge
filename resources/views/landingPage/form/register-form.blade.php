<!-- register-form.blade.php -->

<form action="{{ route('landingPage.store') }}" method="POST">
    @csrf

    <div class="row mb-3">
        <x-Form.form-input label="{{__('Nombre')}}" name="name" type="text" required="true" />
        <x-Form.form-input label="{{__('Apellido')}}" name="lastName" type="text" required="true" />
    </div>

    <div class="row mb-3">
        <x-Form.form-input label="{{__('Cédula')}}" name="dni" type="number" required="true" />
        <x-Form.form-select label="{{__('Departamento')}}" name="department" :options="$departamentCities" />
    </div>

    <div class="row mb-3">
        <x-Form.form-select label="{{__('Ciudad')}}" name="city" />
        <x-Form.form-input label="{{__('Celular')}}" name="phone" type="number" required="true" />
    </div>

    <div class="mb-3">
        <x-Form.form-input label="{{__('Correo Electrónico')}}" name="email" type="email" required="true" />
    </div>

    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="habeasData" name="habeasData" required>
        <label class="form-check-label" for="habeasData">
            “{{__('habeasData')}}”
        </label>
    </div>

    <button type="submit" class="btn btn-primary rounded-pill w-100 mb-3">{{__('Registrar')}}</button>
</form>

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
        const selectedDepartment = departamentosYCiudades.find(dep => dep.departamento === selectedDepartmentId);

        console.log(selectedDepartment);

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
