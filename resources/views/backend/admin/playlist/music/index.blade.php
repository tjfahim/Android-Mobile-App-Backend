@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Music Manage</h4>
        <a href="{{ route('playlistmusic.create')}}" class="btn btn-primary">Add New Music</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
      
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">Subtitle</th>
                <th scope="col">Music</th>
                <th scope="col">Image</th>
                <th scope="col">Feature Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($playlistMusic as $playlistmusic)

              <tr>
                <th scope="row"> {{ $playlistmusic->id }}</th>
                <td>
           {{ $playlistmusic->title }}-<small>{{ $playlistmusic->artist }}
                </td>
                <td>
                  <small>{{ $playlistmusic->subtitle }}
                </td>
                <td style="width: 30%">
                    @if($playlistmusic->music_link)
                            <a href="{{ $playlistmusic->music_link }}" class="card-link my-3" style="margin-top:10px;margin-button:10px">Link: {{ $playlistmusic->music_link }}</a>
                    @else
                        <a href="{{ asset('music_file/' . $playlistmusic->music_file) }}" class="card-link " style="margin-top:10px;margin-button:10px">Link: {{ asset('music_file/' . $playlistmusic->music_file) }}</a>
                    @endif
                    @if($playlistmusic->music_file)
                    <audio controls style="width: 100%;
                    height: 35px;">
                        <source src="{{ asset('music_file/' . $playlistmusic->music_file) }}" type="audio/mpeg">
                    </audio>
                @else
                    <audio controls style="width: 100%;
                    height: 35px;">
                        <source src="{{ $playlistmusic->music_link }}" type="audio/mpeg">
                    </audio>
                @endif
                </td>
           
                <td>
                    <img src="{{ asset('image/music/' . $playlistmusic->image) }}" alt="{{ $playlistmusic->title }}" style="width: 50px; height: 50px">
                </td>
                <td>
                    <img src="{{ asset('image/music/' . $playlistmusic->feature_image) }}" alt="{{ $playlistmusic->title }}" style="width: 50px; height: 50px">
                </td>
                <td>
                    @if($playlistmusic->status =='active')
                    <span class="badge badge-success">{{$playlistmusic->status}}</span>
                    @endif
                    @if($playlistmusic->status =='inactive')
                    <span class="badge badge-danger">{{$playlistmusic->status}}</span>
                    @endif
                
                <td>
                        <!-- Edit option -->
                        <a class="btn btn-sm btn-primary" href="{{ route('playlistmusic.edit', ['id' => $playlistmusic->id]) }}">Edit</a>
                        <a class="btn btn-sm btn-primary mt-2" href="{{ route('playlistmusic.details', ['id' => $playlistmusic->id]) }}">Details</a>
                        <!-- Delete option -->
                        <form action="{{ route('playlistmusic.destroy', ['id' => $playlistmusic->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this playlimusic record?')">Delete</button>
                        </form>
                </td>
              </tr>
              @endforeach

             
            </tbody>
            {{ $playlistMusic->links('pagination::bootstrap-4') }}
          </table>
        
        
    </div>
</div>
@endsection