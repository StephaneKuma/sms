<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderby('created_at', 'DESC')->get();

        return view('permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permissions.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StorePermissionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePermissionRequest $request)
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        Permission::create($request->validated());

        toastr()->success("La permission a bien été créée", 'Permissions - Paramètres');

        return redirect()->route('settings.acl.permissions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('permissions.form', compact('permission'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdatePermissionRequest  $request
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $permission->update($request->validated());

        toastr()->success("La permission a bien été mise à jour", 'Permissions - Paramètres');

        return redirect()->route('settings.acl.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        
        $permission->delete();

        toastr()->success("La permission a bien été supprimée", 'Permissions - Paramètres');

        return back();
    }
}
