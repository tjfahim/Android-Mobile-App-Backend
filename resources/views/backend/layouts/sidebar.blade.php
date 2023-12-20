<div class="sidebar" data-image="{{ asset('backend/assets/img/sidebar-5.jpg')}}">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route('admin.dashboard')}}" class="simple-text">
                Creative Tim
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item{{ url()->current() == route('admin.dashboard') ? ' active' : '' }}">
                <a class="nav-link " href="{{ route('admin.dashboard')}}">
                    <i class="nc-icon nc-chart-pie-35"></i>
                    <p>Dashboard</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link{{ url()->current() == route('home.section.index') ? ' active' : '' }}" href="{{ route('home.section.index')}}">
                    <i class="nc-icon nc-alien-33"></i>
                    <p>Home Section</p>
                </a>
            </li>
            <li>
                <a class="nav-link" href="">
                    <i class="nc-icon nc-circle-09"></i>
                    <p>User Profile</p>
                </a>
            </li>
            
            <li class="nav-item{{ url()->current() == route('radio.index') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('radio.index') }}">
                    <i class="nc-icon nc-notes"></i>
                    <p>Radio Manage</p>
                </a>
            </li>
            
            <li class="nav-item{{ url()->current() == route('playlist.index') ? ' active' : '' }}">
                <a class="nav-link" href="{{ route('playlist.index') }}">
                    <i class="nc-icon nc-paper-2"></i>
                    <p>Playlist Manage</p>
                </a>
            </li>
            <li>
                <a class="nav-link{{ url()->current() == route('podcastcategory.index') ? ' active' : '' }}" href="{{ route('podcastcategory.index')}}">
                    <i class="nc-icon nc-atom"></i>
                    <p>Podcast Manage</p>
                </a>
            </li>
          
      
        </ul>
    </div>
</div>