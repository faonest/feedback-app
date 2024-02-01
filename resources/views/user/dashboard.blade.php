@extends('user.layouts.app')
@section('content')
    <div class="main-content">
        <div class="main-content-inner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card_title">Submit Feedback</h4>

                                <form action="{{ route('storeFeedback') }}" method="POST" class="needs-validation"
                                    novalidate="">
                                    @csrf

                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" class="form-control" id="title"
                                                placeholder="Title" required="" />
                                            <div class="invalid-feedback">
                                                Please provide a title.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group">
                                                <label class="col-form-label">Select Category</label>
                                                <select name="category" class="form-control">
                                                    <option>Select Category</option>
                                                    <option value="Bug Report">Bug Report</option>
                                                    <option value="Feature Request">Feature Request</option>
                                                    <option value="Improvement">Improvement</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-3">
                                            <label for="description">Description</label>
                                            <textarea type="text" name="description" class="form-control" id="description" placeholder="Description"
                                                required="" cols="30" rows="5"></textarea>
                                            <div class="invalid-feedback">
                                                Please provide a Description.
                                            </div>
                                        </div>
                                    </div>

                                    <button class="btn btn-primary" type="submit">
                                        Submit
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('toastr')
    @include('user.layouts.toastr')
@endsection
