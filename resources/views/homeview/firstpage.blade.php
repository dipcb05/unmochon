@extends('layouts.new')
@section('content')
<div id="carousel01" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="d-block w-100" src="{{ asset('images/1.jpeg') }}" alt="First slide">
            <div class="carousel-caption">
                <h3>Unmochon</h3>
                    <p>A reseacher blog</p>
            </div>
        </div>
        <div class="carousel-item">
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
        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="images/1.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">New Paper</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="images/1.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">New Paper</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="images/1.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">New Paper</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>

        <div class="col-sm-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="images/1.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">New Paper</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>


    </div>
</section>


<section><footer><p class="p-3 bg-dark text-white text-center">Developed by Dip Chakraborty</p></footer></section>
@endsection
