<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(User $user)
    {
        $unchosenGiftee  = $user->where('picked_id', '>', 0)->pluck('picked_id')->toArray();
        $users['santa']  = $user->where('picked_id', 0)->pluck('name', 'id')->toArray();
        $users['giftee'] = $user->whereNotIn('id', $unchosenGiftee)->pluck('id', 'name')->toArray();
        $users['wishes'] = $user->pluck('wishes', 'name')->all();

        return view('index', compact('users'));
    }

    public function store(Request $request, User $user)
    {
        $user->where('id', $request->input('id'))
             ->update(['picked_id' => $request->input('picked_id')]);
    }
}
