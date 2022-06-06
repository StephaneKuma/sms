{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@php
    $title = "Créer un compte sur STK SMS";
@endphp

@extends('layouts.guest')

@push('js')
    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/op_auth_signup.min.js') }}"></script>
@endpush

@section('content')
    <!-- Header -->
    <div class="py-30 px-5 text-center">
        <a class="link-effect font-w700" href="{{ url('/') }}">
            <i class="si si-fire"></i>
            <span class="font-size-xl text-primary-dark">STK</span><span class="font-size-xl">SMS</span>
        </a>
        <h1 class="h2 font-w700 mt-50 mb-10">Créer Un Nouveau Compte</h1>
        <h2 class="h4 font-w400 text-muted mb-0">Entrez vos informations</h2>
    </div>
    <!-- END Header -->

    <!-- Sign Up Form -->
    <div class="row justify-content-center px-5">
        <div class="col-sm-8 col-md-6 col-xl-4">
            <form class="js-validation-material" action="{{ route('register') }}" method="post">
                @csrf

                <div class="form-group row {{ $errors->has('last_name') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}">
                            <label for="last_name">Nom</label>
                        </div>
                        @error('last_name')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('first_name') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material floating">
                            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}">
                            <label for="first_name">Prénom(s)</label>
                        </div>
                        @error('first_name')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('email') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material floating">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            <label for="email">Adresse E-mail</label>
                        </div>
                        @error('email')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('password') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material floating">
                            <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
                            <label for="password">Mot de passe</label>
                        </div>
                        @error('password')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                    <div class="col-12">
                        <div class="form-material floating">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                            <label for="password_confirmation">Confirmez le mot de passe</label>
                        </div>
                        @error('password_confirmation')
                            <div class="invalid-feedback animated fadeInDown">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row text-center">
                    <div class="col-12">
                        <label class="css-control css-control-primary css-checkbox">
                            <input type="checkbox" class="css-control-input" id="signup-terms" name="signup-terms">
                            <span class="css-control-indicator"></span>
                            J'accepte les Termes &amp; Conditions
                        </label>
                    </div>
                </div>
                <div class="form-group row gutters-tiny">
                    <div class="col-12 mb-10">
                        <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-success">
                            <i class="si si-user-follow mr-10"></i> S'inscrire
                        </button>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="#" data-toggle="modal" data-target="#modal-terms">
                            <i class="si si-book-open text-muted mr-10"></i> Lire Les Termes
                        </a>
                    </div>
                    <div class="col-6">
                        <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ route('login') }}">
                            <i class="si si-login text-muted mr-10"></i> Se Connecter
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Sign Up Form -->
@endsection

@section('modal')
    <!-- Terms Modal -->
    <div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-slidedown" role="document">
            <div class="modal-content">
                <div class="block block-themed block-transparent mb-0">
                    <div class="block-header bg-primary-dark">
                        <h3 class="block-title">Termes &amp; Conditions</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                        <p>Potenti elit lectus augue eget iaculis vitae etiam, ullamcorper etiam bibendum ad feugiat magna accumsan dolor, nibh molestie cras hac ac ad massa, fusce ante convallis ante urna molestie vulputate bibendum tempus ante justo arcu erat accumsan adipiscing risus, libero condimentum venenatis sit nisl nisi ultricies sed, fames aliquet consectetur consequat nostra molestie neque nullam scelerisque neque commodo turpis quisque etiam egestas vulputate massa, curabitur tellus massa venenatis congue dolor enim integer luctus, nisi suscipit gravida fames quis vulputate nisi viverra luctus id leo dictum lorem, inceptos nibh orci.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Fermer</button>
                    <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                        <i class="fa fa-check"></i> Parfait
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Terms Modal -->
@endsection
