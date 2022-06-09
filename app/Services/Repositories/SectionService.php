<?php

namespace App\Services\Repositories;

use App\Models\Section;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SectionContract;
use App\Repositories\SectionRepository;

class SectionService implements SectionContract
{
    /**
     * Create a new instance of the class
     *
     * @param SectionRepository $repository
     */
    public function __construct(private SectionRepository $repository)
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
     * Get all the models from database by schoom class
     *
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllByClass(int $classId)
    {
        return $this->repository->getAllByClass($classId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Section $section
     * @param integer $currentSessionId
     * @return bool
     */
    public function update(FormRequest $request, Section $section, int $currentSessionId)
    {
        return $this->repository->update($request, $section, $currentSessionId);
    }

    /**
     * Delete the model from database.
     *
     * @param Section $section
     * @return bool|null
     */
    public function delete(Section $section) {
        return $this->repository->delete($section);
    }
}
