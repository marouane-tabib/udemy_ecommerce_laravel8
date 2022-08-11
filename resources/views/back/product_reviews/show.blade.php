@extends('layouts.admin')
@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex">
            <h6 class="m-0 font-weight-bold text-primary">Product Reviews</h6>
            <div class="ml-auto">
                @ability('admin' , 'create_product_reviews')
                <a href="{{ route('admin.product_reviews.index') }}" class="btn btn-primary">
                <span class="icon text-white-50">
                        <i class="fa fa-plus"></i>
                    </span>
                <span class="text">Review</span>
                </a>
                @endability
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table">
            <tr>
                <th>Name</th>
                <th>{{ $productReview->name }}</th>
                <th>Email</th>
                <th>{{ $productReview->email }}</th>
            </tr>
            <tr>
                <th>Customer Name</th>
                <th>{{ $productReview->user_id != '' ? $productReview->user_name : '' }}</th>
                <th>Rating</th>
                <th>{{ $productReview->rating }}</th>
            </tr>
            <tr>
                <th>Message</th>
                <th colspan="3">{{ $productReview->message }}</th>
            </tr>
            <tr>
                <th>Created date</th>
                <th colspan="3">{{ $productReview->created_at->format('Y-m-d') }}</th>
            </tr>
        </table>
    </div>
@endsection
