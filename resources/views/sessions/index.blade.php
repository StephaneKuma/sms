@php
    $title = "Liste des sessions";
    $bread = "Sessions";
    $second = "Ecole";
    $url = route('school.sessions.index');
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
                <a href="{{ route('school.sessions.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-plus mr-5"></i> Ajouter une session
                </a>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                    <thead class="thead-light">
                        <tr>
                            <th>Nom</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sessions as $session)
                            <tr>
                                <td class="">
                                    {{ $session->name }}
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('school.sessions.destroy', $session) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="btn-group" role="group">
                                            <a href="{{ route('school.sessions.edit', $session) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Modifier la session">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer la session">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="2">Aucune donnée à afficher</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
