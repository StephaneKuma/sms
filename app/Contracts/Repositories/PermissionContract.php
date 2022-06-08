<?php

namespace App\Contracts\Repositories;

use Illuminate\Foundation\Http\FormRequest;
use Spatie\Permission\Models\Permission;

interface PermissionContract
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
     * @param Permission $permission
     * @return bool
     */
    public function update(FormRequest $request, Permission $permission);

    /**
     * Delete the model from database.
     *
     * @param Permission $permission
     * @return bool|null
     */
    public function delete(Permission $permission);
}
