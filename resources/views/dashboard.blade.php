@php
    $title = "Tableau de bord";
    $bread = "Mon tableau de bord";
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="row js-appear-enabled animated fadeIn" data-toggle="appear">
            <!-- Row #1 -->
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-users fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1" data-to="{{ $studentCount }}">{{ $studentCount }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">élèves</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-briefcase fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1" data-to="{{ $teacherCount }}" class="js-count-to-enabled">{{ $teacherCount }}</span></div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Enseignants</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-layers fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1" data-to="{{ $classCount }}">{{ $classCount }}</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Classes</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="javascript:void(0)">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-book-open fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600 js-count-to-enabled" data-toggle="countTo" data-speed="1" data-to="650">650</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Livres</div>
                    </div>
                </a>
            </div>
            <!-- END Row #1 -->
        </div>
    </div>
@endsection
