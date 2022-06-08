<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\RoleContract;

class RoleRepository implements RoleContract
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

        Role::create($request->validated());

        toastr()->success("Le rôle a bien été créé", 'Rôles - Paramètres');
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return Role::orderby('name')->get();
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
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $status = $role->update($request->validated());

        toastr()->success("Le rôle a bien été mise à jour", 'Rôles - Paramètres');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Role $role
     * @return bool|null
     */
    public function delete(Role $role)
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $status = $role->delete();

        toastr()->success("Le rôle a bien été supprimé", 'Rôles - Paramètres');

        return $status;
    }
}
