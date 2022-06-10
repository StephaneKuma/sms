<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Semester;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SemesterContract;

class SemesterRepository implements SemesterContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return void
     */
    public function create(FormRequest $request)
    {
        Semester::create($this->validate($request));

        toastr()->success("Le semestre a bien été créé", 'Semestres - Ecole');
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return Semester::orderby('created_at', 'DESC')->get();
    }

    /**
     * Get all of the models from database by the session id.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return Semester::where('session_id', $sessionId)
            ->orderby('created_at', 'DESC')
            ->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Semester $semester
     * @return bool
     */
    public function update(FormRequest $request, Semester $semester)
    {
        $status = $semester->update($this->validate($request));

        toastr()->success("Le semestre a bien été mise à jour", 'Semestres - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Semester $semester
     * @return bool|null
     */
    public function delete(Semester $semester)
    {
        $status = $semester->delete();

        toastr()->success("Le semestre a bien supprimé", 'Semestres - Ecole');

        return $status;
    }

    /**
     * Validate form request
     *
     * @param FormRequest $request
     * @return mixed|array
     */
    private function validate(FormRequest $request)
    {
        $validated = $request->validated();
        $start_at = Carbon::createFromFormat('d-m-Y', $validated['start_at'])->timestamp;
        $end_at = Carbon::createFromFormat('d-m-Y', $validated['end_at'])->timestamp;

        return [
            'session_id' => $validated['session_id'],
            'name' => $validated['name'],
            'start_at' => $start_at,
            'end_at' => $end_at,
        ];
    }
}
