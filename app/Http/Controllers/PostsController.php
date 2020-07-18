<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware([
            'auth'
        ]);
    }

    /**
     * Create / Upload new post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     *  Upload photo & generate a post
     */
    public function store()
    {
        // dd(\request()->all());
        $data = \request()->validate([
            "caption" => ["required"],
            "image" => ["required", "image"]
        ]);
        // upload & resize photo to SQUARE
        $imagePath = \request('image')->store('photos', 'public');
        $uploadedImg = Image::make(public_path("storage/{$imagePath}"))->fit(1920, 1920);
        $uploadedImg->save();
        $data["image"] = $imagePath;

        auth()->user()->posts()->create($data);

        return redirect('/profile/' . auth()->user()->username);

    }


    /**
     * Display a Photo
     * @param int $id
     * @param null $cap
     */
    public function show(int $id)
    {
        $post = Post::findOrFail($id);
        return view("posts.show", compact('post'));
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);

        return view('posts.index', compact('posts'));
    }
}
