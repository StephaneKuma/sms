<?php

namespace App\Services\Repositories;

use App\Models\ExamRule;
use App\Repositories\ExamRuleRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\ExamRuleContract;

class ExamRuleService implements ExamRuleContract
{
    /**
     * Create a new instance of the class.
     *
     * @param ExamRuleRepository $repository
     */
    public function __construct(private ExamRuleRepository $repository)
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
     * @param integer $examId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $examId)
    {
        return $this->repository->getAll($examId);
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $examId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId, int $examId)
    {
        return $this->repository->getAllBySession($sessionId, $examId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param ExamRule $rule
     * @return bool
     */
    public function update(FormRequest $request, ExamRule $rule)
    {
        return $this->repository->update($request, $rule);
    }

    /**
     * Delete the model from database.
     *
     * @param ExamRule $rule
     * @return bool|null
     */
    public function delete(ExamRule $rule)
    {
        return $this->repository->delete($rule);
    }
}
