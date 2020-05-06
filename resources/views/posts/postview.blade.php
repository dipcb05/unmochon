@extends('layouts.app')
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-8">
                <h3>abcd</h3>
                <iframe src='/storage/{{ $file }}' width=”200%” height=”200%”>
                </iframe>
                <h2>{{ $file }}</h2>
            </div>
        </div>
    </div>
@endsection
