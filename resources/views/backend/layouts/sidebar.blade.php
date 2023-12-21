<div class="sidebar" data-image="{{ asset('backend/assets/img/sidebar-5.jpg')}}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('admin.dashboard')}}" class="simple-text">
                Creative Tim
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/dashboard') ? ' active' : '' }}">
                <a class="nav-link " href="{{ route('admin.dashboard')}}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item{{ Illuminate\Support\Str::contains(url()->current(), 'admin/home/section') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('home.section.index')}}">
                    <i class="nc-icon nc-alien-33"></i>
                    <p>Home Section</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="#">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>User Profile</p>
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
          
      
        </ul>
    </div>
</div>