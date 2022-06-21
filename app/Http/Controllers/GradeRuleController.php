<?php

namespace App\Http\Controllers;

use App\Models\GradeRule;
use App\Models\GradingSystem;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreGradeRuleRequest;
use App\Http\Requests\UpdateGradeRuleRequest;
use App\Contracts\Repositories\GradeRuleContract;
use App\Contracts\Repositories\SchoolSessionContract;

class GradeRuleController extends Controller
{
    use SchoolSession;

    public function __construct(private GradeRuleContract $service,
        private SchoolSessionContract $sessionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GradingSystem $system)
    {
        $rules = $this->service->getAllBySession($this->getCurrentSchoolSession(), $system->id);

        return view('exams.grades.rules.index', compact('system', 'rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Exam $system
     * @return \Illuminate\Http\Response
     */
    public function create(GradingSystem $system)
    {
        $sessionId = $this->getCurrentSchoolSession();

        return view('exams.grades.rules.form', compact('sessionId', 'system'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Exam  $system
     * @param  StoreGradeRuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GradingSystem $system, StoreGradeRuleRequest $request)
    {
        $this->service->create($request);

        return redirect()->route('school.exams.grading.systems.index', $system);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GradeRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(GradeRule $rule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GradeRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(GradingSystem $system, GradeRule $rule)
    {
        $sessionId = $this->getCurrentSchoolSession();

        return view('exams.grades.rules.form', compact('rule', 'sessionId', 'system'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Exam  $system
     * @param  UpdateGradeRuleRequest  $request
     * @param  \App\Models\GradeRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(GradingSystem $system, UpdateGradeRuleRequest $request, GradeRule $rule)
    {
        $this->service->update($request, $rule);

        return redirect()->route('school.exams.grading.systems.index', $system);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GradeRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(GradeRule $rule)
    {
        $this->service->delete($rule);

        return back();
    }
}
