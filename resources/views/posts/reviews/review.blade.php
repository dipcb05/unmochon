@extends('layouts.app')
@section('content')
    <div class="container-fluid">
            <div class = "row">
                <div class = "col-3 p-5">
                    <div>
                        <h1><b>{{ $posts->pcaption }}</b></h1>
                    </div>
                    <div>
                        @foreach($user as $users)
                            <h4><i>{{ $users -> name }}</i></h4>
                        @endforeach
                    </div>
                          <div>
                              <h5>subject: jnbhbhbhbh</h5>
                              <b>uploaded time: {{ $posts->created_at }}</b>

                          </div>

                    </div>
                </div>
        <div class = "row">
            <div class = "col-3 p-5">
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
            <div class = "col-3 p-5">
                <div>
                    <h4><b>other reviews of this paper</b></h4>
                </div>
                <div>
                    <a class="btn btn-primary"
                       href="{{ route('reviews.showall', [$posts->id]) }}"
                       role="button">see reviews</a>
                </div>

            </div>
        </div>
    </div>
@endsection

