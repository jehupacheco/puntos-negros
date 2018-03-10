@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col m8 offset-m2">
            <div class="card" style="margin-top: 50px">
                <div class="card-content">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-field">
                            <input id="email" type="email" name="email" value="{{ old('email') }}" class="validate" required autofocus>
                            <label
                                @if ($errors->has('email'))
                                    data-error="{{ $errors->first('email') }}"
                                @endif
                                for="email"
                            >
                                {{ __('E-Mail Address') }}
                            </label>
                        </div>

                        <div class="input-field">
                            <input id="password" type="password" name="password" required>
                            <label
                                @if ($errors->has('password'))
                                    data-error="{{ $errors->first('password') }}"
                                @endif
                                for="password"
                            >
                                {{ __('Password') }}
                            </label>
                        </div>

                        <div class="input-field" style="text-align: center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Login') }}
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
