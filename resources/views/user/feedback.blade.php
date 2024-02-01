@extends('user.layouts.app')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">My Feedbacks</h4>
                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Votes</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feedbacks as $item)
                                                <tr>
                                                    <td>{{ $item->title }}</td>
                                                    <td>{{ $item->category }}</td>
                                                    <td data-toggle="tooltip" data-placement="top"
                                                        title="{{ $item->description }}">
                                                        {{ \Illuminate\Support\Str::limit($item->description, 50, '...') }}
                                                    </td>
                                                    <td>{{ $item->votes->count() ? $item->votes->count() : 0 }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('toastr')
    @include('user.layouts.toastr')
@endsection

@endsection
