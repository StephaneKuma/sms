<?php

namespace App\Services\Repositories;

use App\Models\Syllabus;
use App\Repositories\SyllabusRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SyllabusContract;

class SyllabusService implements SyllabusContract
{
    /**
     * Create a new instance of the class.
     *
     * @param SyllabusRepository $repository
     */
    public function __construct(private SyllabusRepository $repository)
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
     * @param integer $currentSessionId
     * @param Syllabus $syllabus
     * @return bool
     */
    public function update(FormRequest $request, Syllabus $syllabus, int $currentSessionId)
    {
        return $this->repository->update($request, $syllabus, $currentSessionId);
    }

    /**
     * Delete the model from database.
     *
     * @param Syllabus $syllabus
     * @return bool|null
     */
    public function delete(Syllabus $syllabus)
    {
        return $this->repository->delete($syllabus);
    }
}
