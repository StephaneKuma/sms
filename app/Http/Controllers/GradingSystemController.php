<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use App\Models\GradingSystem;
use App\Traits\SchoolSession;
use App\Contracts\Repositories\SemesterContract;
use App\Http\Requests\StoreGradingSystemRequest;
use App\Http\Requests\UpdateGradingSystemRequest;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\GradingSystemContract;
use App\Contracts\Repositories\SchoolSessionContract;

class GradingSystemController extends Controller
{
    use SchoolSession;

    public function __construct(private GradingSystemContract $service,
        private SchoolSessionContract $sessionService,
        private SemesterContract $semesterService,
        private SchoolClassContract $classService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $systems = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('exams.grades.index', compact('systems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = $this->getData();

        return view('exams.grades.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreGradingSystemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGradingSystemRequest $request)
    {
        $this->service->create($request);

        return redirect()->route('school.exams.grading.systems.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradingSystem  $system
     * @return \Illuminate\Http\Response
     */
    public function show(GradingSystem $system)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradingSystem  $system
     * @return \Illuminate\Http\Response
     */
    public function edit(GradingSystem $system)
    {
        $data = $this->getData();

        return view('exams.grades.form', array_merge(compact('system'), $data));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateGradingSystemRequest  $request
     * @param  \App\Models\GradingSystem  $system
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGradingSystemRequest $request, GradingSystem $system)
    {
        $this->service->update($request, $system);

        return redirect()->route('school.exams.grading.systems.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradingSystem  $system
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradingSystem $system)
    {
        $this->service->delete($system);

        return back();
    }

    /**
     * Get data for create and edit view
     *
     * @return mixed|array
     */
    private function getData()
    {
        $sessionId = $this->getCurrentSchoolSession();
        $semesters = $this->semesterService->getAllBySession($sessionId);
        $classes = $this->classService->getAllBySession($sessionId);

        return compact('sessionId', 'semesters', 'classes');
    }
}
