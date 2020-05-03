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
{{--            <div class="col-4">--}}
{{--                <div>--}}
{{--                    <div class="d-flex align-items-center">--}}
{{--                        <div class="pr-3">--}}

{{--                        </div>--}}
{{--                        <div>--}}
{{--                            <div class="font-weight-bold">--}}
{{--                                <a href="/profile/{{  }}">--}}
{{--                                    <span class="text-dark">{{  }}</span>--}}
{{--                                </a>--}}
{{--                                <a href="#" class="pl-3">Follow</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <hr>--}}

{{--                    <p>--}}
{{--                    <span class="font-weight-bold">--}}
{{--                        <a href="/profile/{{  }}">--}}
{{--                            <span class="text-dark">{{  }}</span>--}}
{{--                        </a>--}}
{{--                    </span> {{  }}--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
