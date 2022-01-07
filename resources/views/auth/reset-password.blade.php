@extends('admin.layouts.auth-app')
@section('title',__('Reset Password'))
@section('content')
<div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>{{ config('settings.site.app.appname') }}</b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">{{ __('You are only one step a way from your new password, recover your password now.') }}</p>
      <form method="POST" action="{{ route('password.update') }}">
        @csrf
         <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
        <x-input type="email" name="email" placeholder="Enter Email" class="fas fa-user" />
        <x-input type="password" name="password" placeholder="Enter Password" class="fas fa-lock" />
        <x-input type="password" name="password_confirmation" placeholder="Confirm Password" class="fas fa-lock" />
        <x-button> {{ __('Change password') }} </x-button>
      </form>
      <p class="mt-3 mb-1">
        <a href="{{ route('admin.get.login') }}">Login</a>
      </p>
    </div>
    <!-- /.login-card-body -->
</div>
  @endsection