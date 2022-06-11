<?php

namespace App\Http\Controllers;

use App\Models\SchoolSession;
use App\Http\Requests\StoreSchoolSessionRequest;
use App\Http\Requests\UpdateSchoolSessionRequest;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Http\Requests\BrowseSchoolSessionRequest;

class SchoolSessionController extends Controller
{
    public function __construct(private SchoolSessionContract $service)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sessions = $this->service->getAll();

        return view('settings.sessions.index', compact('sessions'));
    }

    public function browse(BrowseSchoolSessionRequest $request)
    {
        $this->service->browse($request);

        return back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.sessions.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSchoolSessionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolSessionRequest $request)
    {
        $this->service->create($request);

        return back();
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
        return view('settings.sessions.form', compact('session'));
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
        $this->service->update($request, $session);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolSession  $session
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolSession $session)
    {
        $this->service->delete($session);

        return back();
    }
}
