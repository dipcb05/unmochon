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
                                @if(!is_null($button))
                                    <a href="{{ route('reviews.editget', $review->id) }}"
                                       class="btn btn-outline-dark">Edit the Review</a>
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
                                <div><br><br></div>
                                <form action ="{{ route('comment.update', [$review->posts_id, $review->id]) }}"
                                      enctype="multipart/form-data"
                                      method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <label for="comment">
                                            discussion
                                        </label>
                                        <div class="col-md-7">

                                <textarea
                                    id="comment"
                                    type="text"
                                    class="form-control
                                       @error('summary') is-invalid @enderror"
                                    name="comment">
                            </textarea>

                                            @error('comment')
                                            <span
                                                class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-4  offset-md-4">
                                            <button type="submit"
                                                    class="btn btn-primary">
                                                {{ __('comment') }}
                                            </button>
                                        </div>
                                    </div>
                                 </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--                                <h3>Comments:</h3>--}}
{{--                                <div id = "app1" style="margin-bottom:50px;">--}}
{{--                                    <label>--}}
{{--                                        <textarea class="form-control"--}}
{{--                                                  rows="3"--}}
{{--                                                  name="body"--}}
{{--                                                  placeholder="Leave a comment"--}}
{{--                                                  v-model="commentBox"></textarea>--}}
{{--                                    </label>--}}
{{--                                    <button class="btn btn-success"--}}
{{--                                            style="margin-top:10px"--}}
{{--                                            @click.prevent="postComment">Save Comment</button>--}}
{{--                                </div>--}}

{{--                                <div v-else>--}}
{{--                                    <h4>You must be logged in to submit a comment!</h4> <a href="/login">Login Now >></a>--}}
{{--                                </div>--}}


{{--                                <div class="media" style="margin-top:20px;" v-for="comment in comments">--}}
{{--                                    <div class="media-left">--}}
{{--                                        <a href="#">--}}
{{--                                            <img class="media-object" src="http://placeimg.com/80/80" alt="...">--}}
{{--                                        </a>--}}
{{--                                    </div>--}}
{{--                                    <div class="media-body">--}}
{{--                                        <h4 class="media-heading">@{{comment.user.name}} said...</h4>--}}
{{--                                        <p>--}}
{{--                                            @{{comment.body}}--}}
{{--                                        </p>--}}
{{--                                        <span style="color: #aaa;">on @{{comment.created_at}}</span>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

{{--        @section('scripts')--}}
{{--            <script>--}}
{{--                const app1 = new Vue({--}}
{{--                    el: '#app1',--}}
{{--                    data: {--}}
{{--                        commentBox: '',--}}
{{--                        comments: {},--}}
{{--                        review: {!! $review->toJson() !!},--}}
{{--                    },--}}
{{--                    mounted() {--}}
{{--                        this.getComments();--}}
{{--                    },--}}

{{--                    methods: {--}}
{{--                        getComments() {--}}
{{--                            console.log(this.commentBox)--}}
{{--                            axios.get('/reviews/'+ this.review.id + '/' + '/comments')--}}
{{--                                .then((response) => {--}}
{{--                                    this.comments = response.data--}}
{{--                                })--}}
{{--                                .catch(function (error) {--}}
{{--                                        console.log(error);--}}
{{--                                    }--}}
{{--                                );--}}
{{--                        },--}}

{{--                        postComment() {--}}
{{--                            console.log('hello world!');--}}
{{--                            axios.post('/reviews/'+ this.review.id+ '/comment', {--}}
{{--                                body: this.commentBox--}}
{{--                            })--}}
{{--                                .then((response) => {--}}
{{--                                    this.comments.unshift(response.data);--}}
{{--                                    this.commentBox = '';--}}
{{--                                })--}}
{{--                                .catch((error) => {--}}
{{--                                    console.log(error);--}}

{{--                                })--}}
{{--                        }--}}
{{--                    }--}}
{{--                })--}}
{{--            </script>--}}
{{--@endsection--}}
