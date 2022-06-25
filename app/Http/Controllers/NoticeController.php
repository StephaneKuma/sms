<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\NoticeContract;
use App\Contracts\Repositories\SchoolSessionContract;
use App\Http\Requests\StoreNoticeRequest;
use App\Models\Notice;
use App\Traits\SchoolSession;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    use SchoolSession;

    public function __construct(private NoticeContract $service,
        private SchoolSessionContract $sessionService)
    {}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(!auth()->user()->can('create notices'), 403, "Vous n'êtes pas autorisé(e) à effectuer cette action. Veuillez contacter l'administrateur.");

        $sessionId = $this->getCurrentSchoolSession();

        return view('notices.form', compact('sessionId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreNoticeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNoticeRequest $request)
    {
        // dd($request->validated());
        $this->service->create($request);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        //
    }
}
