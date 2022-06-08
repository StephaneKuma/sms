<?php

namespace App\Services\Repositories;

use Spatie\Permission\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\PermissionContract;

class PermissionService implements PermissionContract
{
    /**
     * Create a new instance of the class
     *
     * @param PermissionRepository $repository
     */
    public function __construct(private PermissionRepository $repository)
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
     * @param Permission $permission
     * @return bool
     */
    public function update(FormRequest $request, Permission $permission)
    {
        return $this->repository->update($request, $permission);
    }

    /**
     * Delete the model from database.
     *
     * @param Permission $permission
     * @return bool|null
     */
    public function delete(Permission $permission)
    {
        return $this->repository->delete($permission);
    }
}
