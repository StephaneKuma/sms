<?php

namespace App\Services\Repositories;

use App\Models\Course;
use App\Repositories\CourseRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\CourseContract;

class CourseService implements CourseContract
{
    /**
     * Create a new instance of the class.
     *
     * @param CourseRepository $repository
     */
    public function __construct(private CourseRepository $repository)
    {}

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @param integer $currentSessionId
     * @return bool
     */
    public function create(FormRequest $request, int $currentSessionId)
    {
        return $this->repository->create($request, $currentSessionId);
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
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return $this->repository->getAllBySession($sessionId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Course $course
     * @param integer $currentSessionId
     * @return bool
     */
    public function update(FormRequest $request, Course $course, int $currentSessionId)
    {
        return $this->repository->update($request, $course, $currentSessionId);
    }

    /**
     * Delete the model from database.
     *
     * @param Course $course
     * @return bool|null
     */
    public function delete(Course $course)
    {
        return $this->repository->delete($course);
    }
}
