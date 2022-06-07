<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateUserRequest;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::whereNotIn('name', ['super admin'])->get();
        $permissions = Permission::all();

        return view('users.form', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreUserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $picture = $validated['picture'] ?? null;
        $path = $picture == null ? null : $picture->store('users', 'public');

        $user = User::create([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
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
        ]);

        toastr()->success("L'utilisateur a bien été créé", "Utilisateurs - Paramètres");

        $role = Role::findById($validated['role']);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user->assignRole($role);
        toastr()->success("Le rôle {$role->name} a bien été attribué à l'utilisateur", "Utilisateurs - Paramètres");
        $permissions = $validated['permissions'];
        $user->syncPermissions($permissions);
        $total = count($permissions);
        toastr()->success("{$total} ont bien été attribuées à l'utilisateur", "Utilisateurs - Paramètres");

        return redirect()->route('settings.acl.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::whereNotIn('name', ['super admin'])->get();
        $permissions = Permission::all();

        return view('users.form', compact('user', 'roles', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateUserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();

        $picture = $validated['picture'] ?? null;
        $path = $picture == null ? null : $picture->store('users', 'public');
        $password = $validated['password'] ?? null;
        $password = $password != null ? bcrypt($password) : $user->password;

        if (!is_null($path)) {
            Storage::delete($user->picture);
        }

        $user->update([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email' => $validated['email'],
            'password' => $password,
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
        ]);

        toastr()->success("L'utilisateur a bien été mise à jour", "Utilisateurs - Paramètres");

        $role = Role::findById($validated['role']);
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        $user->assignRole($role);
        toastr()->success("Le rôle {$role->name} a bien été attribué à l'utilisateur", "Utilisateurs - Paramètres");
        $permissions = $validated['permissions'];
        $user->givePermissionTo($permissions);
        $total = count($permissions);
        toastr()->success("{$total} ont bien été attribuées à l'utilisateur", "Utilisateurs - Paramètres");

        return redirect()->route('settings.acl.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->picture);

        $user->delete();

        toastr()->success("L'utilisateur a bien été supprimé", "Utilisateurs - Paramètres");

        return back();
    }
}
