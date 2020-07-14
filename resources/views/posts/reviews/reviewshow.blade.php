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

                        @if($total == '0')
                            <div class = "pl-2"> no one comment yet</div>
                        @else
                           <div> {{ $total[0]->count }} comments</div>
                            <div class="pl-2">
                                <div class="card">
                                    <div class="card-header">show all comments</div>
                                    <div class="card-body">
                                        @foreach($comments as $comment)
                                            <div class="row justify-content-center">
                                                <div>comment by
                                                    <a href="{{ route('profile.show', $comment->users_id) }}">
                                                        {{ $comment->name }}</a>
                                                </div>
                                            </div>
                                            <div class="row" style="background-color: #ebe0b2">
                                                {{ $comment->comment }}
                                            </div>
                                            <div class = "row" style="background-color: #ced4da">
                                                comment time:
                                                {{ $comment->updated_at }}
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                        @endif

                                <div class ="

                        <div class="pb-2 pl-2">
                            <a class="btn btn-primary"
                               href="{{ route('comment.create',
                                 [$review->posts_id, $review->users_id, $review->id]) }}"
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
                </div>
            </div>
        </div>
    </div>
@endsection
