<div class="row">
    <div class="col-12">
        <button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-primary btn-block']) }}>{{ $slot }}</button>
    </div>
</div>