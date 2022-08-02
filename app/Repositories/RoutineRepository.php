<?php

namespace App\Repositories;

use App\Models\Routine;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\RoutineContract;

class RoutineRepository implements RoutineContract
{
/**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request)
    {
        Routine::create($request->validated());

        toastr()->success("La routine a bien été créée", 'Routines - Ecole');

        return true;
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, Routine>
     */
    public function getAll(int $sessionId,int $classId, int $sectionId)
    {
        return Routine::with('course')
            ->where('session_id', $sessionId)
            ->where('class_id', $classId)
            ->where('section_id', $sectionId)
            ->get();
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
        $status = $routine->update($request->validated());

        toastr()->success("La routine a bien été mise à jour", 'Routines - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Routine $routine
     * @return bool|null
     */
    public function delete(Routine $routine)
    {
        $status = $routine->delete();

        toastr()->success("La routine a bien été supprimée", 'Routines - Ecole');

        return $status;
    }
}
