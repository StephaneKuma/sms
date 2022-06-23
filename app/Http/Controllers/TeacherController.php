<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\SchoolSessionContract;
use App\Contracts\Repositories\UserContract;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\User;
use App\Traits\SchoolSession;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class TeacherController extends Controller
{
    use SchoolSession;

    public function __construct(private UserContract $service,
        private SchoolSessionContract $sessionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = $this->service->getTeachers();
        return view('teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create users'), 403, "Vous n'êtes pas autorisé(e) à effectuer cette action. Veuillez contacter l'administrateur.");
        
        $role = Role::where('name', 'teacher')->first();

        return view('teachers.form', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreTeacherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $this->service->createTeacher($request);

        return redirect()->route('school.teachers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(User $teacher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(User $teacher)
    {
        abort_if(!auth()->user()->can('create users'), 403, "Vous n'êtes pas autorisé(e) à effectuer cette action. Veuillez contacter l'administrateur.");

        $role = Role::where('name', 'teacher')->first();

        return view('teachers.form', compact('teacher', 'role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateTeacherRequest  $request
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, User $teacher)
    {
        $this->service->updateTeacher($request, $teacher);

        return redirect()->route('school.teachers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $teacher)
    {
        //
    }
}
