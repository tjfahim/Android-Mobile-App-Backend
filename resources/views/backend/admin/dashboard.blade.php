@extends('backend.layouts.main')

@section('main_content')
<div class="p-5 " >
  
  <div class="row">
    <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
      <a href="{{ route('home.section.index')}}" class=""><img src="{{ asset('image/dashboard/pngtree-note-music-logo-watercolor-background-picture-image_1589075.jpg') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
      <div class="card-body">
       <div class="row">
        <div class="col-md-9"><h4 class="card-title">Home Section</h4>
          <h6 class="card-subtitle mb-2 text-muted">Total Sections: {{$homeSection}} </h6>
        </div>
        <div class="col-md-3"><a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-newspaper-o	
          "></i>All Sections</a></div>
       </div>
      </div>
    </div>
    <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
      <a href="{{ route('radio.index')}}" class=""><img src="{{ asset('image/dashboard/360_F_188704159_7HyfBfbZgCq4Ben4hEl5TtJ8Tc42DbZB.jpg') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
  
      <div class="card-body">
       <div class="row">
        <div class="col-md-9">             <h4 class="card-title">Radio</h4>
          <h6 class="card-subtitle mb-2 text-muted">Total Radio: {{$radio}}</h6>
        </div>
        <div class="col-md-3">  <a href="{{ route('radio.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-microchip"></i>GET</a></div>
       </div>
      </div>
    </div>
    <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
      <a href="{{ route('video.index')}}" class=""><img src="{{ asset('image/dashboard/30060-5-video-icon-free-download.png') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
      <div class="card-body">
       <div class="row">
        <div class="col-md-9"> <h4 class="card-title">Video</h4>
          <h6 class="card-subtitle mb-2 text-muted">Total Video: {{$video}}</h6>
        </div>
        <div class="col-md-3">  <a href="{{ route('video.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-microchip"></i>GET</a></div>
       </div>
      </div>
    </div>
    <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
      <a href="{{ route('podcastcategory.index')}}" class=""><img src="{{ asset('image/dashboard/podcast-7876792_640.webp') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
      <div class="card-body">
       <div class="row">
        <div class="col-md-9">            <h4 class="card-title">Podcast</h4>
          <h6 class="card-subtitle mb-2 text-muted">Playlist: {{ $podcastCategory }}</h6>
        </div>
        <div class="col-md-3">
          <a href="{{ route('podcastcategory.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-microphone"></i>GET</a></div>
       </div>
      </div>
    </div>
    <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
      <a href="{{ route('user.index')}}" class=""><img src="{{ asset('image/dashboard/665405_users_512x512.png') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
  
      <div class="card-body">
       <div class="row">
        <div class="col-md-9">            <h4 class="card-title">Users</h4>
          <h6 class="card-subtitle mb-2 text-muted">Total User: {{ $user }}</h6>
  
        </div>
        <div class="col-md-3">
          <a href="{{ route('user.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-users"></i>GET</a></div>
       </div>
      </div>
    </div>
  </div>
  
</div>
       
@endsection