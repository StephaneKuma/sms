<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use App\Traits\SchoolSession;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Contracts\Repositories\SectionContract;
use App\Contracts\Repositories\SchoolClassContract;
use App\Contracts\Repositories\SchoolSessionContract;

class SectionController extends Controller
{
    use SchoolSession;

    /**
     * Create a new instance of the class
     *
     * @param SectionContract $service
     */
    public function __construct(private SectionContract $service,
        private SchoolClassContract $classService, private SchoolSessionContract $sessionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sections = $this->service->getAllBySession($this->getCurrentSchoolSession());

        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sessions = $this->sessionService->getAll();
        $classes = $this->classService->getAllBySession($this->getCurrentSchoolSession());

        return view('sections.form', compact('sessions', 'classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreSectionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSectionRequest $request)
    {
        if($this->service->create($request, $this->getCurrentSchoolSession())) {
            return redirect()->route('school.sections.index');
        } else {
            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        $sessions = $this->sessionService->getAll();
        $classes = $this->classService->getAllBySession($this->getCurrentSchoolSession());

        return view('sections.form', compact('section', 'sessions', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateSectionRequest  $request
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSectionRequest $request, Section $section)
    {
        $this->service->update($request, $section, $this->getCurrentSchoolSession());

        return redirect()->route('school.sections.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        $this->service->delete($section);

        return back();
    }
}
