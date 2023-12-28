@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Music Manage</h4>
        <a href="{{ route('playlistmusic.create')}}" class="btn btn-primary">Add New Music</a>
        <a href="{{ route('playlist.index')}}" class="btn btn-primary"><i class="fa fa-caret-square-o-left"></i>Playlist Manage</a>

        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
      
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Action</th>
                <th scope="col">id</th>
                <th scope="col">Title</th>
                <th scope="col">Subtitle</th>
                <th scope="col">Music</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach($playlistMusic as $playlistmusic)

              <tr>
                <td>
                 

                    <div class="d-flex gap-2">
                        <a class="btn btn-sm btn-primary mb-2 mx-1" href="{{ route('playlistmusic.edit', ['id' => $playlistmusic->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        
                        <a class="btn btn-sm btn-primary mb-2 mx-1 "  href="{{ route('playlistmusic.details', ['id' => $playlistmusic->id]) }}" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                        <!-- Delete option -->
                        <form class="" action="{{ route('playlistmusic.destroy', ['id' => $playlistmusic->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this playlimusic record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                 </td>
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
                    <form class="" action="{{ route('playlistmusic.status', ['id' => $playlistmusic->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if($playlistmusic->status =='active')
                            <input type="hidden" value="inactive" name="status">
                            <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                {{$playlistmusic->status}}
                            </button>
                        @endif
                        @if($playlistmusic->status =='inactive')
                            <input type="hidden" value="active" name="status">
                            <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                {{$playlistmusic->status}}
                            </button>
                        @endif
                    </form>
                
                </td>
              
              </tr>
              @endforeach

             
            </tbody>
        </table>
        {{ $playlistMusic->links('pagination::bootstrap-4') }}
        
        
    </div>
</div>
@endsection