<?php

namespace App\Contracts\Repositories;

use App\Models\ExamRule;
use Illuminate\Foundation\Http\FormRequest;

interface ExamRuleContract
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
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param ExamRule $rule
     * @return bool
     */
    public function update(FormRequest $request, ExamRule $rule);

    /**
     * Delete the model from database.
     *
     * @param ExamRule $rule
     * @return bool|null
     */
    public function delete(ExamRule $rule);
}
