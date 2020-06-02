@extends('layouts.new')
@section('content')
<div id="carousel01" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/1.jpeg') }}" alt="First slide">
            <div class="carousel-caption">
                <h3>Unmochon</h3>
                    <p>A reseacher blog</p>
            </div>
        </div>
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('images/3.jpg') }}" alt="Second slide">
            <div class="carousel-caption">
                <h3>Unmochon</h3>
                    <p>A reseacher blog</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/5.jpg') }}" alt="Third slide">
            <div class="carousel-caption">
                <h3>Unmochon</h3>
                    <p>A reseacher blog</p>
            </div>
        </div>
        <div class="carousel-item">
            <img class="d-block w-100" src="{{ asset('images/6.jpg') }}" alt="fourth slide">
            <div class="carousel-caption">
                <h3>Unmochon</h3>
                    <p>A reseacher blog</p>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>

<section class = "my-5">
    <h3 class = "text-center">Trending Researchs highlights</h3>
</section>

<section class = "my-5">

    <div class="row">
        @foreach($post as $new)
            @if(is_null($new->posts))<div class = "text-center">
                <h3><br>No New Posts</h3>
            </div>
            @else
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card" style="width: 35rem; height: 35rem;">
                            <div class = "card-body">
                                <div class="card-header">{{ $new->pcaption }}</div>
                                <img class="card-img"
                                     src=" {{ asset('images/1.jpeg') }}"
                                     alt="image of paper"
                                     style="width: 100%; height: 50%">
                                <h5 class="card-title">
                                    <br><b>Author: </b>
                                    {{ $new->author}}</h5>
                                <h5>
                                    <b>Uploaded: {{ $new->created_at }}</b></h5>
                                <a href="/storage/{{ $new -> posts }}"
                                   class="btn btn-primary">download</a>
                                <div class="btn btn-secondary">upvote</div>
                                <a href="{{ route('posts.reviews', $new->id) }}"
                                   class="btn btn-outline-success">reviews</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
@endsection
