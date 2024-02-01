<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Feedbacks</title>

    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" />
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <link rel="stylesheet" href="{{ asset('assets/assets/vendors/toastr/css/toastr.min.css') }}">

    <style>
        body {
            background-color: #eee;

        }

        .bdge {
            height: 21px;
            background-color: orange;
            color: #fff;
            font-size: 11px;
            padding: 8px;
            border-radius: 4px;
            line-height: 3px;
        }

        .comments {
            text-decoration: underline;
            text-underline-position: under;
            cursor: pointer;
        }

        .dot {
            height: 7px;
            width: 7px;
            margin-top: 3px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
        }

        .hit-voting:hover {
            color: blue;
        }

        .hit-voting {
            cursor: pointer;
        }
    </style>

    {{-- comments section --}}
    <style>
        .dot {
            background-color: #333;
        }

        .commented-section {
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 0 auto;
        }

        .commented-user h5 {
            font-size: 1.2em;
            font-weight: bold;
        }

        .comment-text-sm {
            font-size: 0.9em;
        }
    </style>

</head>

<body class="antialiased">

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="background: #02007C !important">
        <a class="navbar-brand" style="color: white" href="{{ url('/') }}">FEEDBACK</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ route('user.dashboard') }}"
                            class="btn btn-outline-success my-2my-sm-0 bg-white">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-success my-2 my-sm-0 bg-white">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="btn btn-outline-success my-2 my-sm-0 bg-white">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </nav>

    @foreach ($feedbacks as $item)
        <div class="container mt-5 mb-5">
            <div class="d-flex justify-content-center row">
                <div class="d-flex flex-column col-md-8">
                    <div
                        class="d-flex flex-row align-items-center text-left comment-top p-2 bg-white border-bottom px-4">
                        <div class="d-flex flex-column-reverse flex-grow-0 align-items-center votings ml-1">
                            <i class="fa fa-sort-up fa-2x hit-voting voteCount"
                                style="{{ Auth::check() ? ($item->user_id === Auth::id() ? 'pointer-events: none;' : '') : 'pointer-events: none;' }}"
                                data-feedback-id="{{ $item->id }}"></i>

                            <span class="vote-count-display">{{ $item->votes->count() }}</span>
                        </div>
                        <div class="d-flex flex-column ml-3">
                            <div class="d-flex flex-row post-title">
                                <h5>{{ $item->user->name }}</h5><span class="ml-2">({{ $item->title }})</span>
                            </div>

                            <div class="comment-text-sm mb-2"><span>{{ $item->description }}</span></div>

                            <div class="d-flex flex-row align-items-center align-content-center post-title">
                                <span class="mr-2 comments">{{ $item->comments->count() }} comments&nbsp;</span>
                                <span class="mr-2 dot"></span><span>{{ $item->created_at }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="coment-bottom bg-white p-2 px-4">
                        @if ($item->comment === 1)
                            @if (Auth::check())
                                <div class="d-flex flex-row add-comment-section mt-4 mb-4">
                                    <input type="text" class="form-control mr-3 mainCommentTextarea"
                                        placeholder="Add comment">
                                    <button class="btn btn-primary mainCommentSubmit" type="button"
                                        data-feedback-id="{{ $item->id }}">Comment</button>
                                </div>
                            @else
                                <div class="alert alert-info">
                                    Please login for comments and vote
                                </div>
                            @endif
                        @else
                            <div class="alert alert-info">
                                Comments are disabled for this feedback.
                            </div>
                        @endif

                        <div class="comments-section" id="commentsSection_{{ $item->id }}">
                            @foreach ($item->comments as $val)
                                <div class="commented-section mt-2 rounded-sm bg-light p-3">
                                    <div class="d-flex flex-row commented-user add-comment-section">
                                        <h5>{{ $val->user->name }}</h5>
                                        <span class="text-muted ml-auto">{{ $val->created_at }}</span>
                                    </div>

                                    <div class="comment-text-sm mt-2">
                                        <span>{{ $val->content }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @if ($feedbacks->count() === 0)
        <div class="container mt-5 mb-5">
            <div class="alert alert-info text-center">
                Currently, there is no feedback available
            </div>
        </div>
    @endif

    <script>
        $(document).ready(function() {
            $('.mainCommentSubmit').on('click', function() {
                var feedbackId = $(this).data('feedback-id');
                var content = $(this).prev('.mainCommentTextarea').val();
                var commentsSection = $(this).closest('.add-comment-section').next('.commentsSection');

                $.ajax({
                    type: 'POST',
                    url: "{{ route('createComment') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'feedback_id': feedbackId,
                        'content': content
                    },
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.error);
                        } else {
                            toastr.success(response.success);

                            var newComment = `
            <div class="commented-section mt-2 rounded-sm bg-light p-3">
                <div class="d-flex flex-row commented-user add-comment-section">
                    <h5>${response.user}</h5>
                    <span class="text-muted ml-auto">${response.created_at}</span>
                </div>
                <div class="comment-text-sm mt-2">
                    <span>${response.content}</span>
                </div>
            </div>
        `
                            $('#commentsSection_' + feedbackId).append(newComment);
                        }
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

        $(document).ready(function() {
            $('.voteCount').on('click', function() {
                var feedbackId = $(this).data('feedback-id');
                var voteCountSpan = $(this).closest('.d-flex').find('.vote-count-display');

                $.ajax({
                    type: 'GET',
                    url: "{{ url('createVote') }}" + '/' + feedbackId,
                    data: {
                        '_token': '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.error) {
                            toastr.error(response.error);
                        } else {
                            toastr.success(response.success);
                            voteCountSpan.text(response.vote_count);
                        }
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

    @include('admin.layouts.toastr')

    <script src="{{ asset('assets/assets/vendors/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/assets/js/init/toastr.js') }}"></script>
</body>

</html>
