<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="css/style.scss">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>




<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Unmochon</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
            </li>

            <li class="nav-item">

                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    See paper
                </a>
                <div class="dropdown-menu" aria-labelledby="DropDown">
                    <a class="dropdown-item" href="#"></a>
                    <a class="dropdown-item" href="#">Subject</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Author</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="php/about.php">About Us</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
    </div>
</nav>


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
