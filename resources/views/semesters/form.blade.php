@php
    $title = isset($semester) ? "Modifier le semestre : " . $semester->name : "Ajouter un semestre";
    $second = "Ecole";
    $url = route('school.semesters.index');
    $third = "Semestres";
    $url2 =  route('school.semesters.index');
    $bread = $title;
@endphp

@extends('layouts.app')

@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
@endpush
@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_forms_plugins.min.js') }}"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins) -->
    <script>jQuery(function(){ Codebase.helpers(['flatpickr', 'datepicker', 'select2',]); });</script>
@endpush

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                <a href="{{ route('school.semesters.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des semestres
                </a>
            </div>
            <div class="block-content block-content-full">
                <p class="text-danger">Souvenez vous de créer une session avant de continuer</p>

                <form class="js-validation-material" action="{{ isset($semester) ? route('school.semesters.update', $semester) : route('school.semesters.store') }}" method="POST">
                    @csrf
                    @isset($semester)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($semester) ? $semester->name : old('name') }}" {{ $errors->has('name') ? '' : '' }}>
                                        <label for="name">Nom</label>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('session_id') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select id="session_id" class="js-select2 form-control" name="session_id" data-placeholder="Choisissez une session">
                                            <option></option>
                                            @forelse ($schoolSessions as $session)
                                                <option value="{{ $session->id }}" {{ ((isset($semester) && $semester->session_id == $session->id) || old('session_id') == $session->id) ? 'selected' : '' }}>{{ $session->name }}</option>
                                            @empty
                                                <option value="-1"><a href="{{ route('school.sessions.create') }}">Veuillez créer une session</a></option>
                                            @endforelse
                                        </select>
                                        <label for="session_id">Session</label>
                                    </div>
                                    @error('session_id')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('start_at') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="js-flatpickr form-control"
                                            data-date-format="d-m-Y" id="start_at"
                                            name="start_at" value="{{ old('start_at') }}">
                                        <label for="start_at">Date de début</label>
                                        @isset($semester)
                                            <div class="form-text text-muted text-right">
                                                {{ $semester->start_at }}
                                            </div>
                                        @endisset
                                    </div>
                                    @error('start_at')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('end_at') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="js-flatpickr form-control"
                                            data-date-format="d-m-Y" id="end_at"
                                            name="end_at" value="{{ old('end_at') }}">
                                        <label for="end_at">Date de fin</label>
                                        @isset($semester)
                                            <div class="form-text text-muted text-right">
                                                {{ $semester->end_at }}
                                            </div>
                                        @endisset
                                    </div>
                                    @error('end_at')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-{{ isset($semester) ? 'refresh' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
