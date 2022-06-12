@php
    $title = "Liste des conditions : " . $exam->name . ' - ' . $exam->course->name;
    $second = "Ecole";
    $url = route('school.classes.index');
    $third = "Examen";
    $url2 =  route('school.exams.index');
    $bread = $exam->name . ' - ' . $exam->course->name;
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
                <a href="{{ route('school.exams.index') }}" class="btn btn-rounded btn-noborder btn-info mr-5">
                    <i class="fa fa-arrow-left mr-5"></i> Examens
                </a>
                @if (!$exam->rule)
                    <a href="{{ route('school.exams.rules.create', $exam) }}" class="btn btn-rounded btn-noborder btn-primary">
                        <i class="fa fa-plus mr-5"></i> Ajouter une condition
                    </a>
                @endif
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                    <thead class="thead-light">
                        <tr>
                            <th>Examen</th>
                            <th>Cours</th>
                            <th>Point Total</th>
                            <th>Moyenne</th>
                            <th>Note</th>
                            <th class="d-none d-sm-table-cell text-center" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rules as $rule)
                            <tr>
                                <td>{{ $rule->exam->name }}</td>
                                <td>{{ $rule->exam->course->name }}</td>
                                <td>{{ $rule->total_mark }}</td>
                                <td>{{ $rule->pass_mark }}</td>
                                <td>{{ $rule->note }}</td>
                                <td class="text-center">
                                    <form action="{{ route('school.exams.rules.destroy', $rule) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('school.exams.rules.edit', compact('exam', 'rule')) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Modifier la condition">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer la condition">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="8">Aucune donnée à afficher</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
