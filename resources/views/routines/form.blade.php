@php
$title = isset($routine) ? 'Modifier la routine :' : 'Ajouter une routine';
$second = 'Ecole';
$url = route('school.classes.index');
$third = 'Routines';
$url2 = '#';
$bread = $title;
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                {{-- <a href="{{ route('school.routines.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des syllabus
                </a> --}}
            </div>
            <div class="block-content block-content-full">
                <p class="text-danger">Souvenez vous de créer une classe et un cours avant de continuer</p>

                <form class="js-validation-material"
                    action="{{ isset($routine) ? route('school.routines.update', $routine) : route('school.routines.store') }}"
                    method="POST">
                    @csrf
                    @isset($routine)
                        @method('PATCH')
                    @endisset

                    <input type="hidden" name="session_id" value="{{ $currentSessionId }}">

                    <div class="form-group row">
                        <div class="col-md-4 {{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                            <div class="form-material">
                                <select onchange="getCoursesAndSections(this);" id="class_id"
                                    class="js-select2 form-control" name="class_id"
                                    data-placeholder="Choisissez une classe">
                                    <option></option>
                                    @forelse ($classes as $class)
                                        <option value="{{ $class->id }}"
                                            {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                            {{ $class->name }}</option>
                                    @empty
                                        <option value="-1">Veuillez créer une classe</option>
                                    @endforelse
                                </select>
                                <label for="class_id">Choisir classe :</label>
                            </div>
                            @error('class_id')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 {{ $errors->has('section_id') ? 'is-invalid' : '' }}">
                            <div class="form-material">
                                <select id="section_id" class="js-select2 form-control section_id" name="section_id">
                                </select>
                                <label for="section_id">Choisir une section :</label>
                            </div>
                            @error('section_id')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 {{ $errors->has('course_id') ? 'is-invalid' : '' }}">
                            <div class="form-material">
                                <select id="course_id" class="js-select2 form-control course_id" name="course_id">
                                </select>
                                <label for="course_id">Choisir un cours :</label>
                            </div>
                            @error('course_id')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 {{ $errors->has('weekday') ? 'is-invalid' : '' }}">
                            <div class="form-material">
                                <select id="weekday" class="js-select2 form-control" name="weekday"
                                    data-placeholder="Choisissez un jour">
                                    <option></option>
                                    <option value="1">Lundi</option>
                                    <option value="2">Mardi</option>
                                    <option value="3">Mercredi</option>
                                    <option value="4">Jeudi</option>
                                    <option value="5">Vendredi</option>
                                    <option value="6">Samedi</option>
                                    <option value="7">Dimanche</option>
                                </select>
                                <label for="weekday">Jour :</label>
                            </div>
                            @error('weekday')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 {{ $errors->has('start_at') ? 'is-invalid' : '' }}">
                            <div class="form-material">
                                <input type="text" placeholder="09:00" class="form-control" id="start_at"
                                    name="start_at" value="{{ old('start_at') }}">
                                <label for="start_at">Début</label>
                            </div>
                            @error('start_at')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-4 {{ $errors->has('end_at') ? 'is-invalid' : '' }}">
                            <div class="form-material">
                                <input type="text" placeholder="09:00" class="form-control" id="end_at" name="end_at"
                                    value="{{ old('end_at') }}">
                                <label for="end_at">Fin</label>
                            </div>
                            @error('end_at')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-save mr-5"></i> Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('shared._sections_and_courses')
@endsection
