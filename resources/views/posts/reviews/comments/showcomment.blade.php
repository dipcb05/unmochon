@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class = "row">
            <div class = "col-8 p-5">
                <div class="card">
                    <div class="card-header">show all comments</div>
                    <div class="card-body">
                       @foreach($com as $comment)
                           <div class="row justify-content-center">
                           <div>comment by <a href="{{ route('profile.show', $comment->users_id) }}">
                                   {{ $comment->name }}</a></div>
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
            </div>
        </div>
    </div>
@endsection
