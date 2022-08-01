<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\AssignmentContract;
use App\Http\Requests\StoreAssignmentRequest;
use App\Models\AssignedTeacher;
use App\Models\Assignment;
use Illuminate\Http\Request;

class AssignmentController extends Controller
{
    /**
     * Create a new instance of the class
     *
     * @param AssignmentContract $service
     */
    public function __construct(private AssignmentContract $service)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @param AssignedTeacher $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function index(AssignedTeacher $assignedTeacher)
    {
        $assignments = $this->service->getAllBySessionAndCourse($assignedTeacher->session_id, $assignedTeacher->course_id);

        return view('assignments.index', compact('assignments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param AssignedTeacher $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function create(AssignedTeacher $assignedTeacher)
    {
        return view('assignments.form', compact('assignedTeacher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AssignedTeacher $assignedTeacher
     * @param  StoreAssignmentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignmentRequest $request, AssignedTeacher $assignedTeacher)
    {
        $this->service->create($request);

        $teacher = $assignedTeacher->teacher;

        return redirect()->route('school.teacher.courses', $teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show(Assignment $assignment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
