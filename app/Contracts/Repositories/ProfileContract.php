<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

interface ProfileContract {
    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $profile
     * @return bool
     */
    public function update(FormRequest $request, User $profile);

    /**
     * Delete the model from database.
     *
     * @param User $profile
     * @return bool|null
     */
    public function delete(User $profile);
}
