<?php

namespace App\Http\Controllers;

use App\Models\ExamRule;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreExamRuleRequest;
use App\Contracts\Repositories\ExamContract;
use App\Http\Requests\UpdateExamRuleRequest;
use App\Contracts\Repositories\ExamRuleContract;
use App\Contracts\Repositories\SchoolSessionContract;

class ExamRuleController extends Controller
{
    use SchoolSession;

    public function __construct(private ExamRuleContract $service,
        private SchoolSessionContract $sessionService,
        private ExamContract $examService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rules = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('exams.rules.index', compact('rules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessionId = $this->getCurrentSchoolSession();
        $exams = $this->examService->getAllBySession($sessionId);

        return view('exams.rules.form', compact('sessionId', 'exams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreExamRuleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreExamRuleRequest $request)
    {
        $this->service->create($request);

        return redirect()->route('school.exams.rules.index');
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
    public function edit(ExamRule $rule)
    {
        $sessionId = $this->getCurrentSchoolSession();
        $exams = $this->examService->getAllBySession($sessionId);

        return view('exams.rules.form', compact('rule', 'sessionId', 'exams'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateExamRuleRequest  $request
     * @param  \App\Models\ExamRule  $rule
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateExamRuleRequest $request, ExamRule $rule)
    {
        $this->service->update($request, $rule);

        return redirect()->route('school.exams.rules.index');
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
