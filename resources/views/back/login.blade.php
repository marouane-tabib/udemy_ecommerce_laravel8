@extends('layouts.admin-auth')
@section('style')
    <style>
        .bg-login-image{
            background: url("https://aws1.discourse-cdn.com/elastic/original/3X/9/0/90df22ab443662d632838fd82f6ea38b2cba025a.png");
        }
    </style>
@endsection
@section('content')
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="username" id="" class="form-control form-control-user" value="{{ old('username') }}" placeholder="Enter Your User Name">
                                        @error('username') <span class="text-danger"> {{ $message }} </span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" id="" class="form-control-user form-control" value="{{ old('password') }}" placeholder="Enter Your Password">
                                        @error('password') <span class="text-danger"> {{ $message }} </span>@enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input class="checkbox custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : 'unchecked ' }} >
                                            <label for="remember" class="custom-control-label" {{ old('remember') ? 'checked' : '' }}>{{ __('Remember Me') }}</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('admin.forgot_password') }}">Forgot Password?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
