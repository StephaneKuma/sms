<?php

namespace App\Services\Repositories;

use App\Models\Semester;
use App\Repositories\SemesterRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SemesterContract;

class SemesterService implements SemesterContract
{
    /**
     * Create a new instance of the class.
     *
     * @param SemesterRepository $repository
     */
    public function __construct(private SemesterRepository $repository)
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
     * Get all the models from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Get all of the models from the database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return $this->repository->getAllBySession($sessionId);
    }

    /**
     * Update the model in the database.
     *
     * @param FormRequest $request
     * @param Semester $semester
     * @return bool
     */
    public function update(FormRequest $request, Semester $semester)
    {
        return $this->repository->update($request, $semester);
    }

    /**
     * Delete the model from the database.
     *
     * @param Semester $semester
     * @return bool|null
     */
    public function delete(Semester $semester)
    {
        return $this->repository->delete($semester);
    }
}
