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
                @include('shared.settings._create_session')
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
                @include('shared.settings._create_semester')

                @include('shared.settings._create_class')

                @include('shared.settings._create_section')

                @include('shared.settings._create_course')

                @include('shared.settings._attendance_type')

                @include('shared.settings._allow_submission_marks')

                @include('shared.settings._assign_teacher')
            @endif
        </div>
    </div>

    @include('shared._sections_and_courses')
@endsection
