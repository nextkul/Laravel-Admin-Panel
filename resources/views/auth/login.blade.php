@extends('admin.layouts.auth-app')
@section('title',__('Login'))
@section('content')
 <!-- /.login-logo -->
 <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>{{ config('settings.site.app.appname') }}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg"> {{ __('Sign in to start your session') }}</p>

      <form action="{{ route('login') }}" method="POST">
        @csrf
        <x-input type="email" name="email" placeholder="Enter Email" class="fas fa-user" />
        <x-input type="password" name="password" placeholder="Enter Password" class="fas fa-lock" />

          <div class="row">
            <div class="col-12">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                {{ __('Remember Me') }}
                </label>
              </div>
            </div>
          </div>
          
          <x-button> {{ __('Log in') }} </x-button>
      </form>
      <p class="mb-1">
      @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
      @endif
      </p>
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">{{ __('Register a new membership') }}</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  @endsection