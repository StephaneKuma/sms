<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\RoutineContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Http\Requests\StoreRoutineRequest;
use App\Models\Routine;
use App\Services\Repositories\SchoolSessionService;
use App\Traits\SchoolSession;
use Illuminate\Http\Request;

class RoutineController extends Controller
{
    use SchoolSession;

    public function __construct(
        private RoutineContract $service,
        private SchoolSessionService $sessionService,
        private SchoolClassContract $classSerice
    ) {
    }

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
        $currentSessionId = $this->getCurrentSchoolSession();

        $classes = $this->classSerice->getAllBySession($currentSessionId);

        return view('routines.form', compact('currentSessionId', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreRoutineRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRoutineRequest $request)
    {
        $this->service->create($request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function show(Routine $routine)
    {
        $routines = $this->service->getAll($routine->session_id, $routine->class_id, $routine->section_id);
        $routines = $routines->sortBy('weekday')->groupBy('weekday');

        return view('routines.show', compact('routines', 'routine'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function edit(Routine $routine)
    {
        $currentSessionId = $this->getCurrentSchoolSession();

        $classes = $this->classSerice->getAllBySession($currentSessionId);

        return view('routines.form', compact('currentSessionId', 'classes', 'routine'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Routine $routine)
    {
        $this->service->update($request, $routine);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Routine  $routine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Routine $routine)
    {
        $this->service->delete($routine);

        return back();
    }
}
