@php
    $title = isset($rule) ? "Modifier la condition" : "Ajouter une condition";
    $second = "Ecole";
    $url = route('school.sessions.index');
    $third = "Examen";
    $url2 =  route('school.exams.index');
    $fourth = $exam->name . ' - ' . $exam->course->name;
    $url3 = route('school.exams.rules.index', $exam);
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
                <a href="{{ route('school.exams.rules.index', $exam) }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> {{ $fourth }}
                </a>
            </div>
            <div class="block-content block-content-full">
                <p class="text-danger">Souvenez vous de créer un semestre, une classe et un cours avant de continuer</p>

                <form class="js-validation-material"
                    action="{{ isset($rule) ? route('school.exams.rules.update', compact('exam', 'rule')) : route('school.exams.rules.store', $exam) }}" method="POST">
                    @csrf
                    @isset($rule)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row {{ $errors->has('total_mark') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="number" class="form-control" id="total_mark" name="total_mark" value="{{ isset($rule) ? $rule->total_mark : old('total_mark') }}" {{ $errors->has('total_mark') ? '' : '' }}>
                                        <label for="total_mark">Point total</label>
                                    </div>
                                    @error('total_mark')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row {{ $errors->has('pass_mark') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="number" class="form-control" id="pass_mark" name="pass_mark" value="{{ isset($rule) ? $rule->pass_mark : old('pass_mark') }}" {{ $errors->has('pass_mark') ? '' : '' }}>
                                        <label for="pass_mark">Moyenne</label>
                                    </div>
                                    @error('pass_mark')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="session_id" value="{{ $sessionId }}">
                        <input type="hidden" name="exam_id" value="{{ $exam->id }}">
                        <div class="col-md-4">
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
