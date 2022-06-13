<?php

namespace App\Contracts\Repositories;

use App\Models\GradingSystem;
use Illuminate\Foundation\Http\FormRequest;

interface GradingSystemContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request);

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll();

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId);

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $semesterId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySemester(int $sessionId, int $semesterId);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param GradingSystem $system
     * @return bool
     */
    public function update(FormRequest $request, GradingSystem $system);

    /**
     * Delete the model from database.
     *
     * @param GradingSystem $system
     * @return bool|null
     */
    public function delete(GradingSystem $system);
}
