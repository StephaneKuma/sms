<?php

namespace App\Contracts\Repositories;

use App\Models\Notice;
use Illuminate\Foundation\Http\FormRequest;

interface NoticeContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request);

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $sessionId);

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $perPage
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithPagination(int $sessionId, int $perPage);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Notice $notice
     * @return bool
     */
    public function update(FormRequest $request, Notice $notice);

    /**
     * Delete the model from database.
     *
     * @param Notice $notice
     * @return bool|null
     */
    public function delete(Notice $notice);
}
