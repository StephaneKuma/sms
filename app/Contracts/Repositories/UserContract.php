<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

interface UserContract
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
     * @param User $user
     * @return bool
     */
    public function update(FormRequest $request, User $user);

    /**
     * Delete the model from database.
     *
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user);
}
