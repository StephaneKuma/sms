<?php

namespace App\Contracts\Repositories;

use App\Models\SchoolClass;
use Illuminate\Foundation\Http\FormRequest;

interface SchoolClassContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param SchoolClass $class
     * @return bool
     */
    public function update(FormRequest $request, SchoolClass $class);

    /**
     * Delete the model from database.
     *
     * @param SchoolClass $class
     * @return bool|null
     */
    public function delete(SchoolClass $class);

    /**
     * Get all the models from database.
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getById(int $id);

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll();

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId);

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithCoursesBySession(int $sessionId);

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithSectionsAndCoursesAndSyllabiBySession(int $sessionId);
}
