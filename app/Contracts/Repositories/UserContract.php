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
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudents();

    /**
     * Get all the models from database whith the student role.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudentsByClassAndSection(int $sessionId, int $classId, int $sectionId);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param User $user
     * @return bool
     */
    public function update(FormRequest $request, User $user);

    /**
     * Delete the model from database.
     *
     * @param User $user
     * @return bool|null
     */
    public function delete(User $user);
}
