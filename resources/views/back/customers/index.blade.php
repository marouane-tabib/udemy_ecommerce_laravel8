@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Customers</h6>
            <div class="ml-auto">
                @ability('admin' , 'create_customers')
                <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new customer</span>
                </a>
                @endability
            </div>
        </div>
    </div>

    @include('back.customers.filter.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email & Mobile</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center" style="width:30px;">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($customers as $customer)
                <tr>
                    <td>
                        @if($customer->user != '')
                            <img src="{{ asset('assets/users/'.$customer->user_image) }}" alt="{{ $customer->full_name }}" width="60" height="60">
                            @else
                            <img src="{{ asset('assets/users/avatar.svg') }}" alt="{{ $customer->full_name }}" width="40" height="40">
                        @endif
                    </td>
                    <td>
                        {{ $customer->full_name }}<br>
                        <strong>{{ $customer->username }}</strong>
                    </td>
                    <td>
                        {{ $customer->email }}<br>
                        {{ $customer->mobile }}
                    </td>
                    <td>{{ $customer->status() }}</td>
                    <td>{{ $customer->created_at->format('Y-m-d') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.customers.edit' , $customer->id) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="if(confirm('Are You sure to delete this record?')){document.getElementById('delete-customer-{{ $customer->id }}').submit();} else {return false}"
                               class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <form action="{{ route('admin.customers.destroy' , $customer->id) }}" method="post" class="d-none" id="delete-customer-{{ $customer->id }}" >
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No customers found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    <div class="float-right">
                        {!! $customers->appends(request()->all())->links(); !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
