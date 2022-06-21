<?php

namespace App\Services\Repositories;

use App\Models\GradeRule;
use App\Repositories\GradeRuleRepository;
use Illuminate\Foundation\Http\FormRequest;
use App\Contracts\Repositories\GradeRuleContract;

class GradeRuleService implements GradeRuleContract
{
    /**
     * Create a new instance of the class.
     *
     * @param GradeRuleRepository $repository
     */
    public function __construct(private GradeRuleRepository $repository)
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
     * @param integer $systemId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $systemId)
    {
        return $this->repository->getAll($systemId);
    }

    /**
     * Get all the models from database.
     *
     * @param integer $sessionId
     * @param integer $systemId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAllBySession(int $sessionId, int $systemId)
    {
        return $this->repository->getAllBySession($sessionId, $systemId);
    }

    /**
     * Update the model in database.
     *
     * @param FormRequest $request
     * @param GradeRule $rule
     * @return bool
     */
    public function update(FormRequest $request, GradeRule $rule)
    {
        return $this->repository->update($request, $rule);
    }

    /**
     * Delete the model from database.
     *
     * @param GradeRule $rule
     * @return bool|null
     */
    public function delete(GradeRule $rule)
    {
        return $this->repository->delete($rule);
    }
}
