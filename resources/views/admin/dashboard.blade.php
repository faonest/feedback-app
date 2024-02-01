@extends('admin.layouts.app')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-12 mt-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">User Feedbacks</h4>
                                <div class="table-responsive datatable-primary">
                                    <table id="dataTable2" class="text-center">
                                        <thead class="text-capitalize">
                                            <tr>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Description</th>
                                                <th>Votes</th>
                                                <th>Comments</th>
                                                <th>Actions</th>
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
                                                    <td>
                                                        <select class="enable-disable-comments"
                                                            data-feedback-id="{{ $item->id }}">
                                                            <option value="1"
                                                                {{ $item->comment === 1 ? 'selected' : '' }}>
                                                                Enabled
                                                            </option>
                                                            <option value="0"
                                                                {{ $item->comment === 0 ? 'selected' : '' }}>
                                                                Disabled
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('deleteFeedback', $item->id) }}"><i
                                                                class="fa fa-trash"></i></a>
                                                    </td>
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
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('.enable-disable-comments').change(function() {
                var status = $(this).val();
                var feedbackId = $(this).data('feedback-id');

                $.ajax({
                    type: "POST",
                    url: "{{ route('updateCommentStatus') }}",
                    data: {
                        feedbackId: feedbackId,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        toastr.success(response.success);
                    },
                    error: function(xhr, status, error) {
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            toastr.error(xhr.responseJSON.error);
                        } else {
                            toastr.error("An error occurred while updating comment status");
                        }
                    }
                });
            });
        });
    </script>
@endsection

@section('toastr')
    @include('admin.layouts.toastr')
@endsection
