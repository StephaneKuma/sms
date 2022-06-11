<?php

namespace App\Http\Controllers;

use App\Models\ExamRule;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreExamRuleRequest;
use App\Http\Requests\UpdateExamRuleRequest;
use App\Contracts\Repositories\ExamRuleContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Models\Exam;

class ExamRuleController extends Controller
{
    use SchoolSession;

    public function __construct(private ExamRuleContract $service,
        private SchoolSessionContract $sessionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Exam $exam)
    {
        $rules = $this->service->getAllBySession($this->getCurrentSchoolSession(), $exam->id);

        return view('exams.rules.index', compact('exam', 'rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Exam $exam
     * @return \Illuminate\Http\Response
     */
    public function create(Exam $exam)
    {
        $sessionId = $this->getCurrentSchoolSession();

        return view('exams.rules.form', compact('sessionId', 'exam'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Models\Exam  $exam
     * @param  StoreExamRuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Exam $exam, StoreExamRuleRequest $request)
    {
        $this->service->create($request);

        return redirect()->route('school.exams.rules.index', $exam);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ExamRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function show(ExamRule $rule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ExamRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam, ExamRule $rule)
    {
        $sessionId = $this->getCurrentSchoolSession();

        return view('exams.rules.form', compact('rule', 'sessionId', 'exam'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Exam  $exam
     * @param  UpdateExamRuleRequest  $request
     * @param  \App\Models\ExamRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(Exam $exam, UpdateExamRuleRequest $request, ExamRule $rule)
    {
        $this->service->update($request, $rule);

        return redirect()->route('school.exams.rules.index', $exam);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ExamRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExamRule $rule)
    {
        $this->service->delete($rule);

        return back();
    }
}
