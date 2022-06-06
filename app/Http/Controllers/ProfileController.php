<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateProfilePimaryInfoRequest;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $profile)
    {
        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $profile)
    {
        return view('profile.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateProfilePimaryInfoRequest  $request
     * @param  \App\Models\User  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfilePimaryInfoRequest $request, User $profile)
    {
        $validated = $request->validated();

        $picture = $validated['picture'] ?? null;
        
        if(is_null($picture)) {
            $profile->update($request->validated());
        } else {
            Storage::delete($profile->picture ?? '');
            $path = $picture->store('users', 'public');
            $profile->update([
                'last_name' => $validated['last_name'],
                'first_name' => $validated['first_name'],
                'email' => $validated['email'],
                'picture' => $path,
            ]);
        }

        toastr()->success("Les informations primaire du profil ont bien été mise à jour", 'Profil');

        return redirect()->route('settings.profiles.show', $profile);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $profile)
    {
        //
    }
}
