<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(User $user, $cluster)
    {
        $unchosenGiftee  = $user->where([['picked_id', '>', 0], ['cluster', $cluster]])->pluck('picked_id')->toArray();
        $users['santa']  = $user->where([['picked_id', 0], ['cluster', $cluster]])->pluck('name', 'id')->toArray();
        $users['giftee'] = $user->whereNotIn('id', $unchosenGiftee)->where('cluster', $cluster)
                                ->pluck('id', 'name')->toArray();
        $users['wishes'] = $user->where('cluster', $cluster)->pluck('wishes', 'name')->all();

        return view('index', compact('users'));
    }

    public function store(Request $request, User $user)
    {
        $user->where('id', $request->input('id'))
             ->update(['picked_id' => $request->input('picked_id')]);
    }

    public function reset($cluster)
    {
        $user->where('cluster', $cluster)
             ->update(['picked_id' => 0]);
    }
}
