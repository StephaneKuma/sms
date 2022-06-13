<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\GradingSystem;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\GradingSystemContract;

class GradingSystemRepository implements GradingSystemContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request)
    {
        $validated =$request->validated();
        $status = false;

        GradingSystem::create($validated);
        $status = true;

        toastr()->success('Le système de graduation a bien été créé', 'Systèmes de graduation - Ecole');

        return $status;
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return GradingSystem::all();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return $this->getBySession($sessionId)->get();
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
        return $this->getBySession($sessionId)
            ->where('semester_id', $semesterId)
            ->get();
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
        $validated =$request->validated();
        $status = false;

        $_status = $system->update($validated);
        $status = $_status;

        toastr()->success('Le système de graduation a bien été mise à jour', 'Systèmes de graduation - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param GradingSystem $system
     * @return bool|null
     */
    public function delete(GradingSystem $system)
    {
        $status = $system->delete();

        toastr()->success('Le système de graduation a bien été supprimé', 'Systèmes de graduation - Ecole');

        return $status;
    }

    /**
     * Filter models by session and return a query builder
     *
     * @param integer $sessionId
     * @return Illuminate\Database\Eloquent\Builder
     */
    private function getBySession(int $sessionId)
    {
        return GradingSystem::with('session', 'semester', 'class')
            ->where('session_id', $sessionId);
    }
}
