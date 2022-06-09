@php
    $title = isset($section) ? "Modifier la section : " . $section->name : "Ajouter une section";
    $second = "Ecole";
    $url = route('school.sections.index');
    $third = "Sections";
    $url2 =  route('school.sections.index');
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
                <a href="{{ route('school.sections.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des semestres
                </a>
            </div>
            <div class="block-content block-content-full">
                <p class="text-danger">Souvenez vous de créer une session et une classe avant de continuer</p>

                <form class="js-validation-material" action="{{ isset($section) ? route('school.sections.update', $section) : route('school.sections.store') }}" method="POST">
                    @csrf
                    @isset($section)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($section) ? $section->name : old('name') }}" {{ $errors->has('name') ? '' : '' }}>
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
                            <div class="form-group row {{ $errors->has('room_no') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="room_no" name="room_no" value="{{ isset($section) ? $section->room_no : old('room_no') }}" {{ $errors->has('room_no') ? '' : '' }}>
                                        <label for="room_no">Salle N°</label>
                                    </div>
                                    @error('room_no')
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
                            <div class="form-group row{{ $errors->has('session_id') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select id="session_id" class="js-select2 form-control" name="session_id" data-placeholder="Choisissez une session">
                                            <option></option>
                                            @forelse ($sessions as $session)
                                                <option value="{{ $session->id }}" {{ ((isset($section) && $section->session_id == $session->id) || old('session_id') == $session->id) ? 'selected' : '' }}>{{ $session->name }}</option>
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
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select id="class_id" class="js-select2 form-control" name="class_id" data-placeholder="Choisissez une classe">
                                            <option></option>
                                            @forelse ($classes as $class)
                                                <option value="{{ $class->id }}" {{ ((isset($section) && $section->class_id == $class->id) || old('class_id') == $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @empty
                                                <option value="-1"><a href="{{ route('school.classes.create') }}">Veuillez créer une classe</a></option>
                                            @endforelse
                                        </select>
                                        <label for="class_id">Classe</label>
                                    </div>
                                    @error('class_id')
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
                                <i class="fa fa-{{ isset($section) ? 'refresh' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
