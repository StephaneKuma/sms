<?php

namespace App\Repositories;

use App\Models\Assignment;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\AssignmentContract;

class AssignmentRepository implements AssignmentContract
{
    /**
     * Create a new instance of the model
     *
     * @param FormRequest $request
     * @return boolean
     */
    public function create(FormRequest $request): bool
    {
        $validated = $request->validated();

        $file = $validated['path'];
        $path = $file->store('assignments', 'public');

        Assignment::create([
            'session_id' => $validated['session_id'],
            'semester_id' => $validated['semester_id'],
            'class_id' => $validated['class_id'],
            'section_id' => $validated['section_id'],
            'course_id' => $validated['course_id'],
            'teacher_id' => $validated['teacher_id'],
            'name' => $validated['name'],
            'path' => $path,
        ]);

        toastr()->success("Le devoir a bien été créé", "Devoirs - Ecole");

        return true;
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAll()
    {
        return Assignment::all();
    }

    /**
     * Get all the models from database based on the session id provided.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAllBySession(int $sessionId)
    {
        return Assignment::where('session_id', $sessionId)->get();
    }

    /**
     * Get all the models from database based on the session id provided.
     *
     * @param integer $sessionId
     * @param integer $courseId
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAllBySessionAndCourse(int $sessionId, int $courseId)
    {
        return Assignment::where('session_id', $sessionId)
            ->where('course_id', $courseId)
            ->get();
    }
}
