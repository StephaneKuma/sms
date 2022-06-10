<?php

namespace App\Services\Repositories;

use App\Models\Exam;
use App\Repositories\ExamRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\ExamContract;

class ExamService implements ExamContract
{
    /**
     * Create a new instance of the class.
     *
     * @param ExamRepository $repository
     */
    public function __construct(private ExamRepository $repository)
    {}

    /**
     * Create a new instance of the model.
     *
     * @param FormRequest $request
     * @return bool
     */
    public function create(FormRequest $request)
    {
        return $this->repository->create($request);
    }

    /**
     * Get all the models from database.
     *
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId)
    {
        return $this->repository->getAllBySession($sessionId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param Exam $exam
     * @return bool
     */
    public function update(FormRequest $request, Exam $exam)
    {
        return $this->repository->update($request, $exam);
    }

    /**
     * Delete the model from database.
     *
     * @param Exam $exam
     * @return bool|null
     */
    public function delete(Exam $exam)
    {
        return $this->repository->delete($exam);
    }
}
