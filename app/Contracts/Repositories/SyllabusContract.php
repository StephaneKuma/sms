<?php

namespace App\Contracts\Repositories;

use App\Models\Syllabus;
use Illuminate\Foundation\Http\FormRequest;

interface SyllabusContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @param integer $currentSessionId
     * @return bool
     */
    public function create(FormRequest $request, int $currentSessionId);

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
     * @param integer $currentSessionId
     * @param Syllabus $syllabus
     * @return bool
     */
    public function update(FormRequest $request, Syllabus $syllabus, int $currentSessionId);

    /**
     * Delete the model from database.
     *
     * @param Syllabus $syllabus
     * @return bool|null
     */
    public function delete(Syllabus $syllabus);
}
