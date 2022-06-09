<?php

namespace App\Repositories;

use App\Contracts\Repositories\SchoolClassContract;
use App\Models\SchoolClass;
use Illuminate\Foundation\Http\FormRequest;

class SchoolClassRepository implements SchoolClassContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        try {
            SchoolClass::create($request->validated());

            toastr()->success('La classe a bien été créée', 'Classes - Ecole');
        } catch (\Exception $ex) {
            toastr()->error('Ooops!!! Nous n\'avons pas pu créer la classe', 'Classes - Ecole');
        }
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return SchoolClass::with('session')->get();
    }

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return SchoolClass::with('session')
            ->where('session_id', $sessionId)
            ->get();
    }

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllWithCoursesBySession(int $sessionId)
    {
        return SchoolClass::with('session', 'courses')
            ->where('session_id', $sessionId)
            ->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param SchoolClass $class
     * @return bool
     */
    public function update(FormRequest $request, SchoolClass $class)
    {
        try {
            $status = $class->update($request->validated());

            toastr()->success('La classe a bien été mise à jour', 'Classes - Ecole');

            return $status;
        } catch (\Exception $e) {
            toastr()->error('Ooops!!! Nous n\'avons pas pu mettre à jour la classe', 'Classes - Ecole');
        }
    }

    /**
     * Delete the model from database.
     *
     * @param SchoolClass $class
     * @return bool|null
     */
    public function delete(SchoolClass $class)
    {
        $status = $class->delete();

        toastr()->success('La classe a bien été supprimée', 'Classes - Ecole');

        return $status;
    }
}
