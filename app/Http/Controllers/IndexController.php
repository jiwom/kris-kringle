<?php

namespace App\Http\Controllers;

use App\User;

class IndexController extends Controller
{
    public function index(User $user)
    {
        $users['name']   = implode(',', $user->pluck('name')->toArray());
        $users['wishes'] = $user->pluck('wishes', 'name')->all();

        return view('index', compact('users'));
    }
}
