<?php

namespace App\Services\Repositories;

use App\Models\Routine;
use App\Repositories\RoutineRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\RoutineContract;

class RoutineService implements RoutineContract
{
    /**
     * Create a new instance of the class
     *
     * @param RoutineRepository $repository
     */
    public function __construct(private RoutineRepository $repository)
    {
    }

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
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, Routine>
     */
    public function getAll(int $sessionId, int $classId, int $sectionId)
    {
        return $this->repository->getAll($sessionId, $classId, $sectionId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Routine $routine
     * @return bool
     */
    public function update(FormRequest $request, Routine $routine)
    {
        return $this->repository->update($request, $routine);
    }

    /**
     * Delete the model from database.
     *
     * @param Routine $routine
     * @return bool|null
     */
    public function delete(Routine $routine)
    {
        return $this->repository->delete($routine);
    }
}
