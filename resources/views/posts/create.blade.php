@extends('layouts.social')

@section('content')
    <div class="container">
        <form action="{{route("posts.store")}}" enctype="multipart/form-data" name="newpost" method="post" >
            @csrf
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="form-group row">
                        <h2>Add New Post</h2>
                    </div>
                    <div class="form-group row">
                        Get ready to upload a photo to your gallery?
                    </div>
                    <div class="form-group row">
                        <div class="row d-flex align-items-baseline">
                            <div class="pl-4 pr-2 pb-1">
                                <i class="gg-pen form-icon"></i>
                            </div>
                            <label for="caption">
                                Your Post Caption:
                            </label>
                        </div>

                        <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror"
                               name="caption" value="{{ old('caption') }}">

                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                    </div>
                    <div class="form-group row">
                        <div class="row d-flex align-items-baseline">
                            <div class="pl-4 pr-2 pb-1">
                                <i class="gg-software-upload form-icon "></i>
                            </div>
                            <label for="caption">
                                Upload a Photo:
                            </label>
                        </div>
                        <input type="file" name="image" class="form-control-file @error('image') is-invalid @enderror"
                               id="image">

                        @error('image')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror

                    </div>
                    <div class="row pt-4">
                        <button class="btn btn-primary">Submit your Post</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
