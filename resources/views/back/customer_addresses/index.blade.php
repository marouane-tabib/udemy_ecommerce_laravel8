@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Customer Addresses</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.customer_address.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new customer_address</span>
                </a>
            </div>
        </div>
    </div>

    @include('back.customer_addresses.filter.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Customer</th>
                <th>Title</th>
                <th>Shipping Info</th>
                <th>Locations</th>
                <th>Address</th>
                <th>Zip code</th>
                <th>PoBox</th>
                <th class="text-center" style="width:30px;">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($customer_addresses as $customer_address)
                <tr>
                    <td>
                        <a href="{{ route('admin.customer_address.show' , $customer_addresses->user_id) }}">{{ $customer_addresses->user->full_name }}</a>
                    </td>
                    <td>
                        <a href="{{ route('admin.customer_address.show' , $customer_addresses->id) }}">{{ $customer_addresses->address_title }}</a>
                        <p class="text-gray-400"><b>{{ $customer_addresses->defaultAddress() }}</b></p>
                    </td>
                    <td>
                        {{ $customer_addresses->first_name . ' ' . $customer_addresses->last_name }}
                        <p class="text-gray-400">{{ $customer_addresses->email }}</br>{{ $customer_addresses->mobile }}</p>
                    </td>
                    <td>{{ $customer_address->country_name . ' - ' . $customer_address->state->name . ' - ' . $customer_addresses->city->name }}</td>
                    <td>{{ $customer_address->address }}</td>
                    <td>{{ $customer_address->zip_code }}</td>
                    <td>{{ $customer_address->po_box }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.customer_address.edit' , $customer_address->id) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="if(confirm('Are You sure to delete this record?')){document.getElementById('delete-customer_addresses-{{ $customer_address->id }}').submit();} else {return false}"
                               class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <form action="{{ route('admin.customer_address.destroy' , $customer_address->id) }}" method="post" class="d-none" id="delete-customer_addresses-{{ $customer_address->id }}" >
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No customer addresses found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="8">
                    <div class="float-right">
                        {!! $customer_addresses->appends(request()->all())->links() !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
