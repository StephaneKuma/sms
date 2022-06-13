@php
    $title = "Liste des systèmes de graduations";
    $second = "Ecole";
    $url = route('school.classes.index');
    $bread = "Graduations";
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
                <a href="{{ route('school.exams.grading.systems.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-plus mr-5"></i> Ajouter un système
                </a>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                    <thead class="thead-light">
                        <tr>
                            <th>Nom</th>
                            <th>Classe</th>
                            <th>Semestre</th>
                            <th>Créé le</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($systems as $system)
                            <tr>
                                <td>{{ $system->name }}</td>
                                <td>{{ $system->class->name }}</td>
                                <td>{{ $system->semester->name }}</td>
                                <th>{{ $system->created_at }}</th>
                                <td class="text-center">
                                    <form action="{{ route('school.exams.grading.systems.destroy', $system) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        {{-- <div class="btn-group mr-5" role="group">
                                            @if (!$system->rule)
                                                <a href="{{ route('school.exams.grades.rules.create', $system) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Ajouter une condition">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            @endif
                                            @if ($system->rule)
                                                <a href="{{ route('school.exams.grades.rules.index', $system) }}" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" title="Voir la condition">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @endif
                                        </div> --}}

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('school.exams.grading.systems.edit', $system) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Modifier le système">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer le système">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="5">Aucune donnée à afficher</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
