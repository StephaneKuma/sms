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
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudents()
    {
        return $this->repository->getStudents();
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
