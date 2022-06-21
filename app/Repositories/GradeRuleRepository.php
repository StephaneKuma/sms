<?php

namespace App\Repositories;

use App\Models\Exam;
use App\Models\GradeRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\GradeRuleContract;

class GradeRuleRepository implements GradeRuleContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request)
    {
        $validated = $request->validated();
        // dd($validated);
        $status = false;

        GradeRule::create($validated);
        $status = true;

        toastr()->success('La règle de graduation a bien été créée', 'Règles de graduation - Ecole');

        return $status;
    }

    /**
     * Get all the models from database.
     *
     * @param integer $systemId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $systemId)
    {
        return GradeRule::where('system_id', $systemId)->get();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $systemId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId, int $systemId)
    {
        return GradeRule::with('session', 'system')
            ->where('session_id', $sessionId)
            ->where('system_id', $systemId)->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param GradeRule $rule
     * @return bool
     */
    public function update(FormRequest $request, GradeRule $rule)
    {
        $validated = $request->validated();
        $status = false;

        $_status = $rule->update($validated);
        $status = $_status;

        toastr()->success('La règle de graduation a bien été mise à jour', 'Règles de graduation - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param GradeRule $rule
     * @return bool|null
     */
    public function delete(GradeRule $rule)
    {
        $status = $rule->delete();

        toastr()->success('La règle de graduation a bien été supprimée.', 'Règles de graduation - Ecole');

        return $status;
    }
}
