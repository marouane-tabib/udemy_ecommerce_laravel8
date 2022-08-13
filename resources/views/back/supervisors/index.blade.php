@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Supervisor</h6>
            <div class="ml-auto">
                @ability('admin' , 'create_supervisors')
                <a href="{{ route('admin.supervisors.create') }}" class="btn btn-primary">
                    <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                    <span class="text">Add new supervisor</span>
                </a>
                @endability
            </div>
        </div>
    </div>

    @include('back.supervisors.filter.filter')

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

            @forelse($supervisors as $supervisor)
                <tr>
                    <td>
                        @if($supervisor->user_image)
                            <img src="{{ asset('assets/users/'.$supervisor->user_image) }}" alt="{{ $supervisor->full_name }}" width="60" height="60">
                            @else
                            <img src="{{ asset('assets/users/avatar.svg') }}" alt="{{ $supervisor->full_name }}" width="40" height="40">
                        @endif
                    </td>
                    <td>
                        {{ $supervisor->full_name }}<br>
                        <strong>{{ $supervisor->username }}</strong>
                    </td>
                    <td>
                        {{ $supervisor->email }}<br>
                        {{ $supervisor->mobile }}
                    </td>
                    <td>{{ $supervisor->status() }}</td>
                    <td>{{ $supervisor->created_at->format('Y-m-d') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="{{ route('admin.supervisors.edit' , $supervisor->id) }}" class="btn btn-primary">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="javascript:void(0)"
                               onclick="if(confirm('Are You sure to delete this record?')){document.getElementById('delete-supervisor-{{ $supervisor->id }}').submit();} else {return false}"
                               class="btn btn-danger">
                                <i class="fa fa-trash"></i>
                            </a>
                        </div>
                        <form action="{{ route('admin.supervisors.destroy' , $supervisor->id) }}" method="post" class="d-none" id="delete-supervisor-{{ $supervisor->id }}" >
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No supervisors found</td>
                </tr>
            @endforelse
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6">
                    <div class="float-right">
                        {!! $supervisors->appends(request()->all())->links(); !!}
                    </div>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection
