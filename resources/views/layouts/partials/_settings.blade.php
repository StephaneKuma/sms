<div class="btn-group" role="group">
    <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-options-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-wrench"></i>
    </button>
    <div class="dropdown-menu min-width-300" aria-labelledby="page-header-options-dropdown" style="">
        <h5 class="h6 text-center py-10 mb-10 border-b text-uppercase">Paramètre du thème</h5>
        <h6 class="dropdown-header">Couleurs</h6>
        <div class="row no-gutters text-center mb-5">
            <div class="col-2 mb-5">
                <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                    <i class="fa fa-2x fa-circle"></i>
                </a>
            </div>
            <div class="col-2 mb-5">
                <a class="text-elegance" data-toggle="theme" data-theme="{{ asset('css/themes/elegance.min.css') }}" href="javascript:void(0)">
                    <i class="fa fa-2x fa-circle"></i>
                </a>
            </div>
            <div class="col-2 mb-5">
                <a class="text-pulse" data-toggle="theme" data-theme="{{ asset('css/themes/pulse.min.css') }}" href="javascript:void(0)">
                    <i class="fa fa-2x fa-circle"></i>
                </a>
            </div>
            <div class="col-2 mb-5">
                <a class="text-flat" data-toggle="theme" data-theme="{{ asset('css/themes/flat.min.css') }}" href="javascript:void(0)">
                    <i class="fa fa-2x fa-circle"></i>
                </a>
            </div>
            <div class="col-2 mb-5">
                <a class="text-corporate" data-toggle="theme" data-theme="{{ asset('css/themes/corporate.min.css') }}" href="javascript:void(0)">
                    <i class="fa fa-2x fa-circle"></i>
                </a>
            </div>
            <div class="col-2 mb-5">
                <a class="text-earth" data-toggle="theme" data-theme="{{ asset('css/themes/earth.min.css') }}" href="javascript:void(0)">
                    <i class="fa fa-2x fa-circle"></i>
                </a>
            </div>
        </div>
        <h6 class="dropdown-header">En-tête</h6>
        <div class="row gutters-tiny text-center mb-5">
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-block btn-alt-secondary d-none d-lg-block mb-10" data-toggle="layout" data-action="header_style_classic">Classic Style</button>
            </div>
        </div>
        <h6 class="dropdown-header">Sidebar</h6>
        <div class="row gutters-tiny text-center mb-5">
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_off">Clair</button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_on">Sombre</button>
            </div>
        </div>
        <div class="d-none d-xl-block">
            <h6 class="dropdown-header">Contenu</h6>
            <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="content_layout_toggle">Toggle Layout</button>
        </div>
        {{-- <div class="dropdown-divider"></div>
        <div class="row gutters-tiny text-center">
            <div class="col-6">
                <a class="dropdown-item mb-0" href="be_layout_api.html">
                    <i class="si si-chemistry mr-5"></i> Layout API
                </a>
            </div>
            <div class="col-6">
                <a class="dropdown-item mb-0" href="be_ui_color_themes.html">
                    <i class="fa fa-paint-brush mr-5"></i> Color Themes
                </a>
            </div>
        </div> --}}
    </div>
</div>
