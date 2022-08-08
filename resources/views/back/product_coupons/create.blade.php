@extends('layouts.admin')
@section('style')
    <link href="{{ asset('back/vendor/datepicker/themes/classic.css') }}" rel="stylesheet">
    <link href="{{ asset('back/vendor/datepicker/themes/classic.date.css') }}" rel="stylesheet">
    <link href="{{ asset('back/vendor/datepicker/themes/classic.time.css') }}" rel="stylesheet">
    <style>
        .picker__select--month, .picker__select--year{
            padding:0 !important;
        }
    </style>
@endsection
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create coupons</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.product_coupons.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Coupons</span>
                </a>
            </div>
        </div>
        <br>
        <div class="container">
            <form action="{{ route('admin.product_coupons.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" name="code" id="code" value="{{ old('code') }}" class="form-control">
                            @error('code')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" class="form-control">
                                <option value="" selected disabled>Type</option>
                                <option value="fixed" {{ old('type') == 'fixed' ? 'selected' : null }}>Fixed</option>
                                <option value="percentage" {{ old('type') == 'percentage' ? 'selected' : null }}>Percentage</option>
                            </select>
                            @error('type')<span class="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="value">Value</label>
                            <input type="text" name="value" value="{{ old('value') }}" class="form-control">
                            @error('value')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="use_times">Use times</label>
                            <input type="text" name="use_times" value="{{ old('use_times') }}" class="form-control">
                            @error('use_times')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="start_date">Start Date</label>
                            <input type="text" id="start_date" name="start_date" value="{{ old('start_date') }}" class="form-control">
                            @error('start_date')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="expire_date">Expire Date</label>
                            <input type="text" id="expire_date" name="expire_date" value="{{ old('expire_date') }}" class="form-control">
                            @error('expire_date')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-3">
                        <div class="form-group">
                            <label for="greater_than">Greater Than</label>
                            <input type="number" name="greater_than" value="{{ old('greater_than') }}" class="form-control">
                            @error('greater_than')<span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label name="status">Status</label>
                            <select name="status" class="form-control">
                                <option value="1" {{ old('status') == '1' ? 'selected' : null }}>Active</option>
                                <option value="0" {{ old('status') == '0' ? 'selected' : null }}>Inactive</option>
                                @error('status')<span class="text-danger">{{ $message }}</span> @enderror
                            </select>
                        </div>
                    </div>
                    <div class="row pt-4">
                        <div class="col-12">
                            <lavel for="desctiption">Description</lavel>
                            <textarea name="description" id="description" class="form-control" rows="3">
                                {{ old('description') }}
                            </textarea>
                            @error('cover')<span calss="text-danger">{{ $message }}</span>@enderror
                        </div>
                    </div>
                </div>

                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Coupons</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('back/vendor/datepicker/picker.js') }}"></script>
    <script src="{{ asset('back/vendor/datepicker/picker.date.js') }}"></script>
    <script>
        $(function(){
            $('#code').keydown(function(){
                this.value = this.value.toUpperCase();
            })

            $('#start_date').pickadate({
                format: 'yyyy-mm-dd',
                selectMonths : true, // Creates a dropdown to control month
                selectYears : true, // Creates a dropdown to control years
                clear : 'Clear',
                close : 'OK',
                closeOnSelect : true, // Close upon selecting a date
            })

            var startdate = $('#start_date').pickadate('picker'),
                enddate = $('#expire_date').pickadate('picker');

            $('#start_date').change(function(){
                selected_ci_date = "";
                selected_ci_date = $('#start_date').val();
                if(selected_ci_date != null){
                    var cidate = new Date(selected_ci_date);
                    min_codate = "";
                    min_codate = new Date();
                    min_codate.setDate(cidate.getDate()+1);
                    enDate.set('min' , min_codate);
                }
            });

            $('#expire_date').pickadate({
                format: 'yyyy-mm-dd',
                min : new Date(),
                selectMonths: true,
                selectYears: true,
                clear: 'Clear',
                close: 'Ok',
                closeOnSelect: true
            })
        });
    </script>
@endsection
