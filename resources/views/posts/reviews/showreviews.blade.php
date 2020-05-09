@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class = "row">
            <div class = "col-8 p-5">
          <div class="card">
              <div class="card-header">show all reviews</div>
              <div class="card-body">
                      @foreach($reviews as $rev => $new)
                          <div class="row">
                  <div><a href="{{ route('reviews.show', [$new->posts_id, $new->users_id, $new->id]) }}">
                          reviewed by {{ $new->name }}</a></div>
                              <div class="pl-2">upvoted by 33</div>
                              @if($total == '0')
                                  <div class = "pl-2"> no one comment yet</div>
                              @else
                              <div class="pl-2">
                                  <a href = {{ route('comment.show', [$new->posts_id, $new->users_id, $new->id]) }}>
                                      {{ $total[$rev] -> count }} comments
                                  </a>
                              </div>
                              @endif
                              <div class="pb-2 pl-2">
                              <a class="btn btn-primary"
                                 href="{{ route('comment.create', [$new->posts_id, $new->users_id, $new->id]) }}"
                                 role="button">
                                  Comment
                              </a>
                      <a class="btn btn-primary"
                         href="#"
                         role="button">
                          Upvote
                      </a>
                          </div>
              </div>
                      @endforeach
              </div>
          </div>
            </div>
        </div>
    </div>
@endsection
