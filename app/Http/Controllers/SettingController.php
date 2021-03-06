<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Contracts\Repositories\SemesterContract;
use App\Contracts\Repositories\UserContract;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use App\Traits\SchoolSession;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use SchoolSession;

    public function __construct(
        private SchoolSessionContract $sessionService,
        private SchoolClassContract $classService,
        private SemesterContract $semesterService,
        private UserContract $userService,
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $currentSessionId = $this->getCurrentSchoolSession();
        $latestSessionId = $this->sessionService->getLatest()->id;
        $setting = Setting::all()->last();
        $sessions = $this->sessionService->getAll();
        $semesters = $this->semesterService->getAllBySession($currentSessionId);
        $classes = $this->classService->getAllBySession($currentSessionId);
        $teachers = $this->userService->getTeachers();

        return view('settings.index', compact(
            'currentSessionId',
            'latestSessionId',
            'setting',
            'sessions',
            'semesters',
            'classes',
            'teachers',
        ));
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
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSettingRequest  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $setting->update($request->validated());

        toastr()->success('Le param??tre a bien ??t?? mise ?? jour.', 'Param??tres - Ecole');

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
