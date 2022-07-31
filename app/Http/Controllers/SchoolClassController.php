<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Models\SchoolSession;
use App\Http\Requests\StoreSchoolClassRequest;
use App\Http\Requests\UpdateSchoolClassRequest;
use App\Contracts\Repositories\SchoolClassContract;
use App\Traits\SchoolSession as SchoolSessionTrait;
use App\Contracts\Repositories\SchoolSessionContract;

class SchoolClassController extends Controller
{
    use SchoolSessionTrait;

    /**
     * Create a new instance of the class
     *
     * @param SchoolClassContract $service
     */
    public function __construct(
        private SchoolClassContract $service,
        private SchoolSessionContract $sessionService
    ) {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = $this->service->getAllWithSectionsAndCoursesAndSyllabiBySession($this->getCurrentSchoolSession());

        return view('settings.classes.index', compact("classes"));
    }

    /**
     * get all the model from database by class id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSectionsAndCoursesByClassId(Request $request)
    {
        $classId = $request->query('class_id', 0);

        $class = $this->service->getSectionsAndCoursesByClassId($this->getCurrentSchoolSession(), $classId);

        return response()->json(compact('class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessionId = $this->getCurrentSchoolSession();

        return view('settings.classes.form', compact('sessionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSchoolClassRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSchoolClassRequest $request)
    {
        $this->service->create($request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolClass $class)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolClass $class)
    {
        $sessionId = $this->getCurrentSchoolSession();

        return view('settings.classes.form', compact('class', 'sessionId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSchoolClassRequest  $request
     * @param  \App\Models\SchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSchoolClassRequest $request, SchoolClass $class)
    {
        $this->service->update($request, $class);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolClass  $class
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolClass $class)
    {
        $this->service->delete($class);

        return back();
    }
}
