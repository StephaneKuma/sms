@php
    $profile = auth()->user();
@endphp
<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="content-header-section">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-navicon"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Open Search Section -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                <i class="fa fa-search"></i>
            </button>
            <!-- END Open Search Section -->

            @auth
                @php
                    $latestSchoolSession = \App\Models\SchoolSession::latest()->first();
                    $currentSchoolSessionName = null;
                    if($latestSchoolSession){
                        $currentSchoolSessionName = $latestSchoolSession->name;
                    }
                @endphp
                @if (session()->has('browse_session_name') && session('browse_session_name') !== $currentSchoolSessionName)
                    <a class="btn btn-circle btn-dual-secondary text-danger disabled" href="#">
                        <i class="bi bi-exclamation-diamond-fill me-2"></i>
                        Navigation dans la session : {{ session('browse_session_name') }}
                    </a>
                @elseif(\App\Models\SchoolSession::latest()->count() > 0)
                    <a class="btn btn-circle btn-dual-secondary disabled" href="#">
                        Session académique courante :
                        <span class="badge badge-info">{{ $currentSchoolSessionName }}</span>
                    </a>
                @else
                    <a class="btn btn-rounded btn-dual-secondary text-danger" href="{{ route('settings.sections.create') }}">
                        <i class="bi bi-exclamation-diamond-fill me-2"></i> Créer une session académique.
                    </a>
                @endif
            @endauth
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="content-header-section">
            <!-- User Dropdown -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-user d-sm-none"></i>
                    <span class="d-none d-sm-inline-block">
                        <span class="badge badge-primary mr-1">
                            {{ Str::ucfirst(auth()->user()->getRoleNames()->first()) }}
                        </span>
                        {{ $profile->name }}
                    </span>
                    <i class="fa fa-angle-down ml-5"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                    <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">Utilisateur</h5>
                    <a class="dropdown-item" href="{{ route('settings.profiles.show', $profile) }}">
                        <i class="si si-user mr-5"></i> Profil
                    </a>
                    <a class="dropdown-item d-flex align-items-center justify-content-between" href="#">
                        <span><i class="si si-envelope-open mr-5"></i> Inbox</span>
                        <span class="badge badge-primary">3</span>
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="si si-note mr-5"></i> Factures
                    </a>
                    <div class="dropdown-divider"></div>

                    <!-- Toggle Side Overlay -->
                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                    <a class="dropdown-item" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_toggle">
                        <i class="si si-wrench mr-5"></i> Paramètres
                    </a>
                    <!-- END Side Overlay -->

                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <a onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item" href="#">
                            <i class="si si-logout mr-5"></i> Déconnexion
                        </a>
                    </form>
                </div>
            </div>
            <!-- END User Dropdown -->

            <!-- Notifications -->
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-flag"></i>
                    <span class="badge badge-primary badge-pill">5</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right min-width-300" aria-labelledby="page-header-notifications">
                    <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notifications</h5>
                    <ul class="list-unstyled my-20">
                        <li>
                            <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                <div class="ml-5 mr-15">
                                    <i class="fa fa-fw fa-check text-success"></i>
                                </div>
                                <div class="media-body pr-10">
                                    <p class="mb-0">You’ve upgraded to a VIP account successfully!</p>
                                    <div class="text-muted font-size-sm font-italic">15 min ago</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                <div class="ml-5 mr-15">
                                    <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                </div>
                                <div class="media-body pr-10">
                                    <p class="mb-0">Please check your payment info since we can’t validate them!</p>
                                    <div class="text-muted font-size-sm font-italic">50 min ago</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                <div class="ml-5 mr-15">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </div>
                                <div class="media-body pr-10">
                                    <p class="mb-0">Web server stopped responding and it was automatically restarted!</p>
                                    <div class="text-muted font-size-sm font-italic">4 hours ago</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                <div class="ml-5 mr-15">
                                    <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                                </div>
                                <div class="media-body pr-10">
                                    <p class="mb-0">Please consider upgrading your plan. You are running out of space.</p>
                                    <div class="text-muted font-size-sm font-italic">16 hours ago</div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                                <div class="ml-5 mr-15">
                                    <i class="fa fa-fw fa-plus text-primary"></i>
                                </div>
                                <div class="media-body pr-10">
                                    <p class="mb-0">New purchases! +$250</p>
                                    <div class="text-muted font-size-sm font-italic">1 day ago</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                        <i class="fa fa-flag mr-5"></i> View All
                    </a>
                </div>
            </div>
            <!-- END Notifications -->

            <!-- Toggle Side Overlay -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
                <i class="fa fa-tasks"></i>
            </button>
            <!-- END Toggle Side Overlay -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header">
        <div class="content-header content-header-fullrow">
            <form action="#" method="post">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <!-- Close Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-times"></i>
                        </button>
                        <!-- END Close Search Section -->
                    </div>
                    <input type="text" class="form-control" placeholder="Rechercher ou taper ESC.." id="page-header-search-input" name="page-header-search-input">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-primary">
        <div class="content-header content-header-fullrow text-center">
            <div class="content-header-item">
                <i class="fa fa-sun-o fa-spin text-white"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->
