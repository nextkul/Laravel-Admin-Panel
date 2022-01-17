<div class="mb-2">
    <div class="input-group">
        <input type="{{$type}}" class="form-control" placeholder="{{$placeholder}}" name="{{$name}}" value="{{old('$name', $value)}}" required>
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="{{$class}}"></span>
            </div>
        </div>
    </div>
    @if($errors->has($name))
    <span class="text-danger ml-1"><i class="far fa-hand-point-right"></i> {{ $errors->first($name) }}</span>
    @endif
</div>