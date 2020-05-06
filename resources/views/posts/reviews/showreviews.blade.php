@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class = "row">
            <div class = "col-3 p-5">
          <div class="card">
              <div class="card-header">show all reviews</div>
              <div class="card-body">
                  <div class="row">
                      @foreach($reviews as $rev)
                  <a href="{{ route('reviews.show', [$rev->posts_id, $rev->users_id, $rev->id]) }}">
                     reviewed by {{ $rev->name }}</a>
                      @endforeach
                  </div>
              </div>
          </div>
            </div>
        </div>
    </div>
@endsection
