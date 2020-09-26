@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class = "d-flex justify-content-between">
                 hello {{ Auth::user()->name }}   You are logged in!
          <a href="{{ route('posts.create') }}">Create New Post</a>
                   </div>
                        @if((is_null($posts)))
                            <div class = "text-center">
                                <h3><br>No New Posts</h3>
                            </div>
                        @else
                            <div class = "text-center">
                                <h3><br>New Posts</h3>
                            </div>
                        @foreach($posts as $post)
                            <div><br><br></div>
                            <div class="row justify-content-center">
                                <div class="col-md-8">
                                    <div class="card" style="width: 30rem;">
                                        <div class="card-header">
                                           published on {{ $post -> journal }}
                                        </div>
                                        <img src="{{ asset('images/logo & icon/Ex n b.png') }}" class="card-img-top" alt="site_logo"
                                        height="40px" width="30px">
                                        <div class="card-body">
                                            <h5 class="card-title">title: {{ $post -> pcaption }}</h5>
                                        </div>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">Authors: {{ $post -> author }}</li>
                                            <li class="list-group-item">Topic: {{ $post -> subject }}</li>
                                            <li class="list-group-item">Uploaded at: {{ $post -> created_at }}</li>
                                            <li class="list-group-item">Uploader:   <a href="{{ route('profile.show', $post->users_id) }}">{{ $post->name }}</a></li>
                                        </ul>
                                        <div class="card-body">
                                            <a href="{{ $post -> posts }}" class="card-link">Paper link</a>
                                            <a href="{{ route('posts.reviews', $post->id) }}"
                                               class="btn btn-outline-success">reviews section</a>
                                            <a href="#"
                                               class="btn btn-outline-dark">rate it</a>
                                            <a href="#"
                                               class="btn btn-outline-success">discussion section</a>
                                        </div>
                                        <div class = "card-footer">
                                            published in {{ $post -> time }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @endif
                </div>
                        </div>
                    </div>
            </div>
        </div>
</div>
@endsection
