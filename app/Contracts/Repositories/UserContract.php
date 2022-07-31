<?php

namespace App\Contracts\Repositories;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

interface UserContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request);

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function createTeacher(FormRequest $request);

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function createStudent(FormRequest $request);

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll();

    /**
     * Get all the models from database whith the admin role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAdmins();

    /**
     * Get all the models from database whith the teacher role.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getTeachers();

    /**
     * Get all the models from database whith the student role.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudents(int $sessionId);

    /**
     * Get all the students by session
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    // public function getStudentsBySession(int $sessionId);

    /**
     * Get all the models with gender equals to M from database.
     *
     * @param array $ids
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getMaleStudents(array $ids);

    /**
     * Get all the models from database whith the student role.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getPromotionStudentsDataByClassAndSection(int $sessionId, int $classId, int $sectionId);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function update(FormRequest $request, User $user);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function updateTeacher(FormRequest $request, User $user);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function updateStudent(FormRequest $request, User $user);

    /**
     * Delete the model from database.
     *
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user);
}
