<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\SchoolClassContract;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Contracts\Repositories\UserContract;
use App\Contracts\Repositories\SchoolSessionContract;

class StudentController extends Controller
{
    use SchoolSession;

    public function __construct(private UserContract $service,
        private SchoolSessionContract $sessionService,
        private SchoolClassContract $classService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classId = $request->query('class_id', 0);
        $sectionId = $request->query('section_id', 0);

        $sessionId = $this->getCurrentSchoolSession();
        $classes = $this->classService->getAllBySession($sessionId);

        $promotionData = $this->service->getPromotionStudentsDataByClassAndSection($sessionId, $classId, $sectionId);

        return view('students.index', compact('classes', 'promotionData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create users'), 403, "Vous n'êtes pas autorisé(e) à effectuer cette action. Veuillez contacter l'administrateur.");

        $role = Role::where('name', 'student')->first();

        return view('students.form', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStudentRequest $request)
    {
        $this->service->createTeacher($request);

        return redirect()->route('school.students.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function show(User $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        abort_if(!auth()->user()->can('create users'), 403, "Vous n'êtes pas autorisé(e) à effectuer cette action. Veuillez contacter l'administrateur.");

        $role = Role::where('name', 'student')->first();

        return view('students.form', compact('student', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateStudentRequest  $request
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, User $student)
    {
        $this->service->updateTeacher($request, $student);

        return redirect()->route('school.students.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $student)
    {
        //
    }
}
