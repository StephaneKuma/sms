<?php

namespace App\Services\Repositories;

use App\Models\AssignedTeacher;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\AssignedTeacherRepository;
use App\Contracts\Repositories\AssignedTeacherContract;

class AssignedTeacherService implements AssignedTeacherContract
{
    /**
     * Create a new instance of the class
     *
     * @param AssignedTeacherRepository $repository
     */
    public function __construct(private AssignedTeacherRepository $repository)
    {
    }

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request): bool
    {
        return $this->repository->create($request);
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAll()
    {
        return $this->repository->getAll();
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
        return $this->repository->getAllByClassId($sessionId, $classId);
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getAllBySession(int $sessionId)
    {
        return $this->repository->getAllBySession($sessionId);
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $teacherId
     * @param integer $semesterId
     * @return \Illuminate\Database\Eloquent\Collection<int, AssignedTeacher>
     */
    public function getTeacherData(int $sessionId, int $teacherId, int $semesterId)
    {
        return $this->repository->getTeacherData($sessionId, $teacherId, $semesterId);
    }

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
    public function getAssignedTeacher(int $sessionId, int $semesterId, int $classId, int $sectionId, int $courseId): AssignedTeacher|null
    {
        return $this->repository->getAssignedTeacher($sessionId, $semesterId, $classId, $sectionId, $courseId);
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
        return $this->repository->update($request, $assignedTeacher);
    }

    /**
     * Delete the model from database.
     *
     * @param AssignedTeacher $assignedTeacher
     * @return bool|null
     */
    public function delete(AssignedTeacher $assignedTeacher): bool|null
    {
        return $this->repository->delete($assignedTeacher);
    }
}
