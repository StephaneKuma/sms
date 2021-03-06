@php
    $title = "Liste des classes";
    $bread = "Classes";
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

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
                {{-- <a href="{{ route('school.classes.create') }}" class="btn btn-rounded btn-noborder btn-primary">
                    <i class="fa fa-plus mr-5"></i> Ajouter une classe
                </a> --}}
            </div>
            <div class="block-content block-content-full">
                @foreach ($classes as $class)
                <!-- Block Tabs Alternative Style -->
                    <div class="block mb-5">
                        <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#class-{{ $class->id }}">{{ $class->name }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#class-{{ $class->id }}-syllabi">Syllabi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#class-{{ $class->id }}-courses">Cours</a>
                            </li>
                            <li class="nav-item ml-auto">
                                <div class="block-options mr-15">
                                    <span>
                                        Total section : <span class="badge badge-info">{{ $class->sections_count }}</span>
                                    </span>
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"><i class="si si-size-fullscreen"></i></button>
                                    <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"><i class="si si-arrow-up"></i></button>
                                </div>
                            </li>
                        </ul>
                        <div class="block-content tab-content">
                            <div class="tab-pane active" id="class-{{ $class->id }}" role="tabpanel">
                                <div id="accordion-{{ $class->id }}" role="tablist" aria-multiselectable="true">
                                    @foreach ($class->sections as $section)
                                        <div class="block block-bordered block-rounded mb-2">
                                            <div class="block-header" role="tab" id="accordion_h{{ $section->id }}">
                                                <a class="font-w600" data-toggle="collapse"
                                                    data-parent="#accordion-{{ $class->id }}"
                                                    href="#accordion_q{{ $section->id }}" aria-expanded="true"
                                                    aria-controls="accordion_q{{ $section->id }}">
                                                    {{ $section->name }}
                                                </a>
                                            </div>
                                            <div id="accordion_q{{ $section->id }}" class="collapse" role="tabpanel"
                                                aria-labelledby="accordion_h{{ $section->id }}"
                                                data-parent="#accordion-{{ $class->id }}">
                                                <div class="block-content">
                                                    <p class="lead d-flex justify-content-between">
                                                        <span>Salle N??: {{ $section->room_no }}</span>
                                                        <span>
                                                            <a href="{{ route('settings.sections.edit', $section) }}"
                                                                role="button" class="btn btn-sm btn-outline-primary">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                        </span>
                                                    </p>
                                                    <div class="list-group mb-4">
                                                        {{-- <form action="{{ route('school.students.index') }}" method="GET">
                                                        </form> --}}
                                                        <a href="{{ route('school.students.index', [
                                                            'class_id' => $class->id,
                                                            'section_id' => $section->id,
                                                        ]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                            Voir les ??l??ves
                                                        </a>
                                                        <a href="{{ route('school.routines.show', $class) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                                            Voir la routine
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="tab-pane" id="class-{{ $class->id }}-syllabi" role="tabpanel">
                                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                                    <thead class="thead-light ">
                                        <tr>
                                            <th>Nom</th>
                                            <th class="text-center">Fichier</th>
                                            <th class="text-center" style="width: 15%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($class->syllabi as $syllabus)
                                            <tr>
                                                <td>{{ $syllabus->name }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('download') }}" method="post">
                                                        @csrf
                                                        <input name="downloadable" type="hidden" value="{{ $syllabus->path }}">
                                                        <input type="hidden" name="name" value="{{ $syllabus->name }}">
                                                        <button type="submit" class="btn btn-sm btn-outline-primary" data-toggle="tooltip" title="T??l??charger le fichier">
                                                            <i class="si si-doc"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <form action="{{ route('school.syllabi.destroy', $syllabus) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('school.syllabi.edit', $syllabus) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Modifier le syllabus">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer le syllabus">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">Aucune donn??e ?? afficher</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="class-{{ $class->id }}-courses" role="tabpanel">
                                <table class="table table-borderless table-striped table-vcenter js-dataTable-full-pagination">
                                    <thead class="thead-light ">
                                        <tr>
                                            <th>Nom</th>
                                            <th>Type</th>
                                            <th  class="text-center" style="width: 15%;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($class->courses as $course)
                                            <tr>
                                                <td>{{ $course->name }}</td>
                                                <td>{{ $course->type }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('settings.courses.destroy', $course) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <div class="btn-group" role="group">
                                                            <a href="{{ route('settings.courses.edit', $course) }}" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Modifier le cours">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
                                                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Supprimer le cours">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                        </div>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">Aucune donn??e ?? afficher</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="block-footer">
                            <div class="row mt-3 mb-3">
                                <div class="col"></div>
                                <div class="col-1">
                                    <a href="{{ route('school.classes.edit', $class) }}" class="btn btn-outline-info" data-toggle="tooltip" title="Modifier la classe">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
