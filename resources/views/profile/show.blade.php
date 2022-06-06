@php
    $profile = auth()->user();
    $title = "Profil utilisateur";
    // $second = "Paramètres";
    // $url = route('profiles.show', $profile);
    // $bread = "Profil";
@endphp

@extends('layouts.app')


@section('content')
    <!-- User Info -->
    <div class="bg-image bg-image-bottom" style="background-image: url('{{ asset('media/photos/photo13@2x.jpg') }}');">
        <div class="bg-primary-dark-op py-30">
            <div class="content content-full text-center">
                <!-- Avatar -->
                <div class="mb-15">
                    <a class="img-link" href="#">
                        @if (is_null($profile->picture))
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $profile->name }}">
                        @else
                            <img class="img-avatar img-avatar96 img-avatar-thumb" src="{{ Storage::url($profile->picture) }}" alt="{{ $profile->name }}">
                        @endif
                    </a>
                </div>
                <!-- END Avatar -->

                @php
                    $profile = auth()->user();
                @endphp

                <!-- Personal -->
                <h1 class="h3 text-white font-w700 mb-10">
                    {{ $profile->name }}
                </h1>
                {{-- <h2 class="h5 text-white-op">
                    Product Manager <a class="text-primary-light" href="javascript:void(0)">@GraphicXspace</a>
                </h2> --}}
                <!-- END Personal -->

                <!-- Actions -->
                <form action="{{ route('profiles.destroy', $profile) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-rounded btn-hero btn-sm btn-alt-danger mb-5">
                        <i class="fa fa-trash mr-5"></i> Supprimer mon compte
                    </button>
                    <a class="btn btn-rounded btn-hero btn-sm btn-alt-secondary mb-5 px-20" href="{{ route('profiles.edit', $profile) }}">
                        <i class="fa fa-pencil"></i>
                    </a>
                </form>
                {{-- <button type="button" class="btn btn-rounded btn-hero btn-sm btn-alt-primary mb-5">
                    <i class="fa fa-envelope-o mr-5"></i> Message
                </button> --}}
                <!-- END Actions -->
            </div>
        </div>
    </div>
    <!-- END User Info -->
@endsection
