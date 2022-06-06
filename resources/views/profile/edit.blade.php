@php
    $profile = auth()->user();
    $title = "Edition du profil utilisateur";
    // $second = "Paramètres";
    // $url = route('profiles.show', $profile);
    // $bread = "Profil";
@endphp

@extends('layouts.app')


@section('content')
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url('{{ asset('media/photos/photo13@2x.jpg') }}');">
        <div class="bg-black-op-75 py-30">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-15">
                    <a class="img-link" href="#">
                        @if (is_null($profile->picture))
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $profile->name }}">
                        @else
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ Storage::url($profile->picture) }}" alt="{{ $profile->name }}">
                        @endif
                    </a>
                </div>
                <!-- END Avatar -->

                @php
                    $profile = auth()->user();
                @endphp

                <!-- Personal -->
                <h1 class="h3 text-white font-w700 mb-10">
                    {{ $profile->name }}
                </h1>
                {{-- <h2 class="h5 text-white-op">
                    Product Manager <a class="text-primary-light" href="javascript:void(0)">@GraphicXspace</a>
                </h2> --}}
                <!-- END Personal -->

                <!-- Actions -->
                <a class="btn btn-rounded btn-hero btn-sm btn-alt-secondary mb-5 px-20" href="{{ route('settings.profiles.show', $profile) }}">
                    <i class="fa fa-arrow-left mr-5"></i> Retour au profile
                </a>
                <!-- END Actions -->
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <div class="content">
        <!-- User Profile -->
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="fa fa-user-circle mr-5 text-muted"></i> Profil Utilisateur
                </h3>
            </div>
            <div class="block-content">
                <form enctype="multipart/form-data" action="{{ route('settings.profiles.update', $profile) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Les informations vitale pour votre compte. Votre nom sera visible au public.
                            </p>
                        </div>
                        <div class="col-lg-7 offset-lg-1">
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="last_name">Nom</label>
                                    <input type="text" class="form-control form-control-lg" id="last_name" name="last_name" placeholder="Entrez votre nom.." value="{{ $profile->last_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="first_name">Prénoms</label>
                                    <input type="text" class="form-control form-control-lg" id="first_name" name="first_name" placeholder="Entrez vos prénoms.." value="{{ $profile->first_name }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <label for="email">Adresse E-mail</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Entrez votre adresse email.." value="{{ $profile->email }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-10 col-xl-6">
                                    <div class="push">
                                        @if (is_null($profile->picture))
                                            <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $profile->name }}">
                                        @else
                                            <img src="{{ Storage::url($profile->picture) }}" alt="{{ $profile->name }}" class="img-avatar">
                                        @endif
                                    </div>
                                    <div class="custom-file">
                                        <!-- Populating custom file input label with the selected filename (data-toggle="custom-file-input" is initialized in Helpers.coreBootstrapCustomFileInput()) -->
                                        <input type="file" class="custom-file-input" id="picture" name="picture" data-toggle="custom-file-input">
                                        <label class="custom-file-label" for="picture">Choisir une image</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-alt-primary">Mettre à jour</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END User Profile -->
    </div>
@endsection
