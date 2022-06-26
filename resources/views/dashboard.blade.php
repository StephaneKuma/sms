@php
    $title = "Tableau de bord";
    $bread = "Mon tableau de bord";
@endphp

@extends('layouts.app')

@push('css')
    <style>
        .masonry {
            /* display: grid;
            gap: 1em;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            grid-template-rows: masonry; */

            column-count: 3;
            column-gap: 1em;
        }

        .myBlock {
            margin: 0;
            display: grid;
            grid-template-rows: 1fr auto;
            margin-bottom: 1em;
            break-inside: avoid;
        }
    </style>
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush

@push('js')
    <!-- Page JS Plugins -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var calendar = $('#full_calendar_events').fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                editable: true,
                editable: true,
                events: "{{ route('school.events.index') }}",
                displayEventTime: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                @hasrole('admin')
                    selectable: true,
                    selectHelper: true,
                    select: function (event_start, event_end, allDay) {
                        var event_name = prompt('Nom de l\'évènement :');

                        if (event_name) {
                            var event_start = $.fullCalendar.formatDate(event_start, "Y-MM-DD HH:mm:ss");
                            var event_end = $.fullCalendar.formatDate(event_end, "Y-MM-DD HH:mm:ss");
                            var data = {
                                title: event_name,
                                start: event_start,
                                end: event_end,
                                type: 'create'
                            }

                            $.ajax({
                                url: "{{ route('school.events.ajax') }}",
                                data: data,
                                type: "POST",
                                success: function (data) {
                                    displayMessage("Evènement créé.");
                                    calendar.fullCalendar('renderEvent', {
                                        id: data.id,
                                        title: event_name,
                                        start: event_start,
                                        end: event_end,
                                        allDay: allDay
                                    }, true);
                                    calendar.fullCalendar('unselect');
                                }
                            });
                        }
                    },
                    eventDrop: function (event, delta) {
                        var event_start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var event_end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                        $.ajax({
                            url: "{{ route('school.events.index') }}",
                            data: {
                                title: event.event_name,
                                start: event_start,
                                end: event_end,
                                id: event.id,
                                type: 'edit'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Evènement mise à jour");
                            }
                        });
                    },
                    eventClick: function (event) {
                        var eventDelete = confirm("Êtes-vous sûr(e)?");
                        if (eventDelete) {
                            $.ajax({
                                type: "POST",
                                url: "{{ route('school.events.index') }}",
                                data: {
                                    id: event.id,
                                    type: 'delete'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Evènement supprimer");
                                }
                            });
                        }
                    }
                @endhasrole
            });
        });
        function displayMessage(message) {
            toastr.success(message, 'Evènements - Ecole');
        }
    </script>
@endpush

@section('content')
    <div class="content">
        @include('shared.dashboard._tiles')

        @include('shared.dashboard._percentages')

        @include('shared.dashboard._heros')

        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <!-- Row #2 -->
            <div class="col-md-6">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">
                            Evènements
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div id="full_calendar_events"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="block block-rounded">
                    <div class="block-header">
                        <h3 class="block-title">
                            Notices
                        </h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option">
                                <i class="si si-wrench"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <div id="accordion">
                            @foreach ($notices as $notice)
                                <div class="card">
                                    <div class="card-header" id="heading-{{ $notice->id }}">
                                        <h5 class="mb-0">
                                            <button class="btn btn-link{{ $loop->first ? ' collapsed' : '' }}"
                                                data-toggle="collapse"
                                                data-target="#collapse-{{ $notice->id }}"
                                                aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                                aria-controls="collapse-{{ $notice->id }}">
                                                Publier le : {{ $notice->created_at }}
                                            </button>
                                        </h5>
                                    </div>

                                    <div id="collapse-{{ $notice->id }}" class="collapse{{ $loop->first ? ' show' : '' }}"
                                        aria-labelledby="heading-{{ $notice->id }}"
                                        data-parent="#accordion">
                                        <div class="card-body">
                                            {!! $notice->content !!}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                          </div>
                    </div>
                </div>
            </div>
            <!-- END Row #2 -->
        </div>
    </div>
@endsection
