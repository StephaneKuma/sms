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
