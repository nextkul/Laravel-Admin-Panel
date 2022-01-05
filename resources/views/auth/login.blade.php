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
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
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
        <div class="social-auth-links text-center mt-2 mb-3">
        <button class="btn btn-block btn-primary">
        <i class="fas fa-sign-in-alt mr-2"></i>  {{ __('Log in') }}
       </button>
      </div>
      </form>
      <p class="mb-1">
      @if (Route::has('password.request'))
        <a href="{{ route('admin.get.forgetPassword') }}">{{ __('Forgot your password?') }}</a>
      @endif
      </p>
      <p class="mb-0">
        <a href="{{ route('admin.get.register') }}" class="text-center">{{ __('Register a new membership') }}</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
  @endsection