@php
    $title = isset($rule) ? "Modifier la règle" : "Ajouter une règle";
    $second = "Ecole";
    $url = route('school.classes.index');
    $third = "Règles de graduation";
    $url2 =  route('school.exams.grading.systems.index');
    $fourth = $system->name . ' - ' . $system->semester->name . ' - ' . $system->class->name;
    $url3 = route('school.exams.grading.systems.rules.index', $system);
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
                <a href="{{ route('school.exams.grading.systems.rules.index', $system) }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> {{ $fourth }}
                </a>
            </div>
            <div class="block-content block-content-full">
                <p class="text-danger">
                    <i class="fa fa-exclamation mr-5"></i>
                    Souvenez vous de créer une session et un système de graduation avant de continuer
                </p>

                <form class="js-validation-material"
                    action="{{ isset($rule) ? route('school.exams.grading.systems.rules.update', compact('system', 'rule')) : route('school.exams.grading.systems.rules.store', $system) }}" method="POST">
                    @csrf
                    @isset($rule)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row {{ $errors->has('mark') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="number" class="form-control" id="mark" name="mark" value="{{ isset($rule) ? $rule->mark : old('mark') }}" {{ $errors->has('mark') ? '' : '' }}>
                                        <label for="mark">Points</label>
                                    </div>
                                    @error('mark')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row {{ $errors->has('start_at') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="number" class="form-control" id="start_at" name="start_at" value="{{ isset($rule) ? $rule->start_at : old('start_at') }}" {{ $errors->has('start_at') ? '' : '' }}>
                                        <label for="start_at">Début</label>
                                    </div>
                                    @error('start_at')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row {{ $errors->has('end_at') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="number" class="form-control" id="end_at" name="end_at" value="{{ isset($rule) ? $rule->end_at : old('end_at') }}" {{ $errors->has('end_at') ? '' : '' }}>
                                        <label for="end_at">Fin</label>
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
                        <input type="hidden" name="session_id" value="{{ $sessionId }}">
                        <input type="hidden" name="system_id" value="{{ $system->id }}">
                        <div class="col-md-6">
                            <div class="form-group row {{ $errors->has('grade') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="grade" name="grade" value="{{ isset($rule) ? $rule->grade : old('grade') }}" {{ $errors->has('grade') ? '' : '' }}>
                                        <label for="grade">Mention</label>
                                    </div>
                                    @error('grade')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row {{ $errors->has('note') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="note" name="note" value="{{ isset($rule) ? $rule->note : old('note') }}" {{ $errors->has('note') ? '' : '' }}>
                                        <label for="note">Description</label>
                                    </div>
                                    @error('note')
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
                                <i class="fa fa-{{ isset($rule) ? 'refresh' : 'save' }} mr-5"></i>
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
