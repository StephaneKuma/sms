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
     * @param integer $currentSessionId
     * @return bool
     */
    public function create(FormRequest $request, int $currentSessionId)
    {
        $status = false;

        if ($currentSessionId == $this->validate($request)['sessionId']) {
            Section::create($this->validate($request)['validated']);
            $status = true;

            toastr()->success('La section a bien été créée', 'Sections - Ecole');
        } else {
            toastr()->warning("Ooops!!! La section a été assignée à une session académique antérieure. Nous ne pouvons donner suite au traitement.", 'Sections - Ecole');
        }

        return $status;
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
     * @param integer $currentSessionId
     * @return bool
     */
    public function update(FormRequest $request, Section $section, int $currentSessionId)
    {
        $status = false;

        if ($this->validate($request)['sessionId'] == $currentSessionId) {
            $_status = $section->update($this->validate($request)['validated']);
            $status = $_status;

            toastr()->success('La section a bien été mise à jour', 'Sections - Ecole');
        } else {
            toastr()->warning("Ooops!!! La section a été assignée à une session académique antérieure. Nous ne pouvons donner suite au traitement.", 'Sections - Ecole');
        }

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

    /**
     * Validate FormRequest
     *
     * @param FormRequest $request
     * @return array
     */
    private function validate(FormRequest $request)
    {
        $validated = $request->validated();
        $sessionId = $validated['session_id'];

        return compact('validated', 'sessionId');
    }
}
