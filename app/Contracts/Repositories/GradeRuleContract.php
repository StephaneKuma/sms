<?php

namespace App\Contracts\Repositories;

use App\Models\GradeRule;
use Illuminate\Foundation\Http\FormRequest;

interface GradeRuleContract
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
     * @param integer $systemId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $systemId);

    /**
     * Get all the models from database.
     *
     * @param integer $systemId
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId, int $systemId);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param GradeRule $rule
     * @return bool
     */
    public function update(FormRequest $request, GradeRule $rule);

    /**
     * Delete the model from database.
     *
     * @param GradeRule $rule
     * @return bool|null
     */
    public function delete(GradeRule $rule);
}
