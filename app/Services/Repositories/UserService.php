<?php

namespace App\Services\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\UserContract;

class UserService implements UserContract
{
    /**
     * Create a new instance of the class
     *
     * @param UserRepository $repository
     */
    public function __construct(private UserRepository $repository)
    {}

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        $this->repository->create($request);
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function update(FormRequest $request, User $user)
    {
        return $this->repository->update($request, $user);
    }

    /**
     * Delete the model from database.
     *
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user)
    {
        return $this->repository->delete($user);
    }
}
