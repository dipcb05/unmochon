@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">
    <div class="card">
    <div class="card-header">
        {{ __('Profile') }}
    </div>
<div class = "card-body">
    <div>
    @if(is_null($user->profile->pic))
     @if($user->gender == 'male')
        <img class="img-thumbnail img-fluid rounded mx-auto d-block max-width: 100% height: auto" src = " {{ asset('images/default.jpg')}}" alt = "profile picture">
            @else
                <img class="img-thumbnail img-fluid rounded mx-auto d-block max-width: 100% height: auto" src = " {{ asset('images/defaultfemale.jpg')}}" alt = "profile picture">
    @endif
                @else
        <img class="img-thumbnail img-fluid rounded mx-auto d-block" src = " /storage/{{ $user->profile->pic }}" alt = "profile picture">
    @endif
    </div>


<div class="justify-content-center">
    <div><h2>{{ $user->name }}</h2></div>
<div><h5>lived in {{ $user->profile->country }}</h5></div>
</div>
<div class = "justify-content-center">
    <div><strong>{{ $count_post }}</strong> post</div>
    <div><strong>{{ $count_review }}</strong> reviews</div>
    <div><strong>{{ $count_comment }}</strong> comments </div>
</div>
<div>
    <div><h3>{{ $user->profile->job }}</h3></div>
    <div><strong>Profile Description</strong></div>
    <div><p>{{ $user->profile->description ?? 'N/A' }}</p></div>
    <div class="pr-3"><strong>website: </strong></div>
   <div>
       <a href = "{{ $user->profile->website }} ?? #">{{ $user->website }} ?? 'N/A'</a>
   </div>
</div>
    @foreach($posts as $post)
        <div class = "row justify-content-center">
        <div class="col-sm-3 pt-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('images/1.jpeg') }}" alt="image of paper">
                <div class="card-body">
                    <h5 class="card-title">{{ $post -> pcaption }}</h5>
                    <p class="card-text">short description</p>
                    <a href="/storage/{{ $post -> posts }}" class="btn btn-primary">download</a>
                    <a href=" {{ route('posts.delete', $post->id) }}" class="btn btn-outline-danger">delete</a>
                </div>
            </div>
        </div>
        </div>
    @endforeach
    </div>
</div>
</div>
</div>
@endsection

