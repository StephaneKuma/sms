<?php

namespace App\Contracts\Repositories;

use App\Models\Routine;
use Illuminate\Foundation\Http\FormRequest;

interface RoutineContract
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
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, Routine>
     */
    public function getAll(int $sessionId,int $classId, int $sectionId);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Routine $routine
     * @return bool
     */
    public function update(FormRequest $request, Routine $routine);

    /**
     * Delete the model from database.
     *
     * @param Routine $routine
     * @return bool|null
     */
    public function delete(Routine $routine);
}
