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
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout"
                    data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="{{ route('dashboard') }}">
                        <i class="si si-fire text-primary"></i>
                        <span class="font-size-xl text-dual-primary-dark">STK</span><span
                            class="font-size-xl text-primary">SMS</span>
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
                    <img class="img-avatar img-avatar32" src="{{ asset('media/avatars/avatar15.jpg') }}"
                        alt="{{ $profile->name }}">
                @else
                    <img class="img-avatar img-avatar32" src="{{ Storage::url($profile->picture) }}"
                        alt="{{ $profile->name }}">
                @endif
            </div>
            <!-- END Visible only in mini mode -->

            <!-- Visible only in normal mode -->
            <div class="sidebar-mini-hidden-b text-center">
                <a class="img-link" href="{{ route('settings.profiles.show', $profile) }}">
                    @if (is_null($profile->picture))
                        <img class="img-avatar" src="{{ asset('media/avatars/avatar15.jpg') }}"
                            alt="{{ $profile->name }}">
                    @else
                        <img class="img-avatar" src="{{ Storage::url($profile->picture) }}" alt="{{ $profile->name }}">
                    @endif
                </a>
                <ul class="list-inline mt-10">
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase"
                            href="{{ route('settings.profiles.show', $profile) }}">
                            {{ $profile->name }}
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="link-effect text-dual-primary-dark" data-toggle="layout"
                            data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                            <i class="si si-drop"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <a onclick="event.preventDefault(); this.closest('form').submit();"
                                class="link-effect text-dual-primary-dark" href="{{ route('logout') }}">
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
                {{-- @hasanyrole('teacher')
                    <li>
                        <a class="" href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="sidebar-mini-hide">Présences</span>
                        </a>
                    </li>
                @endhasanyrole --}}
                @can('view classes')
                    <li>
                        <a class="d-flex align-items-center justify-content-between {{ request()->is('school/classes*') ? 'active' : '' }}"
                            href="{{ route('school.classes.index') }}">
                            <i class="si si-layers"></i>
                            <span class="sidebar-mini-hide">Classes</span>
                            {{-- <span class="badge badge-info">5</span> --}}
                        </a>
                    </li>
                @endcan
                @unlessrole('student')
                    <li>
                        <a class="{{ request()->is('school/students*') ? 'active' : '' }}"
                            href="{{ route('school.students.index') }}">
                            <i class="si si-users"></i>
                            <span class="sidebar-mini-hide">Elèves</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('school/teachers*') ? 'active' : '' }}"
                            href="{{ route('school.teachers.index') }}">
                            <i class="si si-briefcase"></i>
                            <span class="sidebar-mini-hide">Enseignants</span>
                        </a>
                    </li>
                @endunlessrole
                @role('teacher')
                    @php
                        $teacher = auth()->user();
                    @endphp
                    <li>
                        <a class="{{ request()->is('school/teacher*') ? 'active' : '' }}"
                            href="{{ route('school.teacher.courses', $teacher) }}">
                            <i class="fa fa-drivers-license-o"></i>
                            <span class="sidebar-mini-hide">Mes cours</span>
                        </a>
                    </li>
                @endrole
                @role('student')
                    @php
                        $student = auth()->user();
                        $class =null;
                        $sessionId = null;

                        if (session()->has('browse_session_id')) {
                            $sessionId = session()->get('browse_session_id');
                        } else {
                            $sessionId = App\Models\SchoolSession::latest()->first()->id;
                        }

                        $promotion =  (new App\Repositories\PromotionRepository())
                            ->getByStudent($sessionId, $student->id);
                        $class = $promotion->class;
                    @endphp
                    <li>
                        <a class="" href="#">
                            <i class="fa fa-calendar"></i>
                            <span class="sidebar-mini-hide">Présences</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('school/courses/student*') ? 'active' : '' }}"
                            href="{{ route('school.show.students.courses', $student) }}">
                            <i class="fa fa-drivers-license-o"></i>
                            <span class="sidebar-mini-hide">Mes cours</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('school/routines*') ? 'active' : '' }}"
                            href="{{ route('school.routines.show', $class) }}">
                            <i class="si si-speedometer"></i>
                            <span class="sidebar-mini-hide">Routine</span>
                        </a>
                    </li>
                @endrole
                @hasanyrole('admin|teacher')
                    <li class="{{ request()->is('school/exams*') ? 'open' : '' }}">
                        <a href="javascript:void(0)" class="nav-submenu" data-toggle="nav-submenu">
                            <i class="si si-graduation"></i>
                            <span class="sidebar-mini-hide">Examens / Graduations</span>
                        </a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('school/exams*') ? 'active' : '' }}"
                                    href="{{ route('school.exams.index') }}">
                                    Examens
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->is('school/exams/grading/systems*') ? 'active' : '' }}"
                                    href="{{ route('school.exams.grading.systems.index') }}">
                                    Systèmes de gradution
                                </a>
                            </li>
                        </ul>
                    </li>
                @endhasanyrole
                @role('admin')
                    <li>
                        <a class="{{ request()->is('school/notices*') ? 'active' : '' }}"
                            href="{{ route('school.notices.create') }}">
                            <i class="si si-speech"></i>
                            <span class="sidebar-mini-hide">Notice</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('school/events*') ? 'active' : '' }}"
                            href="{{ route('school.events.index') }}">
                            <i class="si si-calendar"></i>
                            <span class="sidebar-mini-hide">Evènements</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('school/syllabi*') ? 'active' : '' }}"
                            href="{{ route('school.syllabi.index') }}">
                            <i class="si si-docs"></i>
                            <span class="sidebar-mini-hide">Syllabus</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('school/promotions*') ? 'active' : '' }}"
                            href="{{ route('school.promotions.index') }}">
                            <i class="si si-equalizer"></i>
                            <span class="sidebar-mini-hide">Promotion</span>
                        </a>
                    </li>
                    <li>
                        <a class="{{ request()->is('school/routines*') ? 'active' : '' }}"
                            href="{{ route('school.routines.create') }}">
                            <i class="si si-speedometer"></i>
                            <span class="sidebar-mini-hide">Routine</span>
                        </a>
                    </li>
                @endrole

                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">PARAM</span>
                    <span class="sidebar-mini-hidden">Paramètres</span>
                </li>
                @role('admin')
                    <li>
                        <a class="{{ request()->is('settings*') ? 'active' : '' }}"
                            href="{{ route('settings.index') }}">
                            <i class="si si-settings"></i>
                            <span class="sidebar-mini-hide">Académie</span>
                        </a>
                    </li>
                @endrole
                <li>
                    @php
                        $profile = $profile;
                    @endphp
                    <a class="{{ request()->is('settings/profiles*') ? 'active' : '' }}"
                        href="{{ route('settings.profiles.show', $profile) }}">
                        <i class="si si-user"></i>
                        <span class="sidebar-mini-hide">Profil</span>
                    </a>
                </li>
                @role('admin')
                    <li class="{{ request()->is('settings/acl*') ? 'open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="javascript:void(0)">
                            <i class="si si-key"></i>
                            <span class="sidebar-mini-hide">Gestion d'accès</span>
                        </a>
                        <ul>
                            <li>
                                <a class="{{ request()->is('settings/acl/roles*') ? 'active' : '' }}"
                                    href="{{ route('settings.acl.roles.index') }}">Rôles</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('settings/acl/permissions*') ? 'active' : '' }}"
                                    href="{{ route('settings.acl.permissions.index') }}">Permissions</a>
                            </li>
                            <li>
                                <a class="{{ request()->is('settings/acl/users*') ? 'active' : '' }}"
                                    href="{{ route('settings.acl.users.index') }}">Utilisateurs</a>
                            </li>
                        </ul>
                    </li>
                @endrole
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
<!-- END Sidebar -->
