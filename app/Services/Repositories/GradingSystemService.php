<?php

namespace App\Services\Repositories;

use App\Models\GradingSystem;
use App\Repositories\GradingSystemRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\GradingSystemContract;

class GradingSystemService implements GradingSystemContract
{
    /**
     * Create a new instance of the class.
     *
     * @param GradingSystemRepository $repository
     */
    public function __construct(private GradingSystemRepository $repository)
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
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $semesterId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySemester(int $sessionId, int $semesterId)
    {
        return $this->repository->getAllBySemester($sessionId, $semesterId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param GradingSystem $system
     * @return bool
     */
    public function update(FormRequest $request, GradingSystem $system)
    {
        return $this->repository->update($request, $system);
    }

    /**
     * Delete the model from database.
     *
     * @param GradingSystem $system
     * @return bool|null
     */
    public function delete(GradingSystem $system)
    {
        return $this->repository->delete($system);
    }
}
