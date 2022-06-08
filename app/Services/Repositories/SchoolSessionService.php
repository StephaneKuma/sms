<?php

namespace App\Services\Repositories;

use App\Models\SchoolSession;
use Illuminate\Foundation\Http\FormRequest;
use App\Repositories\SchoolSessionRepository;
use App\Contracts\Repositories\SchoolSessionContract;

class SchoolSessionService implements SchoolSessionContract
{
    /**
     * Create a new instance of the class.
     *
     * @param SchoolSessionRepository $repository
     */
    public function __construct(private SchoolSessionRepository $repository)
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
     * Get the latest model from database.
     *
     * @return Object|SchoolSession
     */
    public function getLatest()
    {
        return $this->repository->getLatest();
    }

    /**
     * Get a model from database.
     *
     * @param integer $id
     * @return SchoolSession
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
     * Get the model before the last from database
     *
     * @return SchoolSession
     */
    public function getPrevious()
    {
        return $this->repository->getPrevious();
    }

    /**
     * Set model id in app session
     *
     * @param mixed $request
     * @return void
     */
    public function browse($request)
    {
        $this->repository->browse($request);
    }

    /**
     * Update the model in the database.
     *
     * @param FormRequest $request
     * @param SchoolSession $session
     * @return bool
     */
    public function update(FormRequest $request, SchoolSession $session)
    {
        return $this->repository->update($request, $session);
    }

    /**
     * Delete the model from database.
     *
     * @param SchoolSession $session
     * @return bool|null
     */
    public function delete(SchoolSession $session)
    {
        return $this->repository->delete($session);
    }
}
