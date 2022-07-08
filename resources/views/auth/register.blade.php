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
                            <li class="breadcrumb-item active" aria-current="page">Register</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <div class="row">
            <div class="col-6 mx-auto">
                <h2 class="h5 text-uppercase mb-4"> {{ __('Register')  }}</h2>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="first_name" class="text-small text-uppercase">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ old('first_name') }}" placeholder="Add Your Name" class="form-control form-control-lg">
                                    @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="last_name" class="text-small text-uppercase">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ old('last_name') }}" placeholder="Add Your Last Name" class="form-control form-control-lg">
                                    @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="username" class="text-small text-uppercase">Username</label>
                                    <input type="text" name="username" id="username" value="{{ old('username') }}" placeholder="Add Your Username" class="form-control form-control-lg">
                                    @error('username') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="email" class="text-small text-uppercase">Email Address</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Add Your Email Address" class="form-control form-control-lg">
                                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="mobile" class="text-small text-uppercase">Mobile Number</label>
                                    <input type="text" name="mobile" id="mobile" value="{{ old('mobile') }}" placeholder="Add Your Mobile Number" class="form-control form-control-lg">
                                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password" class="text-small text-uppercase">Password</label>
                                    <input type="password" name="password" id="password" value="{{ old('password') }}" placeholder="Add Your Password" class="form-control form-control-lg">
                                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="password_confirmation" class="text-small text-uppercase">Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Re type your Password for confirametion" class="form-control form-control-lg">
                                    @error('password_confirmation') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark">{{ __('Register') }}</button>
                                    @if (Route::has('login'))
                                        <a href="{{ route('login') }}" class="btn btn-link"> {{ __('Have an account?') }} </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
    </section>
@endsection
