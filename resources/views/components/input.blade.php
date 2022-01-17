<div class="mb-3">
    <label for="{{$name}}" class="form-label">{{$inputTitle}}</label>
    <input type="{{$type}}"
           id="{{$name}}"
           form="{{$form}}"
           @isset($value)
                value="{{old($name,$value)}}"
           @else
               value="{{old($name)}}"
           @endisset
           name="{{$name}}"
           class="form-control @error($name) is-invalid @enderror">
    @error($name)
    <p class="text-danger small">{{$message}}</p>
    @enderror
</div>
