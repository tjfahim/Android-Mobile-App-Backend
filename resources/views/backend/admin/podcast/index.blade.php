@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Playlist Manage</h4>
        <a href="{{ route('playlistcategory.index')}}" class="btn btn-primary">Category Manage</a>
        <a href="{{ route('playlistmusic.index')}}" class="btn btn-primary">Music Manage</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        
        <h4 class="my-3">Play-List</h4>
        <form method="POST" action="{{ route('playlist.process') }}" class="mt-3">
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="music">Music:</label>
                        <select name="music" id="music" class="form-control">
                            @foreach ($musics as $music)
                                <option value="{{ $music->id }}">{{ $music->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="">&nbsp;</label> 
                        <button type="submit" class="btn btn-primary btn-block">Add</button>
                    </div>
                </div>
            </div>
        </form>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">
                        <form method="get" action="{{ route('playlist.index') }}" class="row">
                            <label for="filter_category" class="col-md-3 mt-2">Category:</label>
                            <select class="form-control col-md-5 mr-2" name="filter_category" id="filter_category">
                                <option value="all" {{ request('filter_category') == 'all' ? 'selected' : '' }}>All Categories</option>
                                @foreach ($categories as $category)
                                    <option class="" value="{{ $category->id }}" {{ request('filter_category') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        
                            <button type="submit" class="btn btn-primary btn-sm col-md-2">Apply</button>
                        </form>
                    </th>
                    <th scope="col">Music</th>
                    <th scope="col">File</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                @foreach($playlists as $playlist)
                    <tr>
                        <td>
                            <a class="" href="{{ route('playlistcategory.details', ['id' => $playlist->category->id]) }}">  {{ $playlist->category->title }}</a>

                          </td>
                        <td>
                            <a class="" href="{{ route('playlistmusic.details', ['id' => $playlist->music->id]) }}">{{ $playlist->music->title }}</a>
                            </td>
                        <td style="width: 30%">
                            @if($playlist->music->music_link)
                                    <a href="{{ $playlist->music->music_link }}" class="card-link my-3" style="margin-top:10px;margin-button:10px">Link: {{ $playlist->music->music_link }}</a>
                            @else
                                <a href="{{ asset('music_file/' . $playlist->music->music_file ) }}" class="card-link " style="margin-top:10px;margin-button:10px">Link: {{ asset('music_file/' . $playlist->music->music_file ) }}</a>
                            @endif
                            @if($playlist->music->music_file )
                            <audio controls style="width: 100%;
                            height: 35px;">
                                <source src="{{ asset('music_file/' . $playlist->music->music_file ) }}" type="audio/mpeg">
                            </audio>
                        @else
                            <audio controls style="width: 100%;
                            height: 35px;">
                                <source src="{{ $playlist->music->music_link }}" type="audio/mpeg">
                            </audio>
                        @endif
                        </td>
                   
                        <td>
                            <a class="" href="{{ route('playlistmusic.details', ['id' => $playlist->music->id]) }}"><img src="{{ asset('image/music/' . $playlist->music->image) }}" alt="{{ $playlist->music->title }}" style="width: 50px; height: 50px"></a>
                            </td>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{ $playlists->links('pagination::bootstrap-4') }}

        </table>
        
        

    </div>
</div>
@endsection