<?php

namespace App\Repositories;

use App\Models\Section;
use App\Models\SchoolClass;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SectionContract;

class SectionRepository implements SectionContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request)
    {
        $data = $request->validated();
        $status = false;

        Section::create($data);
        $status = true;

        toastr()->success('La section a bien été créée', 'Sections - Ecole');

        return $status;
    }

    /**
     * Get all the model from database.
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getById(int $id)
    {
        return Section::find($id);
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllByClassId(int $sessionId, int $classId)
    {
        return Section::where('session_id', $sessionId)
            ->where('class_id', $classId)
            ->get();
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return Section::orderby('created_at', 'DESC')->get();
    }

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return Section::where('session_id', $sessionId)->get();
    }

    /**
     * Get all the models from database by schoom class
     *
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllByClass(int $classId)
    {
        return Section::where('class_id', $classId)->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Section $section
     * @return bool
     */
    public function update(FormRequest $request, Section $section)
    {
        $data = $request->validated();
        $status = false;

        $_status = $section->update($data);
        $status = $_status;

        toastr()->success('La section a bien été mise à jour', 'Sections - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Section $section
     * @return bool|null
     */
    public function delete(Section $section)
    {
        $status = $section->delete();

        toastr()->success('La section a bien été supprimée', 'Sections - Ecole');

        return $status;
    }
}
