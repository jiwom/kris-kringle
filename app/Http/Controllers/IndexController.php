<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * @var \App\Http\Controllers\UserRepository
     */
    protected $repository;

    /**
     * IndexController constructor.
     *
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    /**
     * Fetch all necessary data.
     *
     * @return mixed
     */
    public function index()
    {
        $users['santa']  = $this->repository->getSanta();
        $users['giftee'] = $this->repository->getGiftee();
        $users['wishes'] = $this->repository->getWishes();

        return view('index', compact('users'));
    }

    /**
     * Save to users table the draw results.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        $this->repository->store($request->input('id'), $request->input('picked_id'));
    }

    /**
     * Reset all pcked data per cluster.
     *
     * @return mixed
     */
    public function reset($cluster)
    {
        $this->repository->reset();

        return redirect()->to($cluster);
    }

    /**
     * Display the current results of the kris-kringle.
     */
    public function viewResults()
    {
        $this->repository->results();
    }
}
