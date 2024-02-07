@extends('layouts.auth')

@section('content')

<div class="container mt-5">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
      <div class="login-brand">
        <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
      </div>

      <div class="card card-primary">
        <div class="card-header"><h4>Réinitialiser mon mot de passe</h4></div>

        @if(session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card-body">
          <form method="POST" action="{{ route('password.update') }}" class="needs-validation">

            @csrf

            <input type="hidden" name="token" value="{{ request()->route('token') }}">

            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" name="email" value="{{ old('email') }}">
              @error('email')
                <div class="text-danger">{{ $message }}</div>
              @enderror 
            </div>

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password">
              @error('password')
                <div class="text-danger">{{ $message }}</div>
              @enderror 
            </div>

            <div class="form-group">
              <label for="password_confirmation">Password Confirmation</label>
              <input type="password" class="form-control" name="password_confirmation">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block">
                Reset
              </button>
            </div>

          </form>

        </div>
      </div>
      <div class="mt-5 text-muted text-center">
        Je m'en souviens en fait! <a href="{{ route('login') }}">Connexion</a>
      </div>
      <div class="simple-footer">
        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
      </div>
    </div>
  </div>
</div>

@stop