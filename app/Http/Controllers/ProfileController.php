<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\ProfileContract;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateProfilePrimaryInfoRequest;

class ProfileController extends Controller
{
    /**
     * Create a new instance of the class.
     *
     * @param ProfileContract $service
     */
    public function __construct(private ProfileContract $service)
    {}

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
     * @param  \App\Http\Requests\UpdateProfilePrimaryInfoRequest  $request
     * @param  \App\Models\User  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfilePrimaryInfoRequest $request, User $profile)
    {
        $this->service->update($request, $profile);

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
        $this->service->delete($profile);

        return back();
    }
}
