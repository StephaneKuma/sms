<?php

namespace App\Services\Repositories;

use App\Models\Notice;
use App\Repositories\NoticeRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\NoticeContract;

class NoticeService implements NoticeContract
{
    public function __construct(private NoticeRepository $repository)
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
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $sessionId)
    {
        return $this->repository->getAll($sessionId);
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $perPage
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithPagination(int $sessionId, int $perPage)
    {
        return $this->repository->getAllWithPagination($sessionId, $perPage);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Notice $notice
     * @return bool
     */
    public function update(FormRequest $request, Notice $notice)
    {
        return $this->repository->update($request, $notice);
    }

    /**
     * Delete the model from database.
     *
     * @param Notice $notice
     * @return bool|null
     */
    public function delete(Notice $notice)
    {
        return $this->repository->delete($notice);
    }
}
