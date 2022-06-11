<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\ExamRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\ExamRuleContract;

class ExamRuleRepository implements ExamRuleContract
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
        $status = false;

        ExamRule::create($validated);
        $status = true;

        toastr()->success('la condition de réussite de l\'examen a bien été créé', 'Conditions - Ecole');

        return $status;
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return ExamRule::all();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return ExamRule::with('session', 'exam')->where('session_id', $sessionId)->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param ExamRule $rule
     * @return bool
     */
    public function update(FormRequest $request, ExamRule $rule)
    {
        $validated = $request->validated();
        $status = false;

        $_status = $rule->update($validated);
        $status = $_status;

        toastr()->success('la condition de réussite de l\'examen a bien été mise à jour', 'Conditions - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param ExamRule $rule
     * @return bool|null
     */
    public function delete(ExamRule $rule)
    {
        $status = $rule->delete();

        toastr()->success('la condition de réussite de l\'examen a bien été supprimé', 'Conditions - Ecole');

        return $status;
    }
}
