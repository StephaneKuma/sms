<?php

namespace App\Contracts\Repositories;

use App\Models\Assignment;
use Illuminate\Foundation\Http\FormRequest;

interface AssignmentContract
{
    /**
     * Create a new instance of the model
     *
     * @param FormRequest $request
     * @return boolean
     */
    public function create(FormRequest $request): bool;

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAll();
    
    /**
     * Get all the models from database based on the session id provided.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAllBySession(int $sessionId);
    
    /**
     * Get all the models from database based on the session id provided.
     *
     * @param integer $sessionId
     * @param integer $courseId
     * @return \Illuminate\Database\Eloquent\Collection<int, Assignment>
     */
    public function getAllBySessionAndCourse(int $sessionId, int $courseId);
}
