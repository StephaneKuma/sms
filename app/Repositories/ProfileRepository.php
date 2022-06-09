<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\ProfileContract;

class ProfileRepository implements ProfileContract
{
    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $profile
     * @return bool
     */
    public function update(FormRequest $request, User $profile)
    {
        $validated = $request->validated();

        $picture = $validated['picture'] ?? null;

        $status = false;

        if(is_null($picture)) {
            $status = $profile->update($request->validated());
        } else {
            Storage::disk('public')->delete($profile->picture);
            $path = $picture->store('users', 'public');
            $status = $profile->update([
                'last_name' => $validated['last_name'],
                'first_name' => $validated['first_name'],
                'email' => $validated['email'],
                'picture' => $path,
            ]);
        }

        toastr()->success("Les informations primaire du profil ont bien été mise à jour", 'Profil');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param User $profile
     * @return bool|null
     */
    public function delete(User $profile)
    {
        if (!is_null($profile->picture)) {
            Storage::disk('public')->delete($profile->picture ?? '');
        }

        $profile->delete();

        toastr()->success("Le profil a bien été supprimé", 'Profil');
    }
}
