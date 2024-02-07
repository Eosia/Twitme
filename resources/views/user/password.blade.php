@extends('layouts.auth')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header"><h4>{{ __('Change my password') }}</h4></div>

                    @if(session('status') && session('status') == 'password-updated')
                        <div class="alert alert-success">Mot de passe mis à jour.</div>
                    @endif

                    <div class="card-body">
                        <form method="POST" action="{{ route('user-password.update') }}" class="needs-validation">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="current_password">Mot de passe actuel</label>
                                <input type="password" class="form-control" name="current_password">
                                <div class="text-danger">{{ $errors->updatePassword->first('current_password') }}</div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password">
                                <div class="text-danger">{{ $errors->updatePassword->first('password') }}</div>
                            </div>

                            <div class="form-group">
                                <label for="password">Password Confirmation</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    Changer
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
                <div class="mt-5 text-muted text-center">
                    <a href="{{ route('profile') }}">Retour</a>
                </div>
                <div class="simple-footer">
                    Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
                </div>
            </div>
        </div>
    </div>

@stop
