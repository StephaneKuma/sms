{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}

@php
    $title = "Connectez-vous pour accéder au tableau de vord";
@endphp

@extends('layouts.guest')

@push('js')
    <!-- Page JS Code -->
    <script src="{{ asset('js/pages/op_auth_signin.min.js') }}"></script>
@endpush

@section('content')
    <!-- Header -->
    <div class="py-30 px-5 text-center">
        <a class="link-effect font-w700" href="{{ url('/') }}">
            <i class="si si-fire"></i>
            <span class="font-size-xl text-primary-dark">STK</span><span class="font-size-xl">SMS</span>
        </a>
        <h1 class="h2 font-w700 mt-50 mb-10">Bienvenue sur votre tableau de bord</h1>
        <h2 class="h4 font-w400 text-muted mb-0">Veuillez vous connecter</h2>
    </div>
    <!-- END Header -->

    <!-- Sign In Form -->
    <div class="row justify-content-center px-5">
        <div class="col-sm-8 col-md-6 col-xl-4">
            <form class="js-validation-signin" action="{{ route('login') }}" method="post">
                @csrf

                <div class="form-group row">
                    <div class="col-12">
                        <div class="form-material floating">
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            <label for="email">Adresse E-mail</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-12">
                        <div class="form-material floating">
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">
                            <label for="password">Mot de passe</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row gutters-tiny">
                    <div class="col-12 mb-10">
                        <button type="submit" class="btn btn-block btn-hero btn-noborder btn-rounded btn-alt-primary">
                            <i class="si si-login mr-10"></i> Se Connecter
                        </button>
                    </div>
                    <div class="col-sm-6 mb-5">
                        <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ route('register') }}">
                            <i class="fa fa-plus text-muted mr-5"></i> Nouveau Compte
                        </a>
                    </div>
                    <div class="col-sm-6 mb-5">
                        <a class="btn btn-block btn-noborder btn-rounded btn-alt-secondary" href="{{ route('password.request') }}">
                            <i class="fa fa-warning text-muted mr-5"></i> MDP oublié
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Sign In Form -->
@endsection
