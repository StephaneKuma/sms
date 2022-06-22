@php
    $title = "Promouvoir la promotion";
    $second = "Ecole";
    $url = route('school.classes.index');
    $third = "Promotions";
    $url2 = route('school.promotions.index');
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
                <small class="text-danger">
                    <i class="fa fa-exclamation mr-5"></i>
                    Les élèves ne doivent être promu qu'une seule dans une nouvelle session.
                    Habituellement, l'administateur aura à créer une nouvelle session dès que les
                    activités de la session courante prennent fin.
                </small>
                <form action="{{ route('school.promotions.store') }}" method="POST" class="mt-4">
                    @csrf

                    <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                    <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#ID Card Number</th>
                                <th scope="col">Prénoms</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Classe</th>
                                <th scope="col">Section</th>
                                <th scope="col">Promouvoir à la classe</th>
                                <th scope="col">Promouvoir à la section</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($students as $index => $promotion)
                                <tr>
                                    <td>
                                        <input type="text" class="form-control" name="id_card_number[{{ $promotion->student->id }}]" value="{{ $promotion->id_card_number }}">
                                    </td>
                                    <td>{{ $promotion->student->first_name }}</td>
                                    <td>{{ $promotion->student->last_name }}</td>
                                    <td>{{ $class->name }}</td>
                                    <td>{{ $section->name }}</td>
                                    <td>
                                        <select required onchange="getSections(this, {{ $index }})" id="class_id-{{ $index }}" class="js-select2 form-control" name="class_id[{{ $index }}]" data-placeholder="Choisissez une classe">
                                            <option></option>
                                            @forelse ($classes as $class)
                                                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name }}</option>
                                            @empty
                                                <option value="-1">Veuillez créer une classe</option>
                                            @endforelse
                                        </select>
                                    </td>
                                    <td>
                                        <select required id="section_id-{{ $index }}" class="js-select2 form-control" name="section_id[{{ $index }}]">
                                        </select>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Aucune donnée à afficher</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-outline-primary mb-3">
                        <i class="si si-trophy mr-5"></i>
                        Promouvoir
                    </button>
                </form>
            </div>
        </div>
    </div>

    @include('shared._sections')
@endsection
