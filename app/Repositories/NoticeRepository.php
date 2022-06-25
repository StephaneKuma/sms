<?php

namespace App\Repositories;

use App\Models\Notice;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\NoticeContract;

class NoticeRepository implements NoticeContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        Notice::create($request->validated());

        toastr()->success('La notice a bien été créé.', 'Notices - Ecole');
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $sessionId)
    {
        return $this->getNoticesQuery($sessionId)->get();
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
        return $this->getNoticesQuery($sessionId)->simplePaginate($perPage);
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
        $status = $notice->update($request->validated());

        toastr()->success('La notice a bien été mise à jour.', 'Notices - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Notice $notice
     * @return bool|null
     */
    public function delete(Notice $notice)
    {
        $status = $notice->delete();

        toastr()->success('La notice a bien été supprimé.', 'Notices - Ecole');

        return $status;
    }

    /**
     * Return a query builder
     *
     * @param integer $sessionId
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function getNoticesQuery(int $sessionId)
    {
        return Notice::where('session_id', $sessionId)
            ->orderby('created_at', 'DESC');
    }
}
