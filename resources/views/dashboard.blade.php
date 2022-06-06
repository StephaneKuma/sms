@php
    $title = "Tableau de bord";
    $bread = "Mon tableau de bord";
@endphp

@extends('layouts.app')

@section('content')
    <div class="content">
        @include('layouts.partials._breadcrumb')
        
        <div class="block">
            <div class="block-content">

                <h1>{{ $title }}</h1>
            </div>
        </div>
    </div>
@endsection
