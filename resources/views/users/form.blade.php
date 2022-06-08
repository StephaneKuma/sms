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
    <script>jQuery(function(){ Codebase.helpers(['flatpickr', 'datepicker', 'colorpicker', 'maxlength', 'select2', 'masked-inputs', 'rangeslider', 'tags-inputs']); });</script>
@endpush

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
                <form enctype="multipart/form-data" class="js-validation-material" action="{{ isset($user) ? route('settings.acl.users.update', $user) : route('settings.acl.users.store') }}" method="POST">
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
                                        <input type="tel" class="js-masked-phone form-control js-masked-enabled" id="phone" name="phone" value="{{ isset($user) ? $user->phone : old('phone') }}">
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
                                    <div class="form-material">
                                        <select id="gender" class="js-select2 form-control" name="gender" data-placeholder="Choisissez un genre">
                                            <option></option>
                                            <option value="M" {{ ((isset($user) && ($user->gender == 'M')) || (old('gender') == 'M')) ? 'selected' : '' }}>Masculin</option>
                                            <option value="F" {{ ((isset($user) && ($user->gender == 'F')) || (old('gender') == 'F')) ? 'selected' : '' }}>Feminin</option>
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
                                    <div class="form-material">
                                        <select class="js-select2 form-control" id="blood_type" name="blood_type" size="1" data-placeholder="Choisissez un groupe">
                                            <option></option>
                                            <option value="A+" {{ (((isset($user) && $user->blood_type =='A+') || (old('blood_type') == 'A+')) ? 'selected' : '' ) }}>A+</option>
                                            <option value="A-" {{ isset($user) ? $user->blood_type == 'A-' ? 'selected' : '' : '' }}>A-</option>
                                            <option value="B+" {{ isset($user) ? $user->blood_type == 'B+' ? 'selected' : '' : '' }}>B+</option>
                                            <option value="B-" {{ isset($user) ? $user->blood_type == 'B-' ? 'selected' : '' : '' }}>B-</option>
                                            <option value="O+" {{ isset($user) ? $user->blood_type == 'O+' ? 'selected' : '' : '' }}>O+</option>
                                            <option value="O-" {{ isset($user) ? $user->blood_type == 'O-' ? 'selected' : '' : '' }}>O-</option>
                                            <option value="AB+" {{ isset($user) ? $user->blood_type == 'AB+' ? 'selected' : '' : '' }}>AB+</option>
                                            <option value="AB-" {{ isset($user) ? $user->blood_type == 'AB-' ? 'selected' : '' : '' }}>AB-</option>
                                            <option value="Autres" {{ isset($user) ? $user->blood_type == 'Autres' ? 'selected' : '' : '' }}>Autres</option>
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
                                    <div class="form-material">
                                        <select id="religion" class="js-select2 form-control" name="religion" data-placeholder="Choisissez une réligion">
                                            <option></option>
                                            <option value="Islame" {{ ((isset($user) && $user->religion == 'Islame') || (old('religion') == 'Islame')) ? 'selected' : '' }}>Islame</option>
                                            <option value="Hinduisme" {{ ((isset($user) && $user->religion == 'Hinduisme') || (old('religion') == 'Hinduisme')) ? 'selected' : '' }}>Hinduisme</option>
                                            <option value="Christianisme" {{ ((isset($user) && $user->religion == 'Christianisme') || (old('religion') == 'Christianisme')) ? 'selected' : '' }}>Christianisme</option>
                                            <option value="Buddhisme" {{ ((isset($user) && $user->religion == 'Buddhisme') || (old('religion') == 'Buddhisme')) ? 'selected' : '' }}>Buddhisme</option>
                                            <option value="Judaisme" {{ ((isset($user) && $user->religion == 'Judaisme') || (old('religion') == 'Judaisme')) ? 'selected' : '' }}>Judaisme</option>
                                            <option value="Autres" {{ ((isset($user) && $user->religion == 'Autres') || (old('religion') == 'Autres')) ? 'selected' : '' }}>Autres</option>
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
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('birthday') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="js-flatpickr form-control" data-date-format="d-m-Y" id="birthday" name="birthday" value="{{ isset($user) ? $user->birthday : old('birthday') }}">
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
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('zip') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="text" class="form-control" id="zip" name="zip" value="{{ isset($user) ? $user->zip : old('zip') }}">
                                        <label for="zip">Zip</label>
                                    </div>
                                    @error('zip')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row{{ $errors->has('picture') ? 'is-invalid' : '' }}">
                        @isset($user)
                            <div class="col-12">
                                @if (is_null($user->picture))
                                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $user->name }}">
                                @else
                                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ Storage::url($user->picture) }}" alt="{{ $user->name }}">
                                @endif
                            </div>
                        @endisset
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="file" class="form-control" id="picture" name="picture" value="{{ isset($user) ? $user->picture : old('picture') }}">
                                <label for="picture">Photo</label>
                            </div>
                            @error('picture')
                                <div class="invalid-feedback animated fadeInDown">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('password') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="{{ old('password') }}" autocomplete="new-password">
                                        <label for="password">Mot de passe</label>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material floating">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                                        <label for="password_confirmation">Confirmez le mot de passe</label>
                                    </div>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('role') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select id="role" class="js-select2 form-control" name="role" data-placeholder="Choisissez un rôle">
                                            <option></option>
                                            @forelse ($roles as $role)
                                                <option value="{{ $role->id }}" {{ ((isset($user) && $user->hasRole($role)) || old('role') == '$role->id') ? 'selected' : '' }}>{{ $role->name }}</option>
                                            @empty
                                                <option value="-1"><a href="{{ route('settings.acl.roles.create') }}">Veuillez créer un rôle</a></option>
                                            @endforelse
                                        </select>
                                        <label for="role">Rôle</label>
                                    </div>
                                    @error('role')
                                        <div class="invalid-feedback animated fadeInDown">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row{{ $errors->has('permissions') ? 'is-invalid' : '' }}">
                                <div class="col-12">
                                    <div class="form-material">
                                        <select style="width: 100%;" class="js-select2 form-control bg-blue" id="permissions" name="permissions[]" data-placeholder="Choisissez les permissions" multiple>
                                            <option></option>
                                            @forelse ($permissions as $permission)
                                                <option {{ old('permissions') == $permission->id ? 'selected' : '' }} valuue="{{ $permission->id }}">{{ $permission->name }}</option>
                                            @empty
                                                <option value="-1"><a href="{{ route('settings.acl.permissions.create') }}">Veuillez créer une permission</a></option>
                                            @endforelse
                                        </select>
                                        <label for="permissions">Permissions</label>
                                    </div>
                                    @error('permissions')
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
