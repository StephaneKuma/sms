@php
    $title = isset($teacher) ? "Modifier l'enseignant : " . $teacher->name : "Ajouter un enseignant";
    $second = "Ecole";
    $url = route('school.classes.index');;
    $third = "Enseignant";
    $url2 =  route('school.teachers.index');
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
                <a href="{{ route('school.teachers.index') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-arrow-left mr-5"></i> Liste des enseignants
                </a>
            </div>
            <div class="block-content block-content-full">
                <p class="text-danger">Souvenez vous de créer des rôles et des permissions avant de continuer</p>

                <form enctype="multipart/form-data" class="js-validation-material" action="{{ isset($teacher) ? route('school.teachers.update', $teacher) : route('school.teachers.store') }}" method="POST">
                    @csrf
                    @isset($teacher)
                        @method('PATCH')
                    @endisset

                    <div class="form-group row {{ $errors->has('last_name') ? 'is-invalid' : '' }}">
                        <div class="col-md-6">
                            <div class="form-material floating">
                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ isset($teacher) ? $teacher->last_name : old('last_name') }}">
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
                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ isset($teacher) ? $teacher->first_name : old('first_name') }}">
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
                                        <input type="email" class="form-control" id="email" name="email" value="{{ isset($teacher) ? $teacher->email : old('email') }}">
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
                                        <input type="tel" class="js-masked-phone form-control js-masked-enabled" id="phone" name="phone" value="{{ isset($teacher) ? $teacher->phone : old('phone') }}">
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
                                        <input type="text" class="form-control" id="nationality" name="nationality" value="{{ isset($teacher) ? $teacher->nationality : old('nationality') }}">
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
                                            <option value="M" {{ ((isset($teacher) && ($teacher->gender == 'M')) || (old('gender') == 'M')) ? 'selected' : '' }}>Masculin</option>
                                            <option value="F" {{ ((isset($teacher) && ($teacher->gender == 'F')) || (old('gender') == 'F')) ? 'selected' : '' }}>Feminin</option>
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
                                            <option value="A+" {{ (((isset($teacher) && $teacher->blood_type =='A+') || (old('blood_type') == 'A+')) ? 'selected' : '' ) }}>A+</option>
                                            <option value="A-" {{ isset($teacher) ? $teacher->blood_type == 'A-' ? 'selected' : '' : '' }}>A-</option>
                                            <option value="B+" {{ isset($teacher) ? $teacher->blood_type == 'B+' ? 'selected' : '' : '' }}>B+</option>
                                            <option value="B-" {{ isset($teacher) ? $teacher->blood_type == 'B-' ? 'selected' : '' : '' }}>B-</option>
                                            <option value="O+" {{ isset($teacher) ? $teacher->blood_type == 'O+' ? 'selected' : '' : '' }}>O+</option>
                                            <option value="O-" {{ isset($teacher) ? $teacher->blood_type == 'O-' ? 'selected' : '' : '' }}>O-</option>
                                            <option value="AB+" {{ isset($teacher) ? $teacher->blood_type == 'AB+' ? 'selected' : '' : '' }}>AB+</option>
                                            <option value="AB-" {{ isset($teacher) ? $teacher->blood_type == 'AB-' ? 'selected' : '' : '' }}>AB-</option>
                                            <option value="Autres" {{ isset($teacher) ? $teacher->blood_type == 'Autres' ? 'selected' : '' : '' }}>Autres</option>
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
                                            <option value="Islame" {{ ((isset($teacher) && $teacher->religion == 'Islame') || (old('religion') == 'Islame')) ? 'selected' : '' }}>Islame</option>
                                            <option value="Hinduisme" {{ ((isset($teacher) && $teacher->religion == 'Hinduisme') || (old('religion') == 'Hinduisme')) ? 'selected' : '' }}>Hinduisme</option>
                                            <option value="Christianisme" {{ ((isset($teacher) && $teacher->religion == 'Christianisme') || (old('religion') == 'Christianisme')) ? 'selected' : '' }}>Christianisme</option>
                                            <option value="Buddhisme" {{ ((isset($teacher) && $teacher->religion == 'Buddhisme') || (old('religion') == 'Buddhisme')) ? 'selected' : '' }}>Buddhisme</option>
                                            <option value="Judaisme" {{ ((isset($teacher) && $teacher->religion == 'Judaisme') || (old('religion') == 'Judaisme')) ? 'selected' : '' }}>Judaisme</option>
                                            <option value="Autres" {{ ((isset($teacher) && $teacher->religion == 'Autres') || (old('religion') == 'Autres')) ? 'selected' : '' }}>Autres</option>
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
                                        <input type="text" class="form-control" id="address" name="address" value="{{ isset($teacher) ? $teacher->address : old('address') }}">
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
                                        <input type="text" class="form-control" id="address2" name="address2" value="{{ isset($teacher) ? $teacher->address2 : old('address2') }}">
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
                                        <input type="text" class="form-control" id="city" name="city" value="{{ isset($teacher) ? $teacher->city : old('city') }}">
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
                                        <input type="text" class="js-flatpickr form-control" data-date-format="d-m-Y" id="birthday" name="birthday" value="{{ isset($teacher) ? $teacher->birthday : old('birthday') }}">
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
                                        <input type="text" class="form-control" id="zip" name="zip" value="{{ isset($teacher) ? $teacher->zip : old('zip') }}">
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
                        @isset($teacher)
                            <div class="col-12">
                                @if (is_null($teacher->picture))
                                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $teacher->name }}">
                                @else
                                    <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ Storage::url($teacher->picture) }}" alt="{{ $teacher->name }}">
                                @endif
                            </div>
                        @endisset
                        <div class="col-12">
                            <div class="form-material floating">
                                <input type="file" class="form-control" id="picture" name="picture" value="{{ isset($teacher) ? $teacher->picture : old('picture') }}">
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
                        <input type="hidden" name="role" value="{{ $role->id }}">
                    </div>

                    <div class="form-group row">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-alt-primary">
                                <i class="fa fa-{{ isset($teacher) ? 'refresh' : 'save' }} mr-5"></i>
                                Soumettre
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
