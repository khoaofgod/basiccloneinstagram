<?php

namespace App\Http\Controllers;

use App\Network;
use App\User;
use Illuminate\Http\Request;

class NetworksController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Create relation follow / unfollow
     * @param User $user
     * @return mixed
     */
    public function store(User $user)
    {
        return auth()->user()->following()->toggle($user->profile);
    }
}
