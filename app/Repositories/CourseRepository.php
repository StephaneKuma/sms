<?php

namespace App\Repositories;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\CourseContract;

class CourseRepository implements CourseContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request)
    {
        $validated = $request->validated();
        $status = false;

        Course::create($validated);
        $status = true;

        toastr()->success('Le cours a bien été créé', 'Cours - Ecole');

        return $status;
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return Course::all();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return Course::with('session', 'semester', 'class')->where('session_id', $sessionId)->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Course $course
     * @return bool
     */
    public function update(FormRequest $request, Course $course)
    {
        $validated = $request->validated();
        $status = false;

        $_status = $course->update($validated);
        $status = $_status;

        toastr()->success('Le cours a bien été mise à jour', 'Cours - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Course $course
     * @return bool|null
     */
    public function delete(Course $course)
    {
        $status = $course->delete();

        toastr()->success('Le cours a bien été supprimé', 'Cours - Ecole');

        return $status;
    }
}
