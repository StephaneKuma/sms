@php
$title = "Paramètre de l'école";
$second = 'Ecole';
$url = route('settings.index');
$bread = 'Paramètres';
@endphp

@extends('layouts.app')

@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/flatpickr/flatpickr.min.css') }}">
    <style>
        .masonry {
            /* display: grid;
                gap: 1em;
                grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
                grid-template-rows: masonry; */

            column-count: 3;
            column-gap: 1em;
        }

        .myBlock {
            margin: 0;
            display: grid;
            grid-template-rows: 1fr auto;
            margin-bottom: 1em;
            break-inside: avoid;
        }
    </style>
@endpush
@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/flatpickr/flatpickr.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_forms_plugins.min.js') }}"></script>

    <!-- Page JS Helpers (Flatpickr + BS Datepicker + BS Colorpicker + BS Maxlength + Select2 + Masked Input + Range Sliders + Tags Inputs plugins) -->
    <script>
        jQuery(function() {
            Codebase.helpers(['flatpickr', 'datepicker', 'select2', ]);
        });
    </script>
@endpush

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-settings mr-5"></i>
                    <span>{{ $title }}</span>
                </h3>
            </div>
        </div>

        <div class="masonry">
            @if ($currentSessionId == $latestSessionId)
                <div class="myBlock">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <h5><b>Créer une session</b></h5>
                            <small class="text-danger">
                                <i class="fa fa-exclamation mr-5"></i>
                                Créez une session par année académique. La dernière session
                                créée est considérée comme la dernière session académique.
                            </small>
                            <form class="js-validation-material" action="{{ route('settings.sessions.store') }}"
                                method="POST">
                                @csrf

                                <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" placeholder="2023 - 2024" class="form-control"
                                                id="name" name="name" value="{{ old('name') }}">
                                        </div>
                                        @error('name')
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
            @endif

            <div class="myBlock">
                <div class="block block-rounded">
                    <div class="block-content">
                        <h5><b>Naviguer dans une session</b></h5>
                        <small class="text-danger">
                            <i class="fa fa-exclamation mr-5"></i>
                            Utilisez ceci seulement quand vous souhaitez naviguez
                            dans les données des précédentes sessions.
                        </small>
                        <form class="js-validation-material" action="{{ route('settings.sessions.browse') }}"
                            method="POST">
                            @csrf

                            <div class="form-group row{{ $errors->has('session_id') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select id="session_id" class="js-select2 form-control" name="session_id"
                                            data-placeholder="Choisissez une session">
                                            <option></option>
                                            @forelse ($sessions as $session)
                                                <option value="{{ $session->id }}"
                                                    {{ (isset($section) && $section->session_id == $session->id) || old('session_id') == $session->id ? 'selected' : '' }}>
                                                    {{ $session->name }}</option>
                                            @empty
                                                <option value="-1">Veuillez créer une session</option>
                                            @endforelse
                                        </select>
                                    </div>
                                    @error('session_id')
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

            @if ($currentSessionId == $latestSessionId)
                <div class="myBlock">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <h5><b>Créer un semestre pour la session courante</b></h5>
                            <small></small>
                            <form class="js-validation-material" action="{{ route('settings.semesters.store') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" placeholder="Semestre 1" class="form-control"
                                                id="name" name="name" value="{{ old('name') }}">
                                            <label for="name">Nom</label>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback animated fadeInDown">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('start_at') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control" placeholder="01-01-2023"
                                                data-date-format="d-m-Y" id="start_at" name="start_at"
                                                value="{{ old('start_at') }}">
                                            <label for="start_at">Date de début</label>
                                        </div>
                                        @error('start_at')
                                            <div class="invalid-feedback animated fadeInDown">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('end_at') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" class="js-flatpickr form-control" placeholder="01-01-2023"
                                                data-date-format="d-m-Y" id="end_at" name="end_at"
                                                value="{{ old('end_at') }}">
                                            <label for="end_at">Date de fin</label>
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
                <div class="myBlock">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <h5><b>Créer une classe</b></h5>
                            <small></small>
                            <form class="js-validation-material" action="{{ route('settings.classes.store') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                                <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" placeholder="6ième" class="form-control"
                                                id="name" name="name" value="{{ old('name') }}">
                                            <label for="name">Nom</label>
                                        </div>
                                        @error('name')
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
                <div class="myBlock">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <h5><b>Créer une section</b></h5>
                            <small></small>
                            <form class="js-validation-material" action="{{ route('settings.sections.store') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                                <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" placeholder="A, B, C, etc." class="form-control"
                                                id="name" name="name" value="{{ old('name') }}">
                                            <label for="name">Nom</label>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback animated fadeInDown">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row {{ $errors->has('room_no') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" placeholder="1, 2, 3, etc." class="form-control"
                                                id="room_no" name="room_no" value="{{ old('room_no') }}">
                                            <label for="room_no">Salle N°</label>
                                        </div>
                                        @error('room_no')
                                            <div class="invalid-feedback animated fadeInDown">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <select id="class_id" class="js-select2 form-control" name="class_id"
                                                data-placeholder="Choisissez une classe">
                                                <option></option>
                                                @forelse ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ old('class_id') == $session->id ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                @empty
                                                    <option value="-1">Veuillez créer une classe</option>
                                                @endforelse
                                            </select>
                                            <label for="class_id">Assigner la section à la classe :</label>
                                        </div>
                                        @error('class_id')
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
                <div class="myBlock">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <h5><b>Créer un cours</b></h5>
                            <small></small>
                            <form class="js-validation-material" action="{{ route('settings.courses.store') }}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="session_id" value="{{ $currentSessionId }}">
                                <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" placeholder="Français, SVT, etc." class="form-control"
                                                id="name" name="name" value="{{ old('name') }}">
                                            <label for="name">Nom</label>
                                        </div>
                                        @error('name')
                                            <div class="invalid-feedback animated fadeInDown">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('type') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <select id="type" class="js-select2 form-control" name="type"
                                                data-placeholder="Choisissez un type">
                                                <option></option>
                                                <option {{ old('type') == '' ? 'selected' : 'Fondamentale' }}
                                                    value="Fondamentale">Fondamentale</option>
                                                <option {{ old('type') == '' ? 'selected' : 'Général' }} value="Général">
                                                    Général</option>
                                                <option {{ old('type') == '' ? 'selected' : 'Spécial' }} value="Spécial">
                                                    Spécial</option>
                                                <option {{ old('type') == '' ? 'selected' : 'Optionnel' }}
                                                    value="Optionnel">Optionnel</option>
                                            </select>
                                            <label for="type">Type de cours :</label>
                                        </div>
                                        @error('semester_id')
                                            <div class="invalid-feedback animated fadeInDown">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('semester_id') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <select id="semester_id" class="js-select2 form-control" name="semester_id"
                                                data-placeholder="Choisissez un semestre">
                                                <option></option>
                                                @forelse ($semesters as $semester)
                                                    <option value="{{ $semester->id }}"
                                                        {{ old('semester_id') == $semester->id ? 'selected' : '' }}>
                                                        {{ $semester->name }}</option>
                                                @empty
                                                    <option value="-1">Veuillez créer un semestre</option>
                                                @endforelse
                                            </select>
                                            <label for="semester_id">Assigner au semestre :</label>
                                        </div>
                                        @error('semester_id')
                                            <div class="invalid-feedback animated fadeInDown">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row{{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <select id="class_id" class="js-select2 form-control" name="class_id"
                                                data-placeholder="Choisissez une classe">
                                                <option></option>
                                                @forelse ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ old('class_id') == $session->id ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                @empty
                                                    <option value="-1">Veuillez créer une classe</option>
                                                @endforelse
                                            </select>
                                            <label for="class_id">Assigner à la classe :</label>
                                        </div>
                                        @error('class_id')
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

                <div class="myBlock">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <h5><b>Type de présence</b></h5>
                            <small class="text-danger">
                                <i class="fa fa-exclamation mr-5"></i>
                                Ne pas changer de type au milieu d'un semestre
                            </small>
                            <form class="js-validation-material mt-4" action="{{ route('settings.update', $setting) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="form-group row {{ $errors->has('attendance_type') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" name="attendance_type"
                                                id="example-radio1" value="section" {{ $setting->attendance_type == 'section' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="example-radio1">Présence par
                                                section</label>
                                        </div>
                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" name="attendance_type"
                                                id="example-radio2" value="course" {{ $setting->attendance_type == 'course' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="example-radio2">Présence par
                                                cours</label>
                                        </div>

                                        @error('attendance_type')
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
                <div class="myBlock">
                    <div class="block block-rounded">
                        <div class="block-content">
                            <h5><b>Autoriser la soumission des notes finales</b></h5>
                            <small class="text-danger">
                                <i class="fa fa-exclamation mr-5"></i>
                                Habituellement, les enseignant(e)s sont autorisé(e)s à soumettre
                                leur notes finales avant la fin d'un "Semestre".
                            </small> <br><br>

                            <small class="text-info">
                                <i class="fa fa-exclamation mr-5"></i>
                                Désactiver au début d'un "Semestre"
                            </small>
                            <form class="js-validation-material mt-4" action="{{ route('settings.update', $setting) }}"
                                method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="form-group row {{ $errors->has('mark_submission_status') ? 'is-invalid' : '' }}">
                                    <div class="col-12">
                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" name="mark_submission_status"
                                                id="marks-radio1" value="off" {{ $setting->mark_submission_status == 'off' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="marks-radio1">Désactiver</label>
                                        </div>
                                        <div class="custom-control custom-radio mb-5">
                                            <input class="custom-control-input" type="radio" name="mark_submission_status"
                                                id="marks-radio2" value="on" {{ $setting->mark_submission_status == 'on' ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="marks-radio2">Activer</label>
                                        </div>

                                        @error('mark_submission_status')
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
            @endif
        </div>
    </div>
@endsection
