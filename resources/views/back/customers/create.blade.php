@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create customer</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.customers.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Customers</span>
                </a>
            </div>
        </div>
        <br>
        <div class="container">
            <form action="{{ route('admin.customers.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}" class="form-control">
                            @error('first_name')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control">
                            @error('last_name')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="username">User Name</label>
                            <input type="text" name="username" value="{{ old('username') }}" class="form-control">
                            @error('username')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                            @error('email')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" value="{{ old('password') }}" class="form-control">
                            @error('password')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group"><label for="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status') == 1 ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status') == 0 ? 'selected' : null }}>Inactive</option>
                            </select>
                            @error('status')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3"></div>
                </div>

                <div class="row pt-4">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control">
                            @error('mobile')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="user-image">User image</label>
                        <br>
                        <div class="file-loading">
                            <input type="file" name="user_image" id="customer-image" class="file-input-overview">
                            <span class="form-text text-muted">Image width shold be 300px x 300px</span>
                            @error('user_image')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Customer</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(function(){
            $("#customer-image").fileinput({
                theme: "fas",
                maxFileCount: 1,
                allowedFileTypes: ['image'],
                showCancel: true,
                showRemove: false,
                showUpload: false,
                overwriteInitial: false
            })
        })
    </script>
@endsection