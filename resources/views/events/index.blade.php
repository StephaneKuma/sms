@php
    $title = "Liste des évènements";
    $second = "Ecole";
    $url = route('school.events.index');
    $bread = "Evènements";
    $editable = true;
    $selectable = true;
@endphp

@extends('layouts.app')

@push('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
@endpush

@push('js')
    <!-- Page JS Plugins -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
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
        @include('layouts.partials._breadcrumb')

        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $title }}</h3>
            </div>
            <div class="block-content block-content-full">
                <div id="full_calendar_events"></div>
            </div>
        </div>
    </div>
@endsection
