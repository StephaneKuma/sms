<?php

namespace App\Contracts\Repositories;

use Illuminate\Foundation\Http\FormRequest;

interface PromotionContract
{
    // public function assignClassAndSection(FormRequest $request);

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @param integer $sectionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getAll(int $sessionId, int $classId, int $sectionId);

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getClasses(int $sessionId);

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @param integer $classId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getSections(int $sessionId, int $classId);

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getSectionsBySession(int $sessionId);

    /**
     * Get the model students from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getStudentsBySession(int $sessionId);

    /**
     * Get the model male students from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getMaleStudentsBySession(int $sessionId);

    /**
     * Promote students to a new promotion
     *
     * @param array $rows
     * @return \Illuminate\Http\Response
     */
    public function massPromotion(array $rows);
}
