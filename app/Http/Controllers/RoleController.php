<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderby('name')->get();

        return view('roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoleRequest $request)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        Role::create($request->validated());

        toastr()->success("Le rôle a bien été créé", 'Rôles - Paramètres');

        return redirect()->route('settings.acl.roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.form', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateRoleRequest  $request
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $role->update($request->validated());

        toastr()->success("Le rôle a bien été mise à jour", 'Rôles - Paramètres');

        return redirect()->route('settings.acl.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $role->delete();

        toastr()->success("Le rôle a bien été supprimé", 'Rôles - Paramètres');

        return back();
    }
}
