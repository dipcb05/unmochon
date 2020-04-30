@extends('layouts.new')
@foreach($find as $key=>$data)
<h3>{{ $data -> user_id }}</h3>
<h3>{{ $user[$key] -> name }}</h3>
@endforeach

