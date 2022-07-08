@extends('layouts.app')

@section('content')
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Cart</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="{{ route('front.index') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Login</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="row">
            <div class="col-6 mx-auto">
                <h2 class="h5 text-uppercase mb-4"> {{ __('Login')  }}</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="username" id="" class="form-control form-control-user" value="{{ old('username') }}" placeholder="Enter Your User Name">
                        @error('username') <span class="text-danger"> {{ $message }} </span>@enderror
                    </div><br>
                    <div class="form-group">
                        <input type="password" name="password" id="" class=" form-control" value="{{ old('password') }}" placeholder="Enter Your Password">
                        @error('password') <span class="text-danger"> {{ $message }} </span>@enderror
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox small">
                            <input class="checkbox custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : 'unchecked ' }} >
                            <label for="remember" class="custom-control-label" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}</label>
                        </div>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                    <hr>
                </form>
                <div class="text-center">
                    <a class="small" href="{{ route('back.forgot_password') }}">Forgot Password</a>
                </div>
            </div>
        </div>
    </section>
@endsection
