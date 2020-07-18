@extends('layouts.social')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3 p-5 justify-content-center">
                <img class="rounded-circle"
                     src="{{ \App\Http\Helpers\Social::avatar($user->email) }}"
                     alt="Avatar">
            </div>
            <div class="col-9 pt-5">


                @if(auth()->user() && auth()->user()->username == $user->username)
                    <div class="d-flex justify-content-between align-items-baseline">
                        <h1>{{ $user->username }}</h1>
                        <div>
                            <a href="{{route("posts.create")}}" class=" pr-2"><span
                                    class="badge badge-primary p-1">Add New Post</span></a>
                            <a href="{{route("profiles.edit")}}"><span
                                    class="badge badge-primary p-1">Edit Profile</span></a>
                        </div>
                    </div>
                @elseif(auth()->user())
                    <div class="d-flex align-items-baseline">
                        <h1>{{ $user->username }}</h1>
                        <div class="pl-2">
                            <follow-button user-id="{{$user->id}}"
                                           follows-url="{{route('networks.store', [$user->id])}}"
                                           follows="{{$follows}}"
                            ></follow-button>
                        </div>
                    </div>
                @endif

                <div class="d-flex">
                    <div class="pr-3"><strong>{{$user->posts->count() }}</strong> posts</div>
                    <div class="pr-3"><strong>{{$followersCount}}</strong> followers</div>
                    <div class="pr-3"><strong>{{$followingCount}}</strong> following</div>
                </div>
                <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
                <div>
                    {{ $user->profile->description }}
                </div>
                <div><a href="#">{{ $user->profile->url ?? ''}}</a></div>
            </div>
        </div>

        <div class="row pt-4">
            @foreach($user->posts as $post)
                <div class="col-4 p-3">
                    <a href="{{route("posts.show",[$post->id, \App\Http\Helpers\Social::seoLink($post->caption)])}}">
                        <img class="img-thumbnail w-100" src="/storage/{{$post->image}}" alt="{{$post->caption}}">
                    </a>

                </div>
            @endforeach


        </div>

    </div>
@endsection
