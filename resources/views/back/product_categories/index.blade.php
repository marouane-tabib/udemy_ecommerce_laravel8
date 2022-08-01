@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Categories</h6>
            <div class="ml-auto">
                @ability('admin' , 'create_product_categories')
                <a href="{{ route('admin.product_categories.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new category</span>
                </a>
                @endability
            </div>
        </div>
    </div>

    @include('back.product_categories.filter.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Products Count</th>
                <th>Parent</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center" style="width:30px;">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->products_count }}</td>
                    <td>{{ $category->parent != null ? $category->parent->name : '-' }}</td>
                    <td>{{ $category->status }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.product_categories.edit' , $category->id) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="if(confirm('Are You sure to delete this record?')){document.getElementById('delete-product-category-{{ $category->id }}').submit();} else {return false}"
                               class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                            <form action="{{ route('admin.product_categories.destroy' , $category->id) }}" method="post" class="d-none" id="delete-product-category-{{ $category->id }}" >
                                @csrf
                                @method('DELETE')

                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No categories found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    <div class="float-right">
                        {!! $categories->links() !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
