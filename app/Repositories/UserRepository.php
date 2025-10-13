<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

class UserRepository
{
    protected $user;

    protected $cluster;

    public function __construct(User $user)
    {
        $this->cluster = Route::current()->parameter('cluster');
        $this->user    = $user;
    }

    /**
     * Fetch user that haven't picked a giftee yet.
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
     * Fetch User that are not being picked yet.
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
     * Get users that are not yet being picked.
     *
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
     * Save to users table the draw results.
     *
     * @param $id
     * @param $picked_id
     */
    public function store($id, $picked_id)
    {
        $this->user->where('id', $id)
                   ->update(['picked_id' => $picked_id]);
    }

    /**
     * Reset the result of selecting giftee.
     */
    public function reset()
    {
        $this->user->where('cluster', $this->cluster)
                   ->update(['picked_id' => 0]);
    }

    /**
     * Dump the users that have picked their giftee.
     */
    public function results()
    {
        return DB::table('users as ua')
                 ->join('users as ub', 'ua.picked_id', '=', 'ub.id')
                 ->select('ua.name', 'ub.name as name_picked', 'ua.cluster')
                 ->get();
    }
}
