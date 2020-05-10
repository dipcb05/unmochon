@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="col-md-8">
        <div class="card">
            <div class = "row justify-content-center">
                <div class = "col-8 p-5">
                    <div>
                        <h1><b>{{ $posts->pcaption }}</b></h1>
                    </div>
                    <div>
                            <h4>uploader name: <i>{{ $user[0] -> name }}</i></h4>
                    </div>
                          <div>
                              <h5>subject: jnbhbhbhbh</h5>
                              <b>uploaded time: {{ $posts->created_at }}</b>
                          </div>

                    </div>
                </div>
        <div class = "row">
            <div class = "col-5 p-5">
                <div>
                    <h4><b>create review</b></h4>
                </div>
                <div>
                    <a class="btn btn-primary"
                       href="{{ route('reviews.edit', $posts->id) }}"
                       role="button">Create a review</a>
                </div>

            </div>
        </div>
        <div class = "row">
            <div class = "col-5 p-5">
                <div>
                    <h4><b>other reviews of this paper</b></h4>
                </div>
                <div>
                    @foreach($reviews as $rev)
                        <div class="row">
                            <div>
                                <a href="{{ route('reviews.show', [$rev->posts_id, $rev->users_id, $rev->id]) }}">
                                    reviewed by {{ $rev->name }}</a></div></div>
                    @endforeach

            </div>



            </div>
            </div>
            </div>
        </div>
    </div>
@endsection

