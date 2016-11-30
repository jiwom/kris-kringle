<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndexController extends Controller
{
    protected $user;
    protected $cluster;

    public function __construct(User $user)
    {
        $this->cluster = Route::current()->getParameter('cluster');
        $this->user    = $user;
    }

    public function index()
    {
        $users['santa']  = $this->getSanta();
        $users['giftee'] = $this->getGiftee();
        $users['wishes'] = $this->getWishes();

        return view('index', compact('users'));
    }

    /**
     * Fetch user that haven't picked a giftee yet
     *
     * @return mixed
     */
    public function getSanta()
    {
        return $this->user
            ->where([
                ['picked_id', 0],
                ['cluster', $this->cluster],
            ])
            ->pluck('name', 'id')->toArray();
    }

    /**
     * Fetch User that are not being picked yet
     *
     * @return array
     */
    public function getGiftee()
    {
        return $this->user
            ->whereNotIn('id', $this->getUnchosenGiftee())
            ->where('cluster', $this->cluster)
            ->pluck('id', 'name')
            ->toArray();
    }

    /**
     * Get users that are not yet being picked
     *
     * @param $user
     * @return mixed
     */
    public function getUnchosenGiftee()
    {
        return $this->user
            ->where([
                ['picked_id', '>', 0],
                ['cluster', $this->cluster],
            ])
            ->pluck('picked_id')->toArray();
    }

    /**
     * Fetch all Users Wishes.
     *
     * @return mixed
     */
    public function getWishes()
    {
        return $this->user
            ->where('cluster', $this->cluster)
            ->pluck('wishes', 'name')
            ->all();
    }

    /**
     * Save to users table the draw results
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $this->user->where('id', $request->input('id'))
             ->update(['picked_id' => $request->input('picked_id')]);
    }

    /**
     * Reset all pcked data per cluster.
     *
     * @return mixed
     */
    public function reset()
    {
        $this->user->where('cluster', $this->cluster)
             ->update(['picked_id' => 0]);

        return redirect('/' . $this->cluster);
    }
}
