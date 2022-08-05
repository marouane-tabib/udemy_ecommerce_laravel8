@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Tags</h6>
            <div class="ml-auto">
                <a href="{{ route('admin.tags.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new tag</span>
                </a>
            </div>
        </div>
    </div>

    @include('back.tags.filter.filter')

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Name</th>
                <th>Tags Count</th>
                <th>Status</th>
                <th>Created at</th>
                <th class="text-center" style="width:30px;">Actions</th>
            </tr>
            </thead>
            <tbody>

            @forelse($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>{{ $tag->products->count() }}</td>
                    <td>{{ $tag->status() }}</td>
                    <td>{{ $tag->created_at }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.tags.edit' , $tag->id) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="if(confirm('Are You sure to delete this record?')){document.getElementById('delete-tags-{{ $tag->id }}').submit();} else {return false}"
                               class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <form action="{{ route('admin.tags.destroy' , $tag->id) }}" method="post" class="d-none" id="delete-tags-{{ $tag->id }}" >
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No tags found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    <div class="float-right">
                        {!! $tags->appends(request()->all())->links() !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
