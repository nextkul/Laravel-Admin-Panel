@extends('admin.layouts.auth-app')
@section('title',__('Forgot Password'))
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>{{ config('settings.site.app.appname') }}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">{{ __('You forgot your password? Here you can easily retrieve a new password.') }}</p>
      <form action="{{ route('password.email') }}" method="POST">
         @csrf
          <x-input type="email" name="email" placeholder="Enter Email" class="fas fa-envelope" />
          <x-button>  {{ __('Request new password') }}  </x-button>
      </form>
      <p class="mt-3 mb-1">
        <a href="{{ route('login') }}">{{ __('Login') }}</a>
      </p>
    </div>
    <!-- /.login-card-body -->
</div>
  @endsection