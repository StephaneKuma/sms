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
     * @return bool
     */
    public function create(FormRequest $request)
    {
        return $this->repository->create($request);
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
     * @param Syllabus $syllabus
     * @return bool
     */
    public function update(FormRequest $request, Syllabus $syllabus)
    {
        return $this->repository->update($request, $syllabus);
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
