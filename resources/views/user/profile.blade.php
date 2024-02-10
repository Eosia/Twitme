@extends('layouts.auth')

@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/stisla-fill.svg') }}" alt="logo" width="100" class="shadow-light rounded-circle">
                </div>

                <div class="card card-primary">
                    <div class="card-header">
                        <h4>
                            {{ __('profile.profile_title', ['name' => auth()->user()->name]) }}
                        </h4>
                    </div>

                    <p class="m-4">
                        {{ __('profile.registred') }} {{ $user->created_at->isoFormat('LLLL') }}.
                    </p>

                    @if(session('status') && session('status') == 'profile-information-updated')
                        <div class="alert alert-success">Profil mis à jour.</div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif



                    <div class="card-body">
                        <form method="POST" action="{{ route('user-profile-information.update') }}" enctype="multipart/form-data" class="needs-validation">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">

                                <div class="text-danger">{{ $errors->updateProfileInformation->first('name') }}</div>
                            </div>

                            <div class="form-group">
                                <label for="nickname">Nickname</label>
                                <input type="text" class="form-control" name="nickname" value="{{ old('nickname', auth()->user()->nickname) }}">

                                <div class="text-danger">{{ $errors->updateProfileInformation->first('nickname') }}</div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', auth()->user()->email) }}">

                                <div class="text-danger">{{ $errors->updateProfileInformation->first('email') }}</div>
                            </div>


                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                                <input type="file" class="form-control" name="avatar">

                                <div class="text-danger">{{ $errors->updateProfileInformation->first('avatar') }}</div>
                            </div>

                            @if($user->avatar)
                                <div class="mb-4">
                                    <a href="{{ $user->avatar->url }}">
                                        <img src="{{ $user->avatar->thumb_url }}" width="150" height="150" alt="">
                                    </a>
                                </div>
                            @endif


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {!! __('button.update') !!}
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

                <div class="mt-5 text-muted text-center">
                    <a href="{{ route('password') }}">{{ __('Change my password') }}</a>
                </div>

                <div class="simple-footer">
                    Copyright &copy; {{ config('app.name') }} {{ date('Y') }}
                </div>

                <div class="mt4">
                    <form action="{{ route('user.destroy') }}" method="post" class="form-delete">
                        @csrf
                        @method('DELETE')

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-lg btn-block">
                                {!! __('button.delete') !!}

                            </button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>

@stop
