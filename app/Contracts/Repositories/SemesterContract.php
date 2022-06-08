<?php

namespace App\Contracts\Repositories;

use App\Models\Semester;
use Illuminate\Foundation\Http\FormRequest;

interface SemesterContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Semester $semester
     * @return bool
     */
    public function update(FormRequest $request, Semester $semester);

    /**
     * Delete the model from database.
     *
     * @param Semester $semester
     * @return bool|null
     */
    public function delete(Semester $semester);

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll();

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId);
}
