@php
$title = 'Liste des cours';
$bread = 'Mes cours';
$second = 'Ecole';
$url = '#';
$teacher = auth()->user();
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
                {{-- <a href="{{ route('school.courses.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-plus mr-5"></i> Ajouter un cours
                </a> --}}
            </div>
            <div class="block-content block-content-full">
                <h6>Filtrer par :</h6>
                <form action="{{ route('school.teacher.courses', $teacher) }}" method="GET">
                    @csrf

                    <div class="form-group row{{ $errors->has('semester_id') ? 'is-invalid' : '' }}">
                        <div class="col-3">
                            <div class="form-group">
                                <div class="form-material">
                                    <select onchange="this.closest('form').submit()" id="semester_id"
                                        class="js-select2 form-control" name="semester_id"
                                        data-placeholder="Choisissez un semester">
                                        <option></option>
                                        @forelse ($semesters as $semester)
                                            <option value="{{ $semester->id }}"
                                                {{ $semesterId == $semester->id ? 'selected' : '' }}>{{ $semester->name }}
                                            </option>
                                        @empty
                                            <option value="-1">Veuillez créer un semestre</option>
                                        @endforelse
                                    </select>
                                </div>
                                @error('semester_id')
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
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Classe</th>
                            <th>Section</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assignedTeacherData as $assignedTeacher)
                            <tr>
                                <td>{{ $assignedTeacher->course->name }}</td>
                                <td>{{ $assignedTeacher->course->type }}</td>
                                <td>{{ $assignedTeacher->class->name }}</td>
                                <td>{{ $assignedTeacher->section->name }}</td>
                                <td class="text-center">

                                    <div class="btn-group" role="group">
                                        <a id="{{ $assignedTeacher->course_id }}" href="javascript:void()"
                                            class="btn btn-sm btn-outline-info dropdown-toggle" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="si si-direction"></i>
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="{{ $assignedTeacher->course_id }}">
                                            <a class="dropdown-item" href="{{ route('school.teacher.attendances.create', $assignedTeacher) }}">
                                                <i class="fa fa-fw fa-calendar mr-5"></i>Contôle de présences
                                            </a>
                                            <a class="dropdown-item" href="{{ route('school.teacher.attendances.show', $assignedTeacher) }}">
                                                <i class="fa fa-fw fa-list mr-5"></i>Liste de présence
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-book mr-5"></i>Créer un devoir
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-check mr-5"></i>Donnez des notes
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-clipboard mr-5"></i>Voir les résultats finaux
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="javascript:void(0)">
                                                <i class="fa fa-fw fa-bullhorn mr-5"></i>Messages aux élèves
                                            </a>
                                        </div>
                                    </div>

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
