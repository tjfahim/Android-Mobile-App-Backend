@extends('backend.layouts.main')

@section('main_content')
<div class="row p-5">
  <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
    <a href="{{ route('home.section.index')}}" class=""><img src="{{ asset('image/dashboard/pngtree-note-music-logo-watercolor-background-picture-image_1589075.jpg') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
    <div class="card-body">
     <div class="row">
      <div class="col-md-9">          <h4 class="card-title">Home Section</h4>
        <h6 class="card-subtitle mb-2 text-muted">Total Sections: {{$homeSection}} </h6>

      </div>
      <div class="col-md-3"><a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-newspaper-o	
        "></i>All Sections</a></div>
     </div>
    </div>
  </div>
  <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
    <a href="{{ route('radio.index')}}" class="">   <img src="{{ asset('image/dashboard/360_F_188704159_7HyfBfbZgCq4Ben4hEl5TtJ8Tc42DbZB.jpg') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>

    <div class="card-body">
     <div class="row">
      <div class="col-md-9">             <h4 class="card-title">Radio</h4>
        <h6 class="card-subtitle mb-2 text-muted">Total Radio: {{$radio}}</h6>

      </div>
      <div class="col-md-3">  <a href="{{ route('radio.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-microchip"></i>GET</a></div>
     </div>
    </div>
  </div>
  {{-- <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
    <a href="{{ route('playlist.index')}}" class="">   <img src="{{ asset('image/dashboard/getty_470285218_2000133320009280218_277406.jpg') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
    <div class="card-body">
     <div class="row">
      <div class="col-md-9">         <h4 class="card-title">Play List</h4>
        <h6 class="card-subtitle mb-2 text-muted">Playlist: {{ $playlistCategory }} , Music: {{ $playlistMusic }}</h6>

      </div>
      <div class="col-md-3">  <a href="{{ route('playlist.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-music	
	
        "></i>GET</a></div>
     </div>
    </div>
  </div> --}}
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
  {{-- <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
    <a href="{{ route('reel.index')}}" class=""><img src="{{ asset('image/dashboard/0804338F-F94A-4364-9250-45C62158C762-scaled.jpeg') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>

 
    <div class="card-body">
     <div class="row">
      <div class="col-md-9"><h4 class="card-title">Reels</h4>
        <h6 class="card-subtitle mb-2 text-muted">Total Video: {{ $reel }}</h6>

      </div>
      <div class="col-md-3">
        <a href="{{ route('reel.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-film"></i>GET</a></div>
     </div>
    </div>
  </div> --}}
  <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
    <a href="{{ route('user.index')}}" class=""><img src="{{ asset('image/dashboard/free-user-group-icon-296-thumb.png') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>

 
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
       
@endsection