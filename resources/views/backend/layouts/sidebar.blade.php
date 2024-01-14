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
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    <i class="nc-icon nc-alien-33"></i>
                   <p> Home</p>
                </a>

                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <a class="nav-link" href="{{ route('home.section.index')}}">
                        <i class="nc-icon nc-alien-33"></i>
                        <p>Home Manage</p>
                    </a>
                    <a class="nav-link" href="{{ route('home.section.index')}}">
                        <i class="nc-icon nc-alien-33"></i>
                        <p>Slider Manage</p>
                    </a>
                    <a class="nav-link" href="{{ route('home.section.index')}}">
                        <i class="nc-icon nc-alien-33"></i>
                        <p>Banner Manage</p>
                    </a>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                    <i class="nc-icon nc-alien-33"></i>
                   <p> Live TV Manage</p>
                </a>

                <div class="collapse multi-collapse" id="multiCollapseExample1">
                    <a class="nav-link" href="{{ route('live_tv.index') }}">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Live TV List</p>
                    </a>
                    <a class="nav-link" href="{{ route('live_tv.create') }}">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Add New Live TV</p>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#multiCollapseVideo" role="button" aria-expanded="false" aria-controls="multiCollapseVideo">
                    <i class="nc-icon nc-alien-33"></i>
                   <p>Video Manage</p>
                </a>

                <div class="collapse multi-collapse" id="multiCollapseVideo">
                    <a class="nav-link" href="{{ route('video.index') }}">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Video List</p>
                    </a>
                    <a class="nav-link" href="{{ route('video.create') }}">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Add New Video</p>
                    </a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#multiCollapseRadio" role="button" aria-expanded="false" aria-controls="multiCollapseRadio">
                    <i class="nc-icon nc-alien-33"></i>
                   <p>Radio Manage</p>
                </a>

                <div class="collapse multi-collapse" id="multiCollapseRadio">
                    <a class="nav-link" href="{{ route('radio.index') }}">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Radio List</p>
                    </a>
                    <a class="nav-link" href="{{ route('radio.create') }}">
                        <i class="nc-icon nc-paper-2"></i>
                        <p>Add New Radio</p>
                    </a>
                </div>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/home') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home.section.index')}}">
                    <i class="nc-icon nc-alien-33"></i>
                    <p>Home Section</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/user') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('user.index')}}">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>Users</p>
                </a>
            </li>
            
            
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/live-tv') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('live_tv.index') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Live TV Manage</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/podcast') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('podcastcategory.index') }}">
                    <i class="nc-icon nc-atom"></i>
                    <p>Podcast Manage</p>
                </a>
            </li>
   
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/setting') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('settings.index') }}">
                    <i class="nc-icon nc-settings-gear-64"></i>
                    <p>Settings</p>
                </a>
            </li>
        </ul>
    </div>
</div>

