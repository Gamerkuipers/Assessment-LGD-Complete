<label for="{{ $inputId }}">{{ $inputText }} @error($inputId) <span class="text-danger">{{ $message }}</span> @enderror</label>
<div class="input-group mb-3">
    <input type="{{$type ??'text'}}"
           class="form-control @error($inputId) is-invalid bg-danger bg-opacity-10 text-white @enderror"
           id="{{ $inputId }}"
           name="{{ $inputId }}"
           placeholder="{{ $placeholder ?? '' }}"
           value="{{ old($inputId) }}">
</div>
