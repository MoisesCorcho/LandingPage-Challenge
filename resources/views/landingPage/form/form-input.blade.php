<!-- form-input.blade.php -->

<div class="col">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input
        class="form-control rounded-pill rounded-0"
        type="{{ $type }}"
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
    >
    @error($name)
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

