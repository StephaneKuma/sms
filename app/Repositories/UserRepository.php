<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\UserContract;

class UserRepository implements UserContract
{
    /**
     *
     * @var int
     */
    private $role;

    /**
     *
     * @var mixed|array
     */
    private $permissions;

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        $data = $this->validate($request);

        $user = User::create($data);

        toastr()->success("L'utilisateur a bien été créé", "Utilisateurs - Paramètres");

        $this->assignRoleAndPermissions($user);
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return User::all();
    }

    /**
     * Get all the models from database whith the admin role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAdmins()
    {
        return $this->getUsersWithRole('admin');
    }

    /**
     * Get all the models from database whith the teacher role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getTeachers()
    {
        return $this->getUsersWithRole('teacher');
    }

    /**
     * Get all the models from database whith the student role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudents()
    {
        return $this->getUsersWithRole('student');
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function update(FormRequest $request, User $user)
    {
        $data = $this->validate($request, $user);

        $status = $user->update($data);

        toastr()->success("L'utilisateur a bien été mise à jour", "Utilisateurs - Paramètres");

        $this->assignRoleAndPermissions($user);

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user)
    {
        Storage::disk('public')->delete($user->picture);

        $status = $user->delete();

        toastr()->success("L'utilisateur a bien été supprimé", "Utilisateurs - Paramètres");

        return $status;
    }

    /**
     * Validate form request
     *
     * @param FormRequest $request
     * @param User|null $user
     * @return mixed|array
     */
    private function validate(FormRequest $request, User $user = null)
    {
        $validated = $request->validated();

        $this->role = $validated['role'];
        $this->permissions = $validated['permissions'];

        $picture = $validated['picture'] ?? null;
        $path = $picture == null ? null : $picture->store('users', 'public');
        $password = $validated['password'] ?? null;

        if (!is_null($user)) {
            if (!is_null($user->picture)) {
                Storage::disk('public')->delete($user->picture);
            }
        }

        return [
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => $password != null ? bcrypt($password) : $user->password,
            'gender' => $validated['gender'],
            'nationality' => $validated['nationality'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'address2' => $validated['address2'],
            'city' => $validated['city'],
            'zip' => $validated['zip'],
            'birthday' => $validated['birthday'],
            'religion' => $validated['religion'],
            'picture' => $path,
        ];
    }

    /**
     * Assign role and permissions to user.
     *
     * @param User $user
     * @return void
     */
    private function assignRoleAndPermissions(User $user)
    {
        $role = Role::findById($this->role);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user->assignRole($role);
        toastr()->success("Le rôle {$role->name} a bien été attribué à l'utilisateur", "Utilisateurs - Paramètres");
        $user->givePermissionTo($this->permissions);
        $total = count($this->permissions);
        toastr()->success("{$total} ont bien été attribuées à l'utilisateur", "Utilisateurs - Paramètres");
    }

    /**
     * Get all the models from database whith the specified role.
     *
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    private function getUsersWithRole(string $role)
    {
        return User::whereHas('roles', function ($query) use ($role) {
            $query->where('name', $role);
        })->get();
    }
}
