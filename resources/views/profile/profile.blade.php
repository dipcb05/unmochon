@extends('layouts.app')
@section('content')
<div class="container">
<div class = "row">
<div class = "col-2 p-8"><h3>profile</h3></div>
<div class = "row">

<div class = "col-3 p-5">
<div>
    @if(is_null($user->pic))
        <img class="img-thumbnail img-fluid rounded mx-auto d-block" src = " {{ asset('images/default.jpg')}}" alt = "profile picture">
    @else
        <img class="img-thumbnail img-fluid rounded mx-auto d-block" src = " /storage/{{ $user->pic }}" alt = "profile picture">
    @endif
</div>
</div>

<div class = "col-4 p-5">
<div><h2>{{ $user->name }}</h2></div>
<div><h5>lived in</h5></div>
<div><h6>{{ $user->country }}</h6></div>
</div>
<div class = "col-3 p-5 text-center">
    <div><strong>123</strong></div>
    <div><h5>researchs</h5></div>
    <div><strong>123</strong></div>
    <div><h5>reviews</h5></div>
</div>
<div>
    <div><h3>{{ $user->job }}</h3></div>
    <div><strong>Profile Description</strong></div>
    <div><p>{{ $user->description ?? 'N/A' }}</p></div><div class = "d-flex">
   <div class="pr-3"><strong>website: </strong></div>
   <div><a href = "{{ $user->website }} ?? #">{{ $user->website ?? 'N/A' }}</a> </div>
</div>
</div>
<div class="row">
    @foreach($posts as $post)
        <div class="col-sm-3 pt-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ asset('images/1.jpeg') }}" alt="image of paper">
                <div class="card-body">
                    <h5 class="card-title">{{ $post -> pcaption }}</h5>
                    <p class="card-text">short description</p>
                    <a href="/storage/{{ $post -> post }}" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>
    @endforeach
    </div>

</div>
@endsection

