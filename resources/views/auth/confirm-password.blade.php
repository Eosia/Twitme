@extends('layouts.auth')

@section('content')

<div class="container mt-5">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
      <div class="login-brand">
        <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
      </div>

      <div class="card card-primary">
        <div class="card-header"><h4>Confirme ton mot de passe pour accéder</h4></div>

        @if(session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <div class="card-body">
          <form method="POST" action="{{ route('password.confirm') }}" class="needs-validation">

            @csrf

            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password">
              @error('password')
                <div class="text-danger">{{ $message }}</div>
              @enderror 
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block">
                Confirme ton mot de passe
              </button>
            </div>

          </form>

        </div>
      </div>
      <div class="mt-5 text-muted text-center">
        Je m'en souviens <a href="{{ route('login') }}">Connexion</a>
      </div>
      <div class="simple-footer">
        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
      </div>
    </div>
  </div>
</div>

@stop