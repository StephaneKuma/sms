<?php

namespace App\Contracts\Repositories;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

interface CourseContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request);

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll();

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Course $course
     * @return bool
     */
    public function update(FormRequest $request, Course $course);

    /**
     * Delete the model from database.
     *
     * @param Course $course
     * @return bool|null
     */
    public function delete(Course $course);
}
