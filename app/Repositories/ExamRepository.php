<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\ExamContract;

class ExamRepository implements ExamContract
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
        $validated = $this->validate($request);
        $status = false;

        if ($validated['session_id'] == $currentSessionId) {
            Exam::create($validated);
            $status = true;

            toastr()->success('L\'examen a bien été créé', 'Examens - Ecole');
        } else {
            toastr()->warning("Ooops!!! L'examen a été assigné à une session académique antérieure. Nous ne pouvons donner suite au traitement.", 'Examens - Ecole');
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
        return Exam::all();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return Exam::with('session', 'semester', 'class', 'course')->where('session_id', $sessionId)->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param integer $currentSessionId
     * @param Exam $exam
     * @return bool
     */
    public function update(FormRequest $request, Exam $exam, int $currentSessionId)
    {
        $validated = $this->validate($request);
        $status = false;

        if ($validated['session_id'] == $currentSessionId) {
            $_status = $exam->update($validated);
            $status = $_status;

            toastr()->success('L\'examen a bien été mise à jour', 'Examens - Ecole');
        } else {
            toastr()->warning("Ooops!!! L'examen a été assigné à une session académique antérieure. Nous ne pouvons donner suite au traitement.", 'Examens - Ecole');
        }


        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Exam $exam
     * @return bool|null
     */
    public function delete(Exam $exam)
    {
        $status = $exam->delete();

        toastr()->success('L\'examen a bien été supprimé', 'Examens - Ecole');

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
        $start_at = Carbon::createFromFormat('d-m-Y H:i', $validated['start_at'])->timestamp;
        $end_at = Carbon::createFromFormat('d-m-Y H:i', $validated['end_at'])->timestamp;

        return [
            'name' => $validated['name'],
            'start_at' => $start_at,
            'end_at' => $end_at,
            'session_id' => $validated['session_id'],
            'semester_id' => $validated['semester_id'],
            'class_id' => $validated['class_id'],
            'course_id' => $validated['course_id'],
        ];
    }
}
