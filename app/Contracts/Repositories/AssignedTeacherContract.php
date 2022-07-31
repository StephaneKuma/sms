<?php

namespace App\Contracts\Repositories;

use App\Models\AssignedTeacher;
use Illuminate\Foundation\Http\FormRequest;

interface AssignedTeacherContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request): bool;

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAll();

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAllByClassId(int $sessionId, int $classId);

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAllBySession(int $sessionId);

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $teacherId
     * @param integer $semesterId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getTeacherData(int $sessionId, int $teacherId, int $semesterId);

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $semesterId
     * @param integer $classId
     * @param integer $sectionId
     * @param integer $courseId
     * @return AssignedTeacher|null
     */
    public function getAssignedTeacher(int $sessionId, int $semesterId, int $classId, int $sectionId, int $courseId): AssignedTeacher|null;

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param AssignedTeacher $assignedTeacher
     * @return bool
     */
    public function update(FormRequest $request, AssignedTeacher $assignedTeacher): bool;

    /**
     * Delete the model from database.
     *
     * @param AssignedTeacher $assignedTeacher
     * @return bool|null
     */
    public function delete(AssignedTeacher $assignedTeacher): bool|null;
}
