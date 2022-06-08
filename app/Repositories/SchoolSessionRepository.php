<?php

namespace App\Repositories;

use App\Contracts\Repositories\SchoolSessionContract;
use App\Models\SchoolSession;
use Illuminate\Foundation\Http\FormRequest;

class SchoolSessionRepository implements SchoolSessionContract
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
            SchoolSession::create($request->validated());

            toastr()->success('La session a bien été créée', 'Sessions - Ecole');
        } catch (\Exception $e) {
            toastr()->error("Ooops!!! Nous n'avons pas pu créer la session", 'Sessions - Ecole');
        }
    }

    /**
     * Get the latest model from database.
     *
     * @return Object|SchoolSession
     */
    public function getLatest()
    {
        $session = SchoolSession::latest()->first();

        if ($session) {
            return $session;
        } else {
            return (Object) ['id' => 0];
        }
    }

    /**
     * Get a model from database.
     *
     * @param integer $id
     * @return SchoolSession
     */
    public function getById(int $id)
    {
        return SchoolSession::find($id);
    }

    /**
     * Get the model before the last from database
     *
     * @return SchoolSession
     */
    public function getPrevious()
    {
        $lastTwoSessions = SchoolSession::orderBy('id', 'DESC')
            ->take(2)
            ->get()
            ->toArray();

        return (count($lastTwoSessions) < 2) ? [] : $lastTwoSessions[1];
    }

    /**
     * Set model id in app session
     *
     * @param mixed $request
     * @return void
     */
    public function browse($request)
    {
        try {
            if(session()->has('browse_session_id')
                && ($request['session_id'] == $this->getLatest()->id)
            ) {
                session()->forget(['browse_session_id', 'browse_session_name']);
            } else {
                session(['browse_session_id' => $request['session_id']]);
                session(['browse_session_name' => $this->getById($request['session_id'])->name]);
            }
        } catch (\Exception $e) {
            throw new \Exception('Impossible de mettre en session la session d\'école pour la recherche. '.$e->getMessage());
        }
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return SchoolSession::orderby('created_at', 'DESC')->get();
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param SchoolSession $class
     * @return bool
     */
    public function update(FormRequest $request, SchoolSession $session)
    {
        try {
            $status = $session->update($request->validated());

            toastr()->success('La session a bien été mise à jour', 'Sessions - Ecole');

            return $status;
        } catch (\Exception $e) {
            toastr()->error('Ooops!!! Nous n\'avons pas pu mettre à jour la session', 'Session - Ecole');
        }
    }

    /**
     * Delete the model from database.
     *
     * @param SchoolSession $class
     * @return bool|null
     */
    public function delete(SchoolSession $session)
    {
        $status = $session->delete();

        toastr()->success('La session a bien été supprimée', 'Sessions - Ecole');

        return $status;
    }
}
