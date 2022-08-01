@php
$teacher = auth()->user();
$second = 'Mes cours';
$url = route('school.teacher.courses', $teacher);
$bread = 'Devoir';
$title = 'Créer un devoir #{$assignedTeacher->course->name}';
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-calendar mr-5"></i>
                    <span>{{ $title }}</span>
                </h3>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-content block-content-full bg-white">
                {{-- <span class="text-xl text-info bg-white">Date et heure actuelles: {{ date('H:i:s d-m-Y') }}</span> --}}

                <form class="js-validation-material mt-4" enctype="multipart/form-data"
                    action="{{ route('school.teacher.assignments.store', $assignedTeacher) }}" method="POST">
                    @csrf

                    <input type="hidden" name="session_id" value="{{ $assignedTeacher->session_id }}">
                    <input type="hidden" name="semester_id" value="{{ $assignedTeacher->semester_id }}">
                    <input type="hidden" name="class_id" value="{{ $assignedTeacher->class_id }}">
                    <input type="hidden" name="section_id" value="{{ $assignedTeacher->section_id }}">
                    <input type="hidden" name="course_id" value="{{ $assignedTeacher->course_id }}">
                    <input type="hidden" name="teacher_id" value="{{ $assignedTeacher->teacher_id }}">

                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    value="{{ old('name') }}" {{ $errors->has('name') ? '' : '' }}>
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
                                <div class="col-12">
                                    <div class="form-group row {{ $errors->has('path') ? 'is-invalid' : '' }}">
                                        <div class="col-12">
                                            <div class="form-material floating">
                                                <input type="file" class="form-control" id="path" name="path"
                                                    value="{{ old('path') }}" {{ $errors->has('path') ? '' : '' }}>
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
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-save mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
