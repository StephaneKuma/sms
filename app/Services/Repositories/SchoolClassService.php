<?php

namespace App\Services\Repositories;

use App\Models\SchoolClass;
use App\Repositories\SchoolClassRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SchoolClassContract;

class SchoolClassService implements SchoolClassContract
{
    /**
     * Create a new instance of the class.
     *
     * @param SchoolClassRepository $repository
     */
    public function __construct(private SchoolClassRepository $repository)
    {
    }

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
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getById(int $id)
    {
        return $this->repository->getById($id);
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
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return $this->repository->getAllBySession($sessionId);
    }

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithCoursesBySession(int $sessionId)
    {
        return $this->repository->getAllWithCoursesBySession($sessionId);
    }

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithSectionsAndCoursesAndSyllabiBySession(int $sessionId)
    {
        return $this->repository->getAllWithSectionsAndCoursesAndSyllabiBySession($sessionId);
    }

    /**
     * get all the model from database by class id.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @return \Illuminate\Http\Response
     */
    public function getSectionsAndCoursesByClassId(int $sessionId, int $classId)
    {
        return $this->repository->getSectionsAndCoursesByClassId($sessionId, $classId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param SchoolClass $class
     * @return bool
     */
    public function update(FormRequest $request, SchoolClass $class)
    {
        return $this->repository->update($request, $class);
    }

    /**
     * Delete the model from database.
     *
     * @param SchoolClass $class
     * @return bool|null
     */
    public function delete(SchoolClass $class)
    {
        return $this->repository->delete($class);
    }
}
