<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\Promotion;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Contracts\Repositories\UserContract;
use App\Contracts\Repositories\SectionContract;
use App\Contracts\Repositories\PromotionContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;

class PromotionController extends Controller
{
    use SchoolSession;

    public function __construct(private PromotionContract $service,
        private SchoolSessionContract $sessionService,
        private UserContract $userService,
        private SchoolClassContract $classService,
        private SectionContract $sectionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $classId = $request->query('class_id', 0);
        $previousSession = $this->sessionService->getPrevious();

        if (count($previousSession) < 1) {
            toastr()->error('Pas de session précédente.', 'Promotions - Ecole');

            return back();
        }

        $previousSessionId = $previousSession['id'];

        $previousSessionClasses = $this->service->getClasses($previousSessionId);
        $previousSessionSections = $this->service->
            getSections($previousSessionId, $classId);

        if ($previousSessionSections->count() <= 0) {
            toastr()->info('Aucune sections à afficher.', 'Promotions - Ecole');
        } else {
            toastr()->success('Sections récupérées.', 'Promotions - Ecole');
        }

        $currentSessionSectionsCount = $this->service->
            getSectionsBySession($this->getCurrentSchoolSession())->count();

        return view('promotions.index', compact('previousSessionId', 'previousSessionClasses', 'previousSessionSections', 'currentSessionSectionsCount'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sessionId = $request->query('previousSessionId');
        $classId = $request->query('previousClassId');
        $sectionId = $request->query('previousSectionId');

        $students = $this->userService->getStudentsByClassAndSection($sessionId, $classId, $sectionId);
        $class = $this->classService->getById($classId);
        $section = $this->sectionService->getById($sectionId);

        $latestSchoolSessionId = $this->sessionService->getLatest()->id;
        $classes = $this->classService->getAllBySession($latestSchoolSessionId);

        return view('promotions.form', compact('students', 'class', 'section', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $idCardNumbers = $request->id_card_number;
        $latestSchoolSessionId = $this->sessionService->getLatest()->id;

        $rows = [];
        $index = 0;
        foreach($idCardNumbers as $student_id => $id_card_number) {
            $row = [
                'student_id'    => $student_id,
                'id_card_number'=> $id_card_number,
                'class_id'      => $request->class_id[$index],
                'section_id'    => $request->section_id[$index],
                'session_id'    => $latestSchoolSessionId,
            ];
            array_push($rows, $row);
            $index++;
        }
        // dd($rows);

        $this->service->massPromotion($rows);

        return redirect()->route('school.promotions.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Promotion $promotion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Promotion $promotion)
    {
        //
    }
}
