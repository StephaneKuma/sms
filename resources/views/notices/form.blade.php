@php
    $title = "Créer une notice";
    $second = "Ecole";
    $url = route('school.classes.index');
    $third = "Notices";
    $url2 =  '#';
    $bread = $title;
@endphp

@extends('layouts.app')

@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/simplemde/simplemde.min.css') }}">
@endpush
@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('js/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('js/plugins/simplemde/simplemde.min.js') }}"></script>

    <!-- Page JS Helpers (Summernote + CKEditor + SimpleMDE plugins) -->
    <script>jQuery(function(){ Codebase.helpers(['summernote', 'ckeditor', 'simplemde']); });</script>
@endpush

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                <h5>Contenu de la notice</h5>
            </div>
            <div class="block-content block-content-full">
                {{-- <p class="text-danger">Souvenez vous de créer une session avant de continuer</p> --}}
                <form class="js-validation-material" action="{{ route('school.notices.store') }}" method="POST">
                    @csrf

                    <div class="form-group row">
                        <input type="hidden" name="session_id" value="{{ $sessionId }}">
                        <div class="col-12">
                            <div class="form-group row {{ $errors->has('content') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <textarea id="content" name="content" class="js-summernote form-control"></textarea>
                                        <label for="content">Contenu de la notice</label>
                                    </div>
                                    @error('content')
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
