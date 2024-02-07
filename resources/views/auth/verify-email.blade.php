@extends('layouts.auth')

@section('content')

<div class="container mt-5">
  <div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
      <div class="login-brand">
        <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
      </div>

      <div class="card card-primary">
        <div class="card-header"><h4>Veuillez cliquer sur le bouton.</h4></div>

        @if(session('status') && session('status') == 'verification-link-sent')
          <div class="alert alert-success">Une lien de vérification a été envoyé.</div>
        @endif

        <div class="card-body">
          <form method="POST" action="{{ route('verification.send') }}" class="needs-validation">

            @csrf

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block">
                Vérifier
              </button>
            </div>

          </form>

        </div>
      </div>
      <div class="simple-footer">
        Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
      </div>
    </div>
  </div>
</div>

@stop