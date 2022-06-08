<?php

namespace App\Contracts\Repositories;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Role;

interface RoleContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request);

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll();

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Role $role
     * @return bool
     */
    public function update(FormRequest $request, Role $role);

    /**
     * Delete the model from database.
     *
     * @param Role $role
     * @return bool|null
     */
    public function delete(Role $role);
}
