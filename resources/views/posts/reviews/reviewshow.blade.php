@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">review</div>
                    <div class="card-body">
                         <div class = "card">
                             <div class="card-header">reviews by {{ $review->user->name }}</div>
                             <div class="card-body">
                                 <div>pre requisite subjects</div>
                                 <div>{{ $review->sub }}</div>
                                 <div>short summary</div>
                                 <div class="justify-content-center" style="background-color: #95c5ed">  {{ $review->summary }} </div>
                                 <div>key algorithm</div>
                                 <div class = "text-center" style="background-color: #95999c"> {{ $review->algo }}</div>
                                 @if(is_null($review->res))
                                 <div>no additional resources</div>
                                 @else
                                     <div>additional resources</div>
                                     <div><a href = "/storage/{{ $review->res }}">download here</a></div>
                                 @endif
                             </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
