<!-- form-select.blade.php -->

<div class="col">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-select rounded-pill rounded-0" id="{{ $name }}" name="{{ $name }}">
        <option value="">{{__('Selecciona')}}...</option>

        @foreach($options as $value => $option)
            <option value="{{ $option['departamento'] }}">{{ $option['departamento'] }}</option>
        @endforeach

    </select>
</div>

