@php
    $title = "Liste des promotions";
    $second = "Ecole";
    $url = route('school.classes.index');
    $bread = "Promotions";
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
    <script>jQuery(function(){ Codebase.helpers(['flatpickr', 'datepicker', 'select2',]); });</script>
@endpush

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
            </div>
            <div class="block-content block-content-full">
                <h6>Filtrer par :</h6>
                <form  action="{{ route('school.promotions.index') }}" method="GET">
                    @csrf

                    <div class="form-group row{{ $errors->has('class_id') ? 'is-invalid' : '' }}">
                        <div class="col-3">
                            <div class="form-group">
                                <div class="form-material">
                                    <select onchange="this.closest('form').submit()" id="class_id" class="js-select2 form-control" name="class_id" data-placeholder="Choisissez une classe">
                                        <option></option>
                                        @forelse ($previousSessionClasses as $promotion)
                                            <option value="{{ $promotion->class_id }}" {{ old('class_id') == $promotion->class_id ? 'selected' : '' }}>{{ $promotion->class->name }}</option>
                                        @empty
                                            <option value="-1">Veuillez créer une classe</option>
                                        @endforelse
                                    </select>
                                </div>
                                @error('class_id')
                                    <div class="invalid-feedback animated fadeInDown">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </form>

                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Statut de la promotion</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($previousSessionSections as $promo)
                            <tr>
                                <td>{{ $promo->section->name }}</td>
                                <td>
                                    <span class="badge badge-{{ $currentSessionSectionsCount > 0 ? 'success' : 'danger' }}">
                                        {{ $currentSessionSectionsCount > 0 ? 'Promu' : 'Non Promu' }}
                                    </span>
                                </td>
                                <td>
                                    @if ($currentSessionSectionsCount > 0)
                                        Aucune action requise
                                    @else
                                        <a href="{{ route('school.promotions.create', [
                                            'previousSessionId' => $previousSessionId,
                                            'previousClassId' => $promo->section->class->id,
                                            'previousSectionId' => $promo->section_id,
                                        ]) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="si si-trophy mr-5"></i>
                                            Promouvoir
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Aucune donnée à afficher</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
