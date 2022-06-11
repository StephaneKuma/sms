@php
    $title = "Paramètre de l'école";
    $second = "Ecole";
    $url = route('settings.index');
    $bread = "Paramètres";
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
            </div>
        </div>

        <div class="row g-3">
            @if ($currentSessionId == $latestSessionId)
                <div class="col-md-4">
                    <div class="block">
                        <div class="block-content">
                            <h5><b>Créer une session</b></h5>
                            <small class="text-danger">
                                <i class="fa fa-exclamation mr-5"></i>
                                Créez une session par année académique. La dernière session
                                créée est considérée comme la dernière session académique.
                            </small>
                            <form class="js-validation-material" action="{{ route('settings.sessions.store') }}" method="POST">
                                @csrf

                                <div class="form-group row">
                                    <div class="col-12">
                                        <div class="form-material">
                                            <input type="text" placeholder="2023 - 2024" class="form-control" id="name" name="name" value="{{ isset($session) ? $session->name : old('name') }}" {{ $errors->has('name') ? '' : '' }}>
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

            <div class="col-md-4">
                <div class="block">
                    <div class="block-content">
                        <h5><b>Naviguer dans une session</b></h5>
                        <small class="text-danger">
                            <i class="fa fa-exclamation mr-5"></i>
                            Utilisez ceci seulement quand vous souhaitez naviguez
                            dans les données des précédentes sessions.
                        </small>
                        <form class="js-validation-material" action="{{ route('settings.sessions.browse') }}" method="POST">
                            @csrf

                            <div class="form-group row{{ $errors->has('session_id') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select id="session_id" class="js-select2 form-control" name="session_id" data-placeholder="Choisissez une session">
                                            <option></option>
                                            @forelse ($sessions as $session)
                                                <option value="{{ $session->id }}" {{ ((isset($section) && $section->session_id == $session->id) || old('session_id') == $session->id) ? 'selected' : '' }}>{{ $session->name }}</option>
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
        </div>
    </div>
@endsection
