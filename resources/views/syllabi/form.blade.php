@php
    $title = isset($syllabus) ? "Modifier le syllabus : " . $syllabus->name : "Ajouter un syllabus";
    $second = "Ecole";
    $url = route('school.classes.index');
    $third = "Syllabi";
    $url2 =  route('school.syllabi.index');
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
                <a href="{{ route('school.syllabi.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des syllabus
                </a>
            </div>
            <div class="block-content block-content-full">
                <p class="text-danger">Souvenez vous de créer une session, une classe et un cours avant de continuer</p>

                <form enctype="multipart/form-data" class="js-validation-material" action="{{ isset($syllabus) ? route('school.syllabi.update', $syllabus) : route('school.syllabi.store') }}" method="POST">
                    @csrf
                    @isset($syllabus)
                        @method('PATCH')
                    @endisset

                    

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="name" name="name" value="{{ isset($syllabus) ? $syllabus->name : old('name') }}" {{ $errors->has('name') ? '' : '' }}>
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
                            <div class="form-group row {{ $errors->has('path') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="file" class="form-control" id="path" name="path" value="{{ isset($syllabus) ? $syllabus->path : old('path') }}" {{ $errors->has('path') ? '' : '' }}>
                                        <label for="path">Fichier</label>
                                    </div>
                                    @error('type')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <input type="hidden" name="session_id" value="{{ $sessionId }}">
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select onchange="getCourses(this)" id="class_id" class="js-select2 form-control" name="class_id" data-placeholder="Choisissez une classe">
                                            <option></option>
                                            @forelse ($classes as $class)
                                                <option value="{{ $class->id }}" {{ ((isset($syllabus) && $syllabus->class_id == $class->id) || old('class_id') == $class->id) ? 'selected' : '' }}>{{ $class->name }}</option>
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
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('course_id') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select id="course_id" class="js-select2 form-control" name="course_id">
                                        </select>
                                        <label for="course_id">Cours</label>
                                    </div>
                                    @error('course_id')
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
                                <i class="fa fa-{{ isset($syllabus) ? 'refresh' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('shared._courses')
@endsection
