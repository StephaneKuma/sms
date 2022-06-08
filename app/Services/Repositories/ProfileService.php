<?php

namespace App\Services\Repositories;

use App\Models\User;
use App\Repositories\ProfileRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\ProfileContract;

class ProfileService implements ProfileContract
{
    /**
     * Create a new instance of the class.
     *
     * @param ProfileRepository $repository
     */
    public function __construct(private ProfileRepository $repository)
    {}

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $profile
     * @return bool
     */
    public function update(FormRequest $request, User $profile)
    {
        return $this->repository->update($request, $profile);
    }

    /**
     * Delete the model from database.
     *
     * @param User $profile
     * @return bool|null
     */
    public function delete(User $profile)
    {
        return $this->repository->delete($profile);
    }
}
