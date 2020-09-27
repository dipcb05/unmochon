@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="width: 30rem;">
                <div class="card-header">
                    Candidates
                </div>
    <div class="card-body">
    @for($i = 0 ; $i <= 3 ; $i++)
        @if(!empty($user[$i]) and (!is_null($user[$i])))
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <form action ="{{ route('peer.assign', [$user[$i][0]->id]) }}"
                                      enctype="multipart/form-data" method="post">
                                    @csrf
                                <div>
                                    <a href="{{ route('profile.show', $user[$i][0]->id) }}"> {{ $user[$i][0]->name }}</a>
                                    <button class="btn btn-secondary" type="submit">Assign</button>
                                </div>
                                </form>
                            </li>
                            @endif
    @endfor
                        </ul>
    </div>
            </div>
        </div>
    </div>
@endsection
