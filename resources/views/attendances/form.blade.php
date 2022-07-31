@php
$teacher = auth()->user();
$second = 'Mes cours';
$url = route('school.teacher.courses', $teacher);
$bread = 'Prise de présences';
$title = "Classe #{$assignedTeacher->class->name}, Section #{$assignedTeacher->section->name}";
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

                <form class="js-validation-material mt-4"
                    action="{{ route('school.teacher.attendances.store', $assignedTeacher) }}" method="POST">
                    @csrf

                    <input type="hidden" name="session_id" value="{{ $assignedTeacher->session_id }}">
                    <input type="hidden" name="class_id" value="{{ $assignedTeacher->class_id }}">
                    @if ($setting->attendance_type == 'section')
                        <input type="hidden" name="course_id" value="null">
                        <input type="hidden" name="section_id" value="{{ $assignedTeacher->section_id }}">
                    @else
                        <input type="hidden" name="course_id" value="{{ $assignedTeacher->course_id }}">
                        <input type="hidden" name="section_id" value="null">
                    @endif

                    <table class="table table-borderless table-striped table-vcenter">
                        <thead class="thead-light">
                            <tr>
                                <th>#Identifiant</th>
                                <th>Nom de l'élève</th>
                                <th>Présent</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($promotionStudentsData as $promotion)
                                <input type="hidden" name="student_ids[]" value="{{ $promotion->student_id }}">

                                <tr>
                                    <td>{{ $promotion->id_card_number }}</td>
                                    <td>{{ $promotion->student->name }}</td>
                                    <td>
                                        <div class="custom-control custom-checkbox mb-5">
                                            <input type="checkbox" class="" id="status-{{ $promotion->student_id }}"
                                                name="status[{{ $promotion->student_id }}]" checked>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                    @if ($promotionStudentsData->count() > 0 && $attendanceCount < 1)
                        <div class="form-group row">
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-alt-primary">
                                    <i class="fa fa-save mr-5"></i>
                                    Soumettre
                                </button>
                            </div>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
@endsection
