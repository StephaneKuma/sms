@php
    $profile = auth()->user();
@endphp

<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">S</span><span class="text-primary">S</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="{{ route('dashboard') }}">
                        <i class="si si-fire text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">STK</span><span class="font-size-xl text-primary">SMS</span>
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        <!-- Side User -->
        <div class="content-side content-side-full content-side-user px-10 align-parent">
            <!-- Visible only in mini mode -->
            <div class="sidebar-mini-visible-b align-v animated fadeIn">
                @if (is_null($profile->picture))
                    <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $profile->name }}">
                @else
                    <img class="img-avatar img-avatar32" src="{{ Storage::url($profile->picture) }}" alt="{{ $profile->name }}">
                @endif
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="{{ route('settings.profiles.show', $profile) }}">
                    @if (is_null($profile->picture))
                        <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}" alt="{{ $profile->name }}">
                    @else
                        <img class="img-avatar" src="{{ Storage::url($profile->picture) }}" alt="{{ $profile->name }}">
                    @endif
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="{{ route('settings.profiles.show', $profile) }}">
                            {{ $profile->name }}
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a onclick="event.preventDefault(); this.closest('form').submit();" class="link-effect text-dual-primary-dark" href="#">
                                <i class="si si-logout"></i>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
            <!-- END Visible only in normal mode -->
        </div>
        <!-- END Side User -->

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="{{ request()->is('dashboard*') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="si si-grid"></i><span class="sidebar-mini-hide">Tableau de bord</span>
                    </a>
                </li>
                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">ECOLE</span>
                    <span class="sidebar-mini-hidden">école</span>
                </li>
                <li>
                    <a class="{{ request()->is('school/sessions*') ? 'active' : '' }}" href="{{ route('school.sessions.index') }}">
                        <i class="si si-badge"></i><span class="sidebar-mini-hide">Sessions</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('school/semesters*') ? 'active' : '' }}" href="{{ route('school.semesters.index') }}">
                        <i class="si si-map"></i><span class="sidebar-mini-hide">Semestres</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('school/classes*') ? 'active' : '' }}" href="{{ route('school.classes.index') }}">
                        <i class="si si-layers"></i><span class="sidebar-mini-hide">Classes</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('school/sections*') ? 'active' : '' }}" href="{{ route('school.sections.index') }}">
                        <i class="si si-control-pause"></i><span class="sidebar-mini-hide">Sections</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('school/courses*') ? 'active' : '' }}" href="{{ route('school.courses.index') }}">
                        <i class="si si-book-open"></i><span class="sidebar-mini-hide">Cours</span>
                    </a>
                </li>
                <li>
                    <a class="{{ request()->is('school/syllabi*') ? 'active' : '' }}" href="{{ route('school.syllabi.index') }}">
                        <i class="si si-docs"></i><span class="sidebar-mini-hide">Syllabi</span>
                    </a>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">PARAM</span>
                    <span class="sidebar-mini-hidden">Paramètres</span>
                </li>
                <li>
                    @php
                        $profile = $profile;
                    @endphp
                    <a class="{{ request()->is('settings/profiles*') ? 'active' : '' }}" href="{{ route('settings.profiles.show', $profile) }}">
                        <i class="si si-user"></i>
                        <span class="sidebar-mini-hide">Profil</span>
                    </a>
                </li>
                <li class="{{ request()->is('settings/acl*') ? 'open' : '' }}">
                    <a class="nav-submenu" data-toggle="nav-submenu" href="javascript:void(0)">
                        <i class="si si-key"></i>
                        <span class="sidebar-mini-hide">Gestion d'accès</span>
                    </a>
                    <ul>
                        <li>
                            <a class="{{ request()->is('settings/acl/roles*') ? 'active' : '' }}" href="{{ route('settings.acl.roles.index') }}">Rôles</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('settings/acl/permissions*') ? 'active' : '' }}" href="{{ route('settings.acl.permissions.index') }}">Permissions</a>
                        </li>
                        <li>
                            <a class="{{ request()->is('settings/acl/users*') ? 'active' : '' }}" href="{{ route('settings.acl.users.index') }}">Utilisateurs</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->
