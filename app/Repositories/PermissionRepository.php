<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\PermissionContract;

class PermissionRepository implements PermissionContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create($request->validated());

        toastr()->success("La permission a bien été créée", 'Permissions - Paramètres');
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return Permission::orderby('created_at', 'DESC')->get();
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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $status = $permission->update($request->validated());

        toastr()->success("La permission a bien été mise à jour", 'Permissions - Paramètres');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Permission $permission
     * @return bool|null
     */
    public function delete(Permission $permission)
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $status = $permission->delete();

        toastr()->success("La permission a bien été supprimée", 'Permissions - Paramètres');

        return $status;
    }
}
