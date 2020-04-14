@extends('layouts.appprofile')
@section('content')
<div class="container">
  
<div class = "row">
<div class = "col-2 p-8"><h3>profile</h3></div> 
<div class = "row">

<div class = "col-3 p-5">
<div>
<img class="img-thumbnail img-fluid rounded mx-auto d-block"src = "{{ asset('images/pro.jpg')}}"alt = "profile picture">
</div>
</div>

<div class = "col-4 p-5">
<div><h2>{{ $user->name }}</h2></div>
<div><h5>lived in</h5></div>
<div><h6>dhaka, bangladesh</h6></div>
</div>
<div class = "col-3 p-5 text-center">
    <div><strong>123</strong></div>
    <div><h5>researchs</strong></div>
    <div><strong>123</strong></div>
    <div><h5>reviews</strong></div>
</div>
<div>
    <div><h3>job name</h3></div>
    <div><strong>sample profile description</strong></div>
    <div><p>
        A paragraph contains a group of sentences intertwined with each other to discuss, or debate, or explain a central idea. It conventionally begins with an indented line. A beginner writer or a student usually starts writing a paragraph having seven sentences, while some professors of composition advise beginners to start with nine sentences, and some others ask them to start with eleven sentences. Some, however, teach all three paragraph types step by step.</p></div>
   <div class = "d-flex">
   <div class="pr-3"><strong>website: </strong></div>
   <div><a href = "http://www.f.com">www.f.com</a> </div>
</div>
</div>
<div class="row">
        <div class="col-sm-3 pt-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="images/1.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">New Paper</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>
         <div class="col-sm-3 pt-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="images/1.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">New Paper</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>
         <div class="col-sm-3 pt-4">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="images/1.jpeg" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">New Paper</h5>
                    <p class="card-text">description</p>
                    <a href="#" class="btn btn-primary">Read</a>
                </div>
            </div>
        </div>
        <div class="col-sm-3 pt-4">
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

</div>
@endsection

