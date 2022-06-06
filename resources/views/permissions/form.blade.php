@php
    $profile = auth()->user();
    $title = isset($permission) ? "Modifier la permission : " . $permission->name : "Ajouter une permission";
    $second = "Paramètres";
    $url = route('settings.profiles.show', $profile);
    $third = "Permissions";
    $url2 =  route('settings.acl.permissions.index');
    $bread = $title;
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')
        
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                <a href="{{ route('settings.acl.permissions.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des permissions
                </a>
            </div>
            <div class="block-content block-content-full">
                <form class="js-validation-material" action="{{ isset($permission) ? route('settings.acl.permissions.update', $permission) : route('settings.acl.permissions.store') }}" method="POST">
                    @csrf
                    @isset($permission)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row {{ $errors->has('name') ? 'is-invalid' : '' }}">
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="name" name="name" value="{{ isset($permission) ? $permission->name : old('name') }}" {{ $errors->has('name') ? '' : '' }}>
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
                                <i class="fa fa-{{ isset($permission) ? 'refresh' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
