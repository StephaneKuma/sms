@php
$title = "Routine, Classe #{$routine->class->name}, Section #{$routine->section->name}";
$second = 'Ecole';
$url = route('school.classes.index');
// $third = 'Routines';
// $url2 = '#';
$bread = 'Routines';
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                {{-- <a href="{{ route('school.classes.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-plus mr-5"></i> Ajouter une classe
                </a> --}}
            </div>
            <div class="block-content block-content-full">
                @if ($routines->count())
                    @php
                        function getDayName($weekday)
                        {
                            if ($weekday == 1) {
                                return 'LUNDI';
                            } elseif ($weekday == 2) {
                                return 'MARDI';
                            } elseif ($weekday == 3) {
                                return 'MERCREDI';
                            } elseif ($weekday == 4) {
                                return 'JEUDI';
                            } elseif ($weekday == 5) {
                                return 'VENDREDI';
                            } elseif ($weekday == 6) {
                                return 'SAMEDI';
                            } elseif ($weekday == 7) {
                                return 'DIMANCHE';
                            } else {
                                return 'PAS DE JOURS';
                            }
                        }
                    @endphp

                    <div class="p-3 border shadow-sm">
                        <table class="table table-bordered text-center">
                            <tbody>
                                @foreach ($routines as $day => $groupedRoutines)
                                    <tr>
                                        <th>{{ getDayName($day) }}</th>
                                        @php
                                            $sortedRoutines = $groupedRoutines->sortBy('start_at');
                                        @endphp
                                        @foreach ($sortedRoutines as $routine)
                                            <td>
                                                <span>{{ $routine->course->name }}</span>
                                                <div>{{ $routine->start_at }} - {{ $routine->end_at }}</div>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
