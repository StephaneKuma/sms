@isset($bread)
    <nav class="breadcrumb bg-white push">
        <a class="breadcrumb-item" href="{{ route('dashboard') }}">T. Bord</a>
        @isset($second)
            <a class="breadcrumb-item" href="{{ $url }}">{{ $second }}</a>
        @endisset
        @isset($third)
            <a class="breadcrumb-item" href="{{ $url2 }}">{{ $third }}</a>
        @endisset
        @isset($fourth)
            <a class="breadcrumb-item" href="{{ $url3 }}">{{ $fourth }}</a>
        @endisset
        <span class="breadcrumb-item active">{{  $bread }}<span>
    </nav>
@endisset
