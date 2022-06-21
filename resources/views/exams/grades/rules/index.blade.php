@php
    $title = "Liste des règles : " . $system->name . ' - ' . $system->semester->name;
    $second = "Ecole";
    $url = route('school.classes.index');
    $third = "Examen";
    $url2 =  route('school.exams.grading.systems.index');
    $bread = $system->name . ' - ' . $system->semester->name;
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
                <a href="{{ route('school.exams.grading.systems.index') }}" class="btn btn-rounded btn-noborder btn-info mr-5">
                    <i class="fa fa-arrow-left mr-5"></i> Système de graduation
                </a>
                @if (!$system->rules)
                    <a href="{{ route('school.exams.grading.systems.rules.create', $system) }}" class="btn btn-rounded btn-noborder btn-primary">
                        <i class="fa fa-plus mr-5"></i> Ajouter une règle
                    </a>
                @endif
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                    <thead class="thead-light">
                        <tr>
                            <th>Point</th>
                            <th>Mention</th>
                            <th>Début</th>
                            <th>Fin</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rules as $rule)
                            <tr>
                                <td>{{ $rule->mark }}</td>
                                <td>{{ $rule->grade }}</td>
                                <td>{{ $rule->start_at }}</td>
                                <td>{{ $rule->end_at }}</td>
                                <td class="text-center">
                                    <form action="{{ route('school.exams.grading.systems.rules.destroy', $rule) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('school.exams.grading.systems.rules.edit', compact('system', 'rule')) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Modifier la règle">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer la règle">
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
