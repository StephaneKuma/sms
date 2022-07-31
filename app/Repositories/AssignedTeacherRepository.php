<?php

namespace App\Repositories;

use App\Models\AssignedTeacher;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\AssignedTeacherContract;
use App\Models\Semester;

class AssignedTeacherRepository implements AssignedTeacherContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request): bool
    {
        AssignedTeacher::create($request->validated());

        toastr()->success('L\'enseignant a bien été assigné', 'Paramètres - Ecole');

        return true;
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAll()
    {
        return AssignedTeacher::all();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAllByClassId(int $sessionId, int $classId)
    {
        return AssignedTeacher::where('session_id', $sessionId)
            ->where('class_id', $classId)
            ->get();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAllBySession(int $sessionId)
    {
        return AssignedTeacher::where('session_id', $sessionId)->get();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $teacherId
     * @param integer $semesterId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getTeacherCourses(int $sessionId, int $teacherId, int $semesterId)
    {
        if ($semesterId == 0) {
            $semesterId = Semester::where('session_id', $sessionId)
                ->first()
                ->id;
        }

        return AssignedTeacher::with(['course', 'class', 'section'])
            ->where('session_id', $sessionId)
            ->where('teacher_id', $teacherId)
            ->where('semester_id', $semesterId)
            ->get();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $semesterId
     * @param integer $classId
     * @param integer $sectionId
     * @param integer $courseId
     * @return AssignedTeacher
     */
    public function getAssignedTeacher(int $sessionId, int $semesterId, int $classId, int $sectionId, int $courseId): AssignedTeacher
    {
        if ($semesterId == 0) {
            $semesterId = Semester::where('session_id', $sessionId)
                ->first()
                ->id;
        }

        return AssignedTeacher::with(['course', 'class', 'section'])
            ->where('session_id', $sessionId)
            ->where('semester_id', $semesterId)
            ->where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->where('course_id', $courseId)
            ->first();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param AssignedTeacher $assignedTeacher
     * @return bool
     */
    public function update(FormRequest $request, AssignedTeacher $assignedTeacher): bool
    {
        $status = $assignedTeacher->update($request->validated());

        toastr()->success('L\assignation de l\'enseignanta bien été mise à jour', 'Paramètres - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param AssignedTeacher $assignedTeacher
     * @return bool|null
     */
    public function delete(AssignedTeacher $assignedTeacher): bool|null
    {
        $status = $assignedTeacher->delete();

        toastr()->success("L'assignation de l'enseignant a bien été supprimée", 'Paramètres - Ecole');

        return $status;
    }
}
