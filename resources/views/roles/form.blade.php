@php
    $profile = auth()->user();
    $title = isset($role) ? "Modifier le rôle : " . $role->name : "Ajouter un rôle";
    $second = "Paramètres";
    $url = route('settings.profiles.show', $profile);
    $third = "Rôles";
    $url2 =  route('settings.acl.roles.index');
    $bread = $title;
@endphp

@extends('layouts.app')

@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables/dataTables.bootstrap4.css') }}">
@endpush

@push('js')
    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/be_tables_datatables.min.js') }}"></script>
@endpush

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')
        
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                <a href="{{ route('settings.acl.roles.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des rôles
                </a>
            </div>
            <div class="block-content block-content-full">
                <form class="js-validation-material" action="{{ isset($role) ? route('settings.acl.roles.update', $role) : route('settings.acl.roles.store') }}" method="POST">
                    @csrf
                    @isset($role)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($role) ? $role->name : old('name') }}" {{ $errors->has('name') ? '' : '' }}>
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
                                <i class="fa fa-{{ isset($role) ? 'reload' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
