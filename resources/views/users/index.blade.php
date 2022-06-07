@php
    $profile = auth()->user();
    $title = "Liste des utilisateurs";
    $bread = "Utilisateurs";
    $second = "Paramètres";
    $url = route('settings.profiles.show', $profile);
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
                <a href="{{ route('settings.acl.users.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-plus mr-5"></i> Ajouter un utilisateur
                </a>
            </div>
            <div class="block-content block-content-full">
                <!-- DataTables functionality is initialized with .js-dataTable-full-pagination class in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
                <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Rôle</th>
                            <th>Permissions</th>
                            <th>Sexe</th>
                            <th>Nationalité</th>
                            <th class="d-none d-sm-table-cell" style="width: 15%;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td class="">
                                    @if (is_null($user->picture))
                                        <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $user->name }}">
                                    @else
                                        <img class="img-avatar img-avatar32" src="{{ Storage::url($user->picture) }}" alt="{{ $user->name }}">
                                    @endif
                                    {{ Str::ucfirst($user->name) }}
                                </td>
                                <td>
                                    <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                </td>
                                <td>{{ Str::ucfirst($user->getRoleNames()->first()) }}</td>
                                <td class="text-center"><span class="badge badge-info">{{ $user->getDirectPermissions()->count() }}</span></td>
                                <td class="text-center">{{ $user->gender }}</td>
                                <td>{{ $user->nationality }}</td>
                                <td class="text-center">
                                    <form action="{{ route('settings.acl.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <div class="btn-group" user="group">
                                            <a href="{{ route('settings.acl.users.edit', $user) }}" class="btn btn-sm btn-info" data-toggle="tooltip" title="Modifier l'utilisateur">
                                                <i class="fa fa-pencil"></i>
                                            </a>
                                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-danger" data-toggle="tooltip" title="Supprimer l'utilisateur">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="7">Aucune donnée à afficher</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
