@extends('layouts.auth-app')
@section('title',__('Register'))
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>{{ config('settings.site.app.appname') }}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">{{ __('Register a new membership') }}</p>
     <!-- form-box -->
      <form action="{{ route('register') }}" method="post">
        @csrf
        <x-input type="text" name="name" placeholder="Enter Full name" class="fas fa-user" />
        <x-input type="email" name="email" placeholder="Enter Email" class="fas fa-envelope" />
        <x-input type="password" name="password" placeholder="Enter password" class="fas fa-lock" />
        <x-input type="password" name="password_confirmation" placeholder="Retype password" class="fas fa-lock" />
        <x-button> {{ __('Register') }} </x-button>
     </form>
      <a href="{{ route('login') }}" class="text-center">{{ __('Already registered?') }}</a>
  </div>
    <!-- /.form-box -->
</div><!-- /.card -->
@endsection