@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Create customer addresse</h6>
            <div class="ml-auto">
                <a href="{{route('admin.customer_address.index') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-home"></i>
                    </span>
                    <span class="text">Customer Addresse</span>
                </a>
            </div>
        </div>
        <br>
        <div class="container">
            <form action="{{route('admin.customer_address.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="user_id">Customer</label>
                            <input type="text" name="customer_name" id="customer_name" class="form-control typeahead" value="{{ old('user_id' , request()->input('user_id')) }}" placeholder="Start search customer...">
                            <input type="text" name="user_id" id="user_id" class="form-control" value="{{ old('user_id' , request()->input('user_id')) }}">
                            @error('user_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="address_title">Address title</label>
                            <input type="text" name="address_title" value="{{ old('address_title') }}" class="form-control" id="address_title">
                            @error('address_title')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="default_address">Default address</label>
                            <input type="text" name="default_address" value="{{ old('default_address') }}" class="form-control" id="default_address">
                            @error('default_address')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="fitst_name">First name</label>
                            <input type="text" name="fitst_name" value="{{ old('fitst_name') }}" class="form-control" id="fitst_name">
                            @error('fitst_name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="last_name">Last name</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" id="last_name">
                            @error('last_name')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control" id="email">
                            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="mobile">Mobile</label>
                            <input type="text" name="mobile" value="{{ old('mobile') }}" class="form-control" id="mobile">
                            @error('mobile')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <label for="country_id">Country</label>
                            <select name="country_id" id="country_id" class="form-control">
                                    <option value="">---</option>
                                @foreach ($countries as $country)
                                    <option value="{{ $country->name }}" {{ old('country_id') == $country_id ? 'selected' : null }} class="form-control">{{ $country->name }}</option>
                                @endforeach
                            </select>
                            @error('country_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="state_id">State</label>
                            <select name="state_id" id="state_id" class="form-control">

                            </select>
                            @error('state_id')<div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-group">
                            <label for="city_id">City</label>
                            <select name="city_id" id="city_id" class="form-control">

                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group pt-4">
                    <button type="submit" name="submit" class="btn btn-primary">Add Customer Addresse</button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('back\vendor\bootstrap3-typeahead.min.js') }}"></script>
    <script>
        $(function(){
            $(".typeahead").typeahead({
                autoSelect: true,
                minLength: 3, 
                delay: 400,
                displayText : function(item) { return item.full_name + ' - ' + item.email },
                source: function(query , process){
                    return $.get("{{ route('admin.customers.get_customers') }}" , { 'query' : query} , function (data){
                        return process(data);
                    });
                },
                afterSelect : function(data){
                    $('#user_id').val(data.id);
                    console.log(data);
                }
            });

            populateStates();
            pomulateCities();
            
            $("#country_id").change(function(){
                populateStates();
                pomulateCities();
                return false;
            });

            $("#state_id").change(function(){
                populateCities();
                return false;
            });

            function populateStates(){
                let countryIdVal = $('#country_id').val() != null ? $('#country_id').val() : "{{ old('country_id') }}";
                $.get("{{ route('admin.states.get_states') }}" , {country_id : countryIdVal} , function(data){
                    $('option' , $("#state_id")).remove();
                    $('#state_id').append($('<option></option>').val('').html('---'));
                    $.each(data , function(val , text){
                        let selectedVal = text.id == "{{ old('state_id') }}" ? "selected" : "";
                        $('#state_id').append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                } , "json");
            }

            function populateStates(){
                let stateIdVal = $('#state_id').val() != null ? $('#state_id').val() : "{{ old('state_id') }}";
                $.get("{{ route('admin.states.get_states') }}" , {country_id : countryIdVal} , function(data){
                    $('option' , $("#city_id")).remove();
                    $('#city_id').append($('<option></option>').val('').html('---'));
                    $.each(data , function(val , text){
                        let selectedVal = text.id == "{{ old('city_id') }}" ? "selected" : "";
                        $('#city_id').append($('<option ' + selectedVal + '></option>').val(text.id).html(text.name));
                    });
                } , "json");
                
            }
        });
    </script>
@endsection
