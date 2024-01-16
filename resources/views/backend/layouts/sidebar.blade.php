<div class="sidebar" data-image="{{ asset('backend/assets/img/sidebar-5.jpg')}}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('admin.dashboard')}}" class="simple-text">
                {{ $settings->title ?? 'Candelita'}}
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/dashboard') ? ' active' : '' }}">
                <a class="nav-link " href="{{ route('admin.dashboard')}}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/user') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user.index')}}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Users</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/radio') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('radio.index') }}">
                    <i class="nc-icon nc-notification-70"></i>
                    <p>Radio Manage</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/live') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('live_tv.index') }}">
                    <i class="nc-icon nc-tv-2"></i>
                    <p>Live TV Manage</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/video') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('video.index') }}">
                    <i class="nc-icon nc-button-play"></i>
                    <p>Video Manage</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/podcast') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('podcastcategory.index') }}">
                    <i class="nc-icon nc-audio-92"></i>
                    <p>Podcast Manage</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/home') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#HomeSectionManage" role="button" aria-expanded="false" aria-controls="HomeSectionManage">
                    <i class="nc-icon nc-alien-33"></i>
                   <p> Home Manage</p>
                </a>
                <div class="collapse multi-collapse" id="HomeSectionManage">
                    <a class="nav-link" href="{{ route('home.section.index')}}">
                        <i class="nc-icon nc-credit-card"></i>
                        <p>Content Manage</p>
                    </a>
                    <a class="nav-link" href="{{ route('home.slider.index')}}">
                        <i class="nc-icon nc-album-2"></i>
                        <p>Slider Manage</p>
                    </a>
                    <a class="nav-link" href="{{ route('banner.index')}}">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Banner Manage</p>
                    </a>
                </div>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/setting') ? ' active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#SettingManage" role="button" aria-expanded="false" aria-controls="SettingManage">
                    <i class="nc-icon nc-settings-gear-64"></i>
                   <p>All Settings</p>
                </a>
                <div class="collapse multi-collapse" id="SettingManage">
                    <a class="nav-link" href="{{ route('settings.index')}}">
                        <i class="nc-icon nc-settings-tool-66"></i>
                        <p>Settings</p>
                    </a>
                    <a class="nav-link" href="{{ route('menu_bar.index')}}">
                        <i class="nc-icon nc-settings-90"></i>
                        <p>Menu Manage</p>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</div>

