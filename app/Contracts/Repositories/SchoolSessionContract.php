<?php

namespace App\Contracts\Repositories;

use App\Models\SchoolSession;
use Illuminate\Foundation\Http\FormRequest;

interface SchoolSessionContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request);

    /**
     * Get the latest model from database.
     *
     * @return Object|SchoolSession
     */
    public function getLatest();

    /**
     * Get a model from database.
     *
     * @param integer $id
     * @return SchoolSession
     */
    public function getById(int $id);

    /**
     * Get the model before the last from database
     *
     * @return SchoolSession
     */
    public function getPrevious();

    /**
     * Set model id in app session
     *
     * @param mixed $request
     * @return void
     */
    public function browse($request);

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll();

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithClassesAndCourses();

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param SchoolSession $session
     * @return bool
     */
    public function update(FormRequest $request, SchoolSession $session);

    /**
     * Delete the model from database.
     *
     * @param SchoolSession $session
     * @return bool|null
     */
    public function delete(SchoolSession $session);
}
