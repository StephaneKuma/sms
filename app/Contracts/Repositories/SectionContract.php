<?php

namespace App\Contracts\Repositories;

use App\Models\Section;
use Illuminate\Foundation\Http\FormRequest;

interface SectionContract
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
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId);

    /**
     * Get all the models from database by schoom class
     *
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllByClass(int $classId);

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Section $section
     * @param integer $currentSessionId
     * @return bool
     */
    public function update(FormRequest $request, Section $section, int $currentSessionId);

    /**
     * Delete the model from database.
     *
     * @param Section $section
     * @return bool|null
     */
    public function delete(Section $section);
}
