<?php

namespace App\Http\Controllers;

use App\User;

class IndexController extends Controller
{
    public function index(User $user)
    {
        return view('index');
    }
}
