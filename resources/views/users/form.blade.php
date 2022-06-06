@php
    $profile = auth()->user();
    $title = isset($user) ? "Modifier l'utilisateur' : " . $user->name : "Ajouter un utilisateur";
    $second = "Paramètres";
    $url = route('settings.profiles.show', $profile);
    $third = "Utilisateur";
    $url2 =  route('settings.acl.users.index');
    $bread = $title;
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')
        
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                <a href="{{ route('settings.acl.users.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des utilisateurs
                </a>
            </div>
            <div class="block-content block-content-full">
                <form class="js-validation-material" action="{{ isset($user) ? route('settings.acl.users.update', $user) : route('settings.acl.users.store') }}" method="POST">
                    @csrf
                    @isset($user)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row {{ $errors->has('last_name') ? 'is-invalid' : '' }}">
                        <div class="col-md-6">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($user) ? $user->last_name : old('last_name') }}">
                                <label for="last_name">Nom</label>
                            </div>
                            @error('last_name')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ isset($user) ? $user->first_name : old('first_name') }}">
                                <label for="first_name">Prénoms</label>
                            </div>
                            @error('first_name')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('email') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="email" class="form-control" id="email" name="email" value="{{ isset($user) ? $user->email : old('email') }}">
                                        <label for="email">Adresse Email</label>
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="tel" class="form-control" id="phone" name="phone" value="{{ isset($user) ? $user->phone : old('phone') }}">
                                        <label for="phone">Téléphone</label>
                                    </div>
                                    @error('phone')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('nationality') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ isset($user) ? $user->nationality : old('nationality') }}">
                                        <label for="nationality">Nationalité</label>
                                    </div>
                                    @error('nationality')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('gender') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <select id="gender" class="form-control" name="gender">
                                            <option value="Male" {{ old('gender') == 'male' ? 'selected' : '' }}>Masculin</option>
                                            <option value="Female" {{ old('gender') == 'female' ? 'selected' : '' }}>Feminin</option>
                                        </select>
                                        <label for="gender">Sexe</label>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('blood_type') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <select class="form-control" id="blood_type" name="blood_type" size="1">
                                            <option {{ old('blood_type') == 'A+' ? 'selected' : '' }}>A+</option>
                                            <option {{ old('blood_type') == 'A-' ? 'selected' : '' }}>A-</option>
                                            <option {{ old('blood_type') == 'B+' ? 'selected' : '' }}>B+</option>
                                            <option {{ old('blood_type') == 'B-' ? 'selected' : '' }}>B-</option>
                                            <option {{ old('blood_type') == 'O+' ? 'selected' : '' }}>O+</option>
                                            <option {{ old('blood_type') == 'O-' ? 'selected' : '' }}>O-</option>
                                            <option {{ old('blood_type') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                            <option {{ old('blood_type') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                            <option {{ old('blood_type') == 'other' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        <label for="blood_type">Groupe sangin</label>
                                    </div>
                                    @error('blood_type')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('religion') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <select id="religion" class="form-control" name="religion" required>
                                            <option {{ old('religion') == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option {{ old('religion') == 'Hinduism' ? 'selected' : '' }}>Hinduism</option>
                                            <option {{ old('religion') == 'Christianity' ? 'selected' : '' }}>Christianisme</option>
                                            <option {{ old('religion') == 'Buddhism' ? 'selected' : '' }}>Buddhisme</option>
                                            <option {{ old('religion') == 'Judaism' ? 'selected' : '' }}>Judaisme</option>
                                            <option {{ old('religion') == 'Others' ? 'selected' : '' }}>Autre</option>
                                        </select>
                                        <label for="religion">Réligion</label>
                                    </div>
                                    @error('religion')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('address') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="address" name="address" value="{{ isset($user) ? $user->address : old('address') }}">
                                        <label for="address">Adresse</label>
                                    </div>
                                    @error('address')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('address2') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="address2" name="address2" value="{{ isset($user) ? $user->address2 : old('address2') }}">
                                        <label for="address2">Adresse 2</label>
                                    </div>
                                    @error('address2')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('city') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="city" name="city" value="{{ isset($user) ? $user->city : old('city') }}">
                                        <label for="city">Ville</label>
                                    </div>
                                    @error('city')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('birthday') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="date" class="form-control" id="birthday" name="birthday" value="{{ isset($user) ? $user->birthday : old('birthday') }}">
                                        <label for="birthday">Date de naissance</label>
                                    </div>
                                    @error('birthday')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('address2') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="address2" name="address2" value="{{ isset($user) ? $user->address2 : old('address2') }}">
                                        <label for="address2">Adresse 2</label>
                                    </div>
                                    @error('address2')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row{{ $errors->has('city') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="city" name="city" value="{{ isset($user) ? $user->city : old('city') }}">
                                        <label for="city">Ville</label>
                                    </div>
                                    @error('city')
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
                                <i class="fa fa-{{ isset($user) ? 'refresh' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
