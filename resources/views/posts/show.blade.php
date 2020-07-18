@extends('layouts.social')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-8">
                <img src="/storage/{{$post->image}}" class="rounded w-100">
            </div>
            <div class="col-4">
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{App\Http\Helpers\Social::avatar($post->user->email)}}"
                             class="rounded-circle social-avatar">
                    </div>
                    <div>
                        <a href="{{route('profiles.show', [$post->user->username])}}"><span
                                class="font-weight-bold">{{$post->user->username}}</span></a>
                    </div>
                </div>
                <hr>
                <div class="row pt-3">
                    <a href="{{route('profiles.show', [$post->user->username])}}"><span
                            class="font-weight-bold text-muted">{{$post->user->username}}</span></a>
                    <span class="pl-2">{{ $post->caption }}</span>
                </div>
            </div>
        </div>

    </div>
@endsection
