<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolSession;
use App\Http\Requests\StoreSchoolSessionRequest;
use App\Http\Requests\UpdateSchoolSessionRequest;

class SchoolSessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = SchoolSession::orderby('created_at', 'DESC')->get();

        return view('sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sessions.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSchoolSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolSessionRequest $request)
    {
        SchoolSession::create($request->validated());

        toastr()->success('La session a bien été créée', 'Sessions - Ecole');

        return redirect()->route('school.sessions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolSession $session)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolSession $session)
    {
        return view('sessions.form', compact('session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSchoolSessionRequest  $request
     * @param  \App\Models\SchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolSessionRequest $request, SchoolSession $session)
    {
        $session->update($request->validated());

        toastr()->success('La session a bien été mise à jour', 'Sessions - Ecole');

        return redirect()->route('school.sessions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolSession $session)
    {
        $session->delete();

        toastr()->success('La session a bien été supprimée', 'Sessions - Ecole');

        return back();
    }
}
