<?php

namespace App\Contracts\Repositories;

use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;

interface ExamContract
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
     * @param Exam $exam
     * @return bool
     */
    public function update(FormRequest $request, Exam $exam);

    /**
     * Delete the model from database.
     *
     * @param Exam $exam
     * @return bool|null
     */
    public function delete(Exam $exam);
}
