@extends('layouts.app')
@section('content')
<div class="container">
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
                 hello {{ $user->name }}   You are logged in!
          <a href="{{ route('posts.create') }}">Create New Post</a>
        </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <p>vkmfkvm</p>


@foreach($posts as $post)
    <div class="col-sm-3 pt-4">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src=" asset{{ 'images/1.jpeg' }} " alt="image of paper">
            <div class="card-body">
                <h5 class="card-title">{{ $post -> pcaption }}</h5>
                <p class="card-text">description</p>
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">read</a>
                <a href="/storage/{{ $post -> post }}" class="btn btn-primary">download</a>
            </div>
        </div>
    </div>
@endforeach


@endsection
