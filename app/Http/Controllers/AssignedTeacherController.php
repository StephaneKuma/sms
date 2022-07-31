<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAssignedTeacherRequest;
use Illuminate\Http\Request;
use App\Models\AssignedTeacher;
use App\Services\Repositories\AssignedTeacherService;

class AssignedTeacherController extends Controller
{
    /**
     * Create a new instance of the class
     *
     * @param AssignedTeacherService $service
     */
    public function __construct(private AssignedTeacherService $service)
    {
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreAssignedTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignedTeacherRequest $request)
    {
        $this->service->create($request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function show(AssignedTeacher $assignedTeacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function edit(AssignedTeacher $assignedTeacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  StoreAssignedTeacherRequest  $request
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AssignedTeacher $assignedTeacher)
    {
        $this->service->update($request, $assignedTeacher);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AssignedTeacher  $assignedTeacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(AssignedTeacher $assignedTeacher)
    {
        $this->service->delete($assignedTeacher);

        return back();
    }
}
