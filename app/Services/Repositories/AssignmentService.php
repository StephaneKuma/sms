<?php

namespace App\Services\Repositories;

use App\Models\Assignment;
use App\Repositories\AssignmentRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\AssignmentContract;

class AssignmentService implements AssignmentContract
{
    /**
     * Create a new instance of the model
     *
     * @param AssignmentRepository $repository
     */
    public function __construct(private AssignmentRepository $repository)
    {
    }

    /**
     * Create a new instance of the model
     *
     * @param FormRequest $request
     * @return boolean
     */
    public function create(FormRequest $request): bool
    {
        return $this->repository->create($request);
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Get all the models from database based on the session id provided.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAllBySession(int $sessionId)
    {
        return $this->repository->getAllBySession($sessionId);
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
        return $this->repository->getAllBySessionAndCourse($sessionId, $courseId);
    }
}
