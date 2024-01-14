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
            <li class="nav-item">
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
            
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/radio') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('radio.index') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Radio Manage</p>
                </a>
            </li>
            
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/playlist') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('playlist.index') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Playlist Manage</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/podcast') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('podcastcategory.index') }}">
                    <i class="nc-icon nc-atom"></i>
                    <p>Podcast Manage</p>
                </a>
            </li>
            {{-- <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/reel') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('reel.index') }}">
                    <i class="nc-icon nc-button-play"></i>
                    <p>Reel</p>
                </a>
            </li> --}}
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/chat') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('chat.index') }}">
                    <i class="nc-icon nc-chat-round"></i>
                    <p>Chat</p>
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

