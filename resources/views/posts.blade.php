@extends('layouts.app')
@section('content')
<div class="container">
        	<form action ="\p" enctype="multipart/form-data" method="post">
            @csrf
        	<div class = "row pt-3 pb-3">
        		<h2>Add new post</h2>
        	</div>
                          <div class="row">
                          	<div class = "col-11 offset-1">

                            <div class="form-group row">
                            <label for="pcaption" 
                             class="col-md-1 col-form-label ">
                             post caption
                            </label>

                            <div class="col-md-8">
                                <input id="pcaption" 
                                 type="text" 
                                 class="form-control @error('pcaption') is-invalid @enderror" 
                                 name="pcaption" 
                                 value="{{ old('pcaption') }}" 
                                 required autocomplete="post caption" 
                                 autofocus>

                                @error('pcaption')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

<div class = "row">
    	
      <input id = "post"
       type = "file"
       class = "form-control-file pt-2 pl-6"
       name  = "post">
      @error('post')
       <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
       </span>
      @enderror
    </div>

<div class="row pt-4">
	<button class="btn btn-primary col-md-1 ">upload</button>
	<button class="btn btn-danger col-md-1 offset-md-5">cancel</button>
</div>
</div>
 </div>


        		</form>     
            </div>
            @endsection


