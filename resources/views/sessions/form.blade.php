@php
    $title = isset($session) ? "Modifier la session : " . $session->name : "Ajouter une session";
    $second = "Ecole";
    $url = route('school.sessions.index');
    // $third = "Sessions";
    // $url2 =  route('school.sessions.index');
    $bread = $title;
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                <a href="{{ route('school.sessions.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des sessions
                </a>
            </div>
            <div class="block-content block-content-full">
                <form class="js-validation-material" action="{{ isset($session) ? route('school.sessions.update', $session) : route('school.sessions.store') }}" method="POST">
                    @csrf
                    @isset($session)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($session) ? $session->name : old('name') }}" {{ $errors->has('name') ? '' : '' }}>
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
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-{{ isset($session) ? 'refresh' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
