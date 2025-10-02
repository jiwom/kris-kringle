<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreDrawRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class IndexController extends Controller
{
    protected UserRepository $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;
    }

    public function index(): View
    {
        $users = [
            'santa'  => $this->repository->getSanta(),
            'giftee' => $this->repository->getGiftee(),
            'wishes' => $this->repository->getWishes(),
        ];

        return view('index', compact('users'));
    }

    public function store(StoreDrawRequest $request): void
    {
        $this->repository->store((int) $request->input('id'), (int) $request->input('picked_id'));
    }

    public function reset(string $cluster): RedirectResponse
    {
        $this->repository->reset();

        return redirect()->to($cluster);
    }

    public function viewResults(): mixed
    {
        return $this->repository->results();
    }
}
