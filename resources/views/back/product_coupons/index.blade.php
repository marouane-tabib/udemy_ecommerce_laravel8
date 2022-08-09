@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Coupons</h6>
            <div class="ml-auto">
                @ability('admin' , 'create_product_coupons')
                <a href="{{ route('admin.product_coupons.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new Coupon</span>
                </a>
                @endability
            </div>
        </div>
    </div>

    @include('back.product_coupons.filter.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Code</th>
                <th>Value</th>
                <th>Use times</th>
                <th>Validity date</th>
                <th>Greater than</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center" style="width:30px;">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($coupons as $coupon)
                <tr>
                    <td>{{ $coupon->code }}</td>
                    <td>{{ $coupon->value }} {{ $coupon->type == 'fixed' ? '$' : '%' }}</td>
                    <td>{{ $coupon->used_times . '/' . $coupon->use_times }}</td>
                    <td>{{ $coupon->start_date != '' ? $coupon->start_date->format('Y-m-d') . ' - ' . $coupon->expire_date->format('Y-m-d') : '-' }}</td>
                    <td>{{ $coupon->greater_than }}</td>
                    <td>{{ $coupon->status() }}</td>
                    <td>{{ $coupon->created_at }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.product_coupons.edit' , $coupon->id) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="if(confirm('Are You sure to delete this record?')){document.getElementById('delete-product-coupons-{{ $coupon->id }}').submit();} else {return false}"
                               class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <form action="{{ route('admin.product_coupons.destroy' , $coupon->id) }}" method="post" class="d-none" id="delete-product-coupons-{{ $coupon->id }}" >
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No coupons found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="8">
                    <div class="float-right">
                        {!! $coupons->appends(request()->all())->links(); !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
