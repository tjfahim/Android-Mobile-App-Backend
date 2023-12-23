@extends('backend.layouts.main')

@section('main_content')
<div class="row p-5">
    <div class="card mx-2" style="width: 18rem;background-color: rgba(255, 228, 196, 0.541)">
        <div class="card-body">
          <h4 class="card-title">Home Section</h4>
          <h6 class="card-subtitle mb-2 text-muted">Total Sections: {{$homeSection}} </h6>
          <img src="{{ asset('image/20231211044900_aroma-massage-1.jpg') }}" alt="Background Image" style="width: 100%; margin-bottom:10px">
          <a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-newspaper-o	
            "></i>All Sections</a>
        </div>
    </div>
    <div class="card mx-2" style="width: 18rem;background-color: rgba(189, 114, 246, 0.765)">
        <div class="card-body">
          <h4 class="card-title">Radio</h4>
          <h6 class="card-subtitle mb-2 text-muted">Total Radio: {{$radio}}</h6>
          <a href="{{ route('radio.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-radio	
            "></i>GET</a>
        </div>
    </div>
    <div class="card mx-2" style="width: 18rem;background-color: rgba(106, 213, 167, 0.639)">
        <div class="card-body">
          <h4 class="card-title">Play List</h4>
          <h6 class="card-subtitle mb-2 text-muted">Playlist: {{ $playlistCategory }} , Music: {{ $playlistMusic }}</h6>
          <a href="{{ route('playlist.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-music	
	
            "></i>GET</a>
        </div>
    </div>
    <div class="card mx-2" style="width: 18rem;background-color: rgba(103, 160, 218, 0.639)">
        <div class="card-body">
          <h4 class="card-title">Podcast</h4>
          <h6 class="card-subtitle mb-2 text-muted">Playlist: {{ $podcastCategory }}</h6>
          <a href="{{ route('podcastcategory.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-microphone	
	
	
            "></i>GET</a>
        </div>
    </div>
</div>
       
@endsection