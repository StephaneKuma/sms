<?php

namespace App\Services\Repositories;

use Spatie\Permission\Models\Role;
use App\Repositories\RoleRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\RoleContract;

class RoleService implements RoleContract
{
    /**
     * Create a new instance of the class
     *
     * @param RoleRepository $repository
     */
    public function __construct(private RoleRepository $repository)
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
     * @param Role $role
     * @return bool
     */
    public function update(FormRequest $request, Role $role)
    {
        return $this->repository->update($request, $role);
    }

    /**
     * Delete the model from database.
     *
     * @param Role $role
     * @return bool|null
     */
    public function delete(Role $role)
    {
        return $this->repository->delete($role);
    }
}
