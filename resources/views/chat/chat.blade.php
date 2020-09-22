@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">ChatBox</div>
                    <div class="card-body">
                                <div class="card">
                                    <div class="card-header">Conversation</div>
                                    <div class="card-body">
                                        @if(is_null($msg))
                                            <div>there is no message. let's chat</div>
                                        @else
                                            @foreach($msg as $msg1)
                                                <div>{{ $msg1->name }} Says -> {{ $msg1 -> message }}</div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
<br><br>
                        <form action ="{{ route('message.update', [$other]) }}"
                              enctype="multipart/form-data"
                              method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="msg">
                                   Send New Message
                                </label>
                                <div class="col-md-7">

                                <textarea
                                    id="msg"
                                    type="text"
                                    class="form-control
                                       @error('msg') is-invalid @enderror"
                                    name="msg">
                            </textarea>

                                    @error('msg')
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
                                        {{ __('Send') }}
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
