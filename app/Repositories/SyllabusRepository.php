<?php

namespace App\Repositories;

use App\Models\Syllabus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\SyllabusContract;

class SyllabusRepository implements SyllabusContract
{
    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request)
    {
        $data = $this->validate($request);
        $status = false;

        Syllabus::create($data);
        $status = true;

        toastr()->success('Le syllabus a bie été créé', 'Syllabi - Ecole');

        return $status;
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return Syllabus::with('session', 'class', 'course')->get();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return Syllabus::with('session', 'class', 'course')
            ->where('session_id', $sessionId)
            ->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Syllabus $syllabus
     * @return bool
     */
    public function update(FormRequest $request, Syllabus $syllabus)
    {
        $data = $this->validate($request, $syllabus);
        $status = false;

        $_status = $syllabus->update($data);
        $status = $_status;

        toastr()->success('Le syllabus a bie été mise à jour', 'Syllabi - Ecole');

        return $status;
    }

    /**
     * Delete the model from database.
     *
     * @param Syllabus $syllabus
     * @return bool|null
     */
    public function delete(Syllabus $syllabus)
    {
        Storage::disk('public')->delete($syllabus->path);

        $status = $syllabus->delete();

        toastr()->success('Le syllabus a bien été supprimé', 'Syllabi - Ecole');

        return $status;
    }

    /**
     * Validate form request
     *
     * @param FormRequest $request
     * @param Syllabus|null $syllabus
     * @return mixed|array
     */
    private function validate(FormRequest $request, Syllabus $syllabus = null)
    {
        $validated = $request->validated();

        $pdf = $validated['path'] ?? null;
        // $path = $pdf == null ? null : $pdf->store('syllabi', 'public');

        $path = '';

        if (is_null($pdf) && is_null($syllabus)) return;

        if (is_null($pdf) && !is_null($syllabus)) {
            $path = $syllabus->path;
        }

        if (!is_null($pdf)) {
            $path = $pdf->store('syllabi', 'public');

            if(!is_null($syllabus)) {
                Storage::disk('public')->delete($syllabus->path);
            }
        }

        return [
            'session_id' => $validated['session_id'],
            'class_id' => $validated['class_id'],
            'course_id' => $validated['course_id'],
            'name' => $validated['name'],
            'path' => is_null($path) ? $syllabus->path : $path,
        ];
    }
}
