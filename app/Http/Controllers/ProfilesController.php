<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Social;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display User Profile or 404 page
     * @param $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($username)
    {
        $user = User::where('username', $username)->firstOrFail();
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(60),
            function () use ($user) {
                return $user->posts->count();
            });

        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(60),
            function () use ($user) {
                return $user->profile->followers->count();
            });

        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(60),
            function () use ($user) {
                return $user->following->count();
            });


        return view('profiles.index', compact('user', 'follows','postCount','followersCount','followingCount'));
    }

    /**
     * redirect to loginned profile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userprofile()
    {
        return redirect(route('profiles.show', [auth()->user()->username]));
    }

    /**
     * Update user profile
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        $user = auth()->user();
        return view("profiles.edit", compact('user'));
    }

    public function update()
    {
        $user = auth()->user();
        $data = \request()->validate([
            'name' => ['required'],
            'title' => ['required'],
            'description' => ['required'],
            'url' => ['url'],
            'image' => ['image']
        ]);
        $userUpdateData = [
            "name" => $data['name']
        ];

        if (\request()->filled('password')) {
            $password = \request()->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed']
            ]);
            $userUpdateData['password'] = Hash::make($password['password']);
        }


        $user->profile->update([
            "title" => $data['title'],
            "description" => $data['description'],
            "url" => $data['url']
        ]);

        $user->update($userUpdateData);

        if (\request("image")) {
            $imagePath = \request('image')->store('avatar', 'public');
            $publicPath = public_path("storage/{$imagePath}");
            $uploadedImg = Image::make($publicPath)->fit(200, 200);
            $uploadedImg->save(public_path("storage/avatar/" . Social::getHash($user->email)) . ".jpg", 90, "jpg");
            @unlink($publicPath);
        }

        return $this->edit();
    }
}
