@php
    $title = "Liste des élèves";
    $bread = "Elèves";
    $second = "Ecole";
    $url = route('school.classes.index');
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

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                @can('create users')
                    <a href="{{ route('school.students.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                        <i class="fa fa-plus mr-5"></i> Ajouter un élève
                    </a>
                @endcan
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                    <thead class="thead-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            {{-- <th>Permissions</th> --}}
                            <th>Sexe</th>
                            <th>Nationalité</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($students as $student)
                            <tr>
                                <td class="">
                                    @if (is_null($student->picture))
                                        <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $student->name }}">
                                    @else
                                        <img class="img-avatar img-avatar32" src="{{ Storage::url($student->picture) }}" alt="{{ $student->name }}">
                                    @endif
                                    {{ Str::ucfirst($student->name) }}
                                </td>
                                <td>
                                    <a href="mailto:{{ $student->email }}" data-toggle="tooltip" title="Cliquer pour envoyer un mail">
                                        {{ $student->email }}
                                        <i class="si si-paper-plane ml-1"></i>
                                    </a>
                                </td>
                                {{-- <td class="text-center"><span class="badge badge-info">{{ $student->getDirectPermissions()->count() }}</span></td> --}}
                                <td class="text-center">{{ $student->gender }}</td>
                                <td>{{ $student->nationality }}</td>
                                <td class="text-center">
                                    <div class="btn-group" user="group">
                                        @can('edit users')
                                            <a href="{{ route('school.students.edit', $student) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Modifier l'élève">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                        @endcan
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
