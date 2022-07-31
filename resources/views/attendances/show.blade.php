@php
$teacher = auth()->user();
$second = 'Mes cours';
$url = route('school.teacher.courses', $teacher);
$bread = 'Liste de présence';
$title = "Cours: {$assignedTeacher->course->name}";
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')

        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-calendar mr-5"></i>
                    <span>{{ $title }}</span>
                </h3>
            </div>
        </div>

        <div class="block block-rounded">
            <div class="block-content block-content-full bg-white">
                <span class="text-xl text-info bg-white">Date et heure actuelles: {{ date('H:i:s d-m-Y') }}</span>

                <table class="table table-borderless table-striped table-vcenter mt-4">
                    <thead class="thead-light">
                        <tr>
                            <th>Nom de l'élève</th>
                            <th class="text-center">Status d'aujourd'hui</th>
                            <th class="text-center">Total présence</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($attendances as $attendance)
                            @php
                                $totalAttended = \App\Models\Attendance::where('student_id', $attendance->student_id)
                                    ->where('session_id', $attendance->session_id)
                                    ->count();
                            @endphp

                            <tr>
                                <td>{{ $attendance->student->name }}</td>
                                <td class="text-center">
                                    @if ($attendance->status == 'on')
                                        <span class="badge bg-success">PRESENT</span>
                                    @else
                                        <span class="badge bg-danger">ABSCENT</span>
                                    @endif
                                </td>
                                <td class="text-center">{{ $totalAttended }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">Aucune donnée à afficher</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
