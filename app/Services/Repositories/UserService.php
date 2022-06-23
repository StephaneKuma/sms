<?php

namespace App\Services\Repositories;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\UserContract;

class UserService implements UserContract
{
    /**
     * Create a new instance of the class
     *
     * @param UserRepository $repository
     */
    public function __construct(private UserRepository $repository)
    {}

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        $this->repository->create($request);
    }

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function createTeacher(FormRequest $request)
    {
        $this->repository->createTeacher($request);
    }

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function createStudent(FormRequest $request)
    {
        $this->repository->createStudent($request);
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Get all the models from database whith the admin role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAdmins()
    {
        return $this->repository->getAdmins();
    }

    /**
     * Get all the models from database whith the teacher role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getTeachers()
    {
        return $this->repository->getTeachers();
    }

    /**
     * Get all the models from database whith the student role.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudents(int $sessionId)
    {
        return $this->repository->getStudents($sessionId);
    }

    /**
     * Get all the models with gender equals to M from database.
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getMaleStudents(array $ids)
    {
        return $this->repository->getMaleStudents($ids);
    }

    /**
     * Get all the models from database whith the student role.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudentsByClassAndSection(int $sessionId, int $classId, int $sectionId)
    {
        return $this->repository->getStudentsByClassAndSection($sessionId, $classId, $sectionId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function update(FormRequest $request, User $user)
    {
        return $this->repository->update($request, $user);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $teacher
     * @return bool
     */
    public function updateTeacher(FormRequest $request, User $teacher)
    {
        return $this->repository->updateTeacher($request, $teacher);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $student
     * @return bool
     */
    public function updateStudent(FormRequest $request, User $student)
    {
        return $this->repository->updateStudent($request, $student);
    }

    /**
     * Delete the model from database.
     *
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user)
    {
        return $this->repository->delete($user);
    }
}
