@extends('layouts.auth')

@section('content')

<div class="container mt-5">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
      <div class="login-brand">
        <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
      </div>

      <div class="card card-primary">
        <div class="card-header"><h4>Connexion</h4></div>

        @if(session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card-body">
          <form method="POST" action="{{ route('login') }}" class="needs-validation">

            @csrf

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
              <div class="float-right">
                <a href="{{ route('password.request') }}" class="text-small">
                  Mot de passe oublié?
                </a>
              </div>
              @error('password')
                <div class="text-danger">{{ $message }}</div>
              @enderror 
            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember" value="1" {{ old('remember') == 1 ? 'checked' : '' }} class="custom-control-input" id="remember-me">
                <label class="custom-control-label" for="remember-me">Se souvenir de moi</label>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block">
                Login
              </button>
            </div>

          </form>

        </div>
      </div>
      <div class="mt-5 text-muted text-center">
        <a href="{{ route('register') }}">Ouvrir un compte</a>
      </div>
      <div class="simple-footer">
        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
      </div>
    </div>
  </div>
</div>

@stop