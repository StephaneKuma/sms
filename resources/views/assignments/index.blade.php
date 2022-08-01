@php
$teacher = auth()->user();
$second = 'Mes cours';
$url = route('school.teacher.courses', $teacher);
$bread = 'Devoirs';
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block block-rounded">
            <div class="block-content block-content-full bg-white">
                {{-- <span class="text-xl text-info bg-white">Date et heure actuelles: {{ date('H:i:s d-m-Y') }}</span> --}}

                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                    <thead class="thead-light">
                        <tr>
                            <th>Classe</th>
                            <th>Cours</th>
                            <th class="">Nom</th>
                            <th class="text-center">Fichier</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($assignments as $assignment)
                            <tr>
                                <td>{{ $assignment->class->name }}</td>
                                <td>{{ $assignment->course->name }}</td>
                                <td>{{ $assignment->name }}</td>
                                <td class="text-center">
                                    <form action="{{ route('download') }}" method="post">
                                        @csrf
                                        <input name="downloadable" type="hidden" value="{{ $assignment->path }}">
                                        <input type="hidden" name="name" value="{{ $assignment->name }}">
                                        <button type="submit" class="btn btn-sm btn-outline-primary" data-toggle="tooltip"
                                            title="Télécharger le fichier">
                                            <i class="si si-doc"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="4">Aucune donnée à afficher</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
