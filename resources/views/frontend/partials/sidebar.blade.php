<div class="sidebar">
    @if (!isset($sidebars) || (isset($sidebars) && in_array('covid', $sidebars)))
        <div class="widget">
            <div class="widget-title">
                Informasi Covid 19
            </div>
            <div class="widget-body">
                @include('frontend.partials.widgets.covid')
            </div>
        </div>
    @endif
    {{-- @if (!isset($sidebars) || (isset($sidebars) && in_array('lastest-profile', $sidebars)))
        <div class="widget">
            <div class="widget-title">
                Pembaharuan Profil Puskesmas
            </div>
            <div class="widget-body">
                @include('frontend.partials.widgets.puskesmas-profile')
            </div>
        </div>
    @endif --}}
    @if (!isset($sidebars) || (isset($sidebars) && in_array('related-links', $sidebars)))
        <div class="widget">
            <div class="widget-title">
                Link Terkait
            </div>
            <div class="widget-body">
                @include('frontend.partials.widgets.related-links')
            </div>
        </div>
    @endif
    @if (!isset($sidebars) || (isset($sidebars) && in_array('random-posts', $sidebars)))
        <div class="widget">
            <div class="widget-title">
                Berita Acak
            </div>
            <div class="widget-body">
                @include('frontend.partials.widgets.random-posts')
            </div>
        </div>
    @endif
</div>
