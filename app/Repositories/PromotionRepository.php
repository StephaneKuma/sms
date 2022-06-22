<?php

namespace App\Repositories;

use App\Contracts\Repositories\PromotionContract;
use App\Models\Promotion;

class PromotionRepository implements PromotionContract
{
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
        return Promotion::with(['student', 'section'])
                ->where('session_id', $sessionId)
                ->where('class_id', $classId)
                ->where('section_id', $sectionId)
                ->get();
    }

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getClasses(int $sessionId)
    {
        return Promotion::with('class')
            ->select('class_id')
            ->where('session_id', $sessionId)
            ->distinct('class_id')
            ->get();
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
        return Promotion::with('section', 'class', 'session')
            ->withCount('section')
            ->select('section_id')
            ->where('session_id', $sessionId)
            ->where('class_id', $classId)
            ->distinct('section_id')
            ->get();
    }

    /**
     * Get all the model from database.
     *
     * @param integer $sessionId
     * @return \Illuminate\Database\Eloquent\Collection<int, static>
     */
    public function getSectionsBySession(int $sessionId)
    {
        return Promotion::with('section')
            ->withCount('section')
            ->select('section_id')
            ->where('session_id', $sessionId)
            ->distinct('section_id')
            ->get();
    }

    /**
     * Promote students to a new promotion
     *
     * @param array $rows
     * @return \Illuminate\Http\Response
     */
    public function massPromotion(array $rows)
    {
        try {
            foreach($rows as $row){
                Promotion::updateOrCreate([
                    'student_id' => $row['student_id'],
                    'session_id' => $row['session_id'],
                    'class_id' => $row['class_id'],
                    'section_id' => $row['section_id'],
                ],[
                    'id_card_number' => $row['id_card_number'],
                ]);
            }
            toastr()->success('Les élèves ont bien été promus.', 'Promotins - Ecole');
        } catch (\Exception $e) {
            toastr()->error('Impossible de promouvoir les élèves.', 'Promotions - Ecole');
        }
    }
}
