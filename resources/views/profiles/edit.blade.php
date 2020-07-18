@extends('layouts.social')

@section('content')
    <div class="container">
        <form action="{{route("profiles.update")}}" enctype="multipart/form-data" name="frm" method="post">
            @csrf
            @method('PATCH')
            <div class="form-group row">
                <div class="offset-4 col-6 justify-content-between">
                    <strong>Change Avatar:</strong>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-6 offset-4">
                    <div class="row">
                        <img src="{{ \App\Http\Helpers\Social::avatar($user->email) }}" class="rounded-circle">
                    </div>
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


            </div>
            <div class="form-group row">
                <div class="offset-4 col-6 justify-content-between">
                    <strong>Update Profile Info:</strong>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                           value="{{ old('name') ??  $user->name }}" data-name="name">

                    @error('name')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="title" class="col-md-4 col-form-label text-md-right">Title:</label>

                <div class="col-md-6">
                    <input id="title"
                           type="text" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ old('title') ?? $user->profile->title }}" data-name="title">

                    @error('title')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">Description:</label>

                <div class="col-md-6">
                    <textarea id="description"
                              type="text" class="form-control @error('description') is-invalid @enderror"
                              name="description"
                              value="{{ old('description') ??  $user->profile->description }}"
                              data-name="description">{{ old('description') ?? $user->profile->description }}</textarea>

                    @error('description')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="url" class="col-md-4 col-form-label text-md-right">Personal Url:</label>

                <div class="col-md-6">
                    <input id="url"
                           type="text" class="form-control @error('url') is-invalid @enderror" name="url"
                           value="{{ old('url') ??  $user->profile->url }}" data-name="title">

                    @error('url')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                           name="email" value="{{ $user->email }}" disabled data-name="email">

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username"
                           type="text" class="form-control @error('username')  is-invalid @enderror" disabled
                           name="username"
                           value="{{ $user->username }}" data-name="username">

                    @error('username')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="offset-4 col-6 justify-content-between">
                    <strong>Change Password?</strong>
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                           name="password" value="{{old('password')}}" data-name="new-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>


            <div class="form-group row">
                <label for="password-confirm"
                       class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                           data-name="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Update Account') }}
                    </button>
                </div>
            </div>


        </form>
    </div>
@endsection
