<?php

namespace App\Services\Repositories;

use App\Contracts\Repositories\PromotionContract;
use App\Repositories\PromotionRepository;

class PromotionService implements PromotionContract
{
    public function __construct(private PromotionRepository $repository)
    {}

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $sessionId, int $classId, int $sectionId)
    {
        return $this->repository->getAll($sessionId, $classId, $sectionId);
    }

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getClasses(int $sessionId)
    {
        return $this->repository->getClasses($sessionId);
    }

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getSections(int $sessionId, int $classId)
    {
        return $this->repository->getSections($sessionId, $classId);
    }

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getSectionsBySession(int $sessionId)
    {
        return $this->repository->getSectionsBySession($sessionId);
    }

    /**
     * Get the model students from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudentsBySession(int $sessionId)
    {
        return $this->repository->getStudentsBySession($sessionId);
    }

    /**
     * Get the model male students from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getMaleStudentsBySession(int $sessionId)
    {
        return $this->repository->getMaleStudentsBySession($sessionId);
    }

    /**
     * Promote students to a new promotion
     *
     * @param array $rows
     * @return \Illuminate\Http\Response
     */
    public function massPromotion(array $rows)
    {
        $this->repository->massPromotion($rows);
    }
}
