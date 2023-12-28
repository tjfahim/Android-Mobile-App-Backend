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
        <div class="table-responsive">

            {{-- <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">
                        Action
                        </th>
                        <th scope="col">
                        Id
                        </th>

                        <th scope="col">
                            <form method="get" action="{{ route('playlist.index') }}" class="row">
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
                        <th scope="col" style="
                        width: 404px;
                        display: inline-block;
                    ">File</th>
                        <th scope="col">Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($playlists as $playlist)
                        <tr>
                            <td>
                                <form class="" action="{{ route('playlist.destroy', ['id' => $playlist->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this playlist record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                                </form>

                            </td>
                            <td>{{ $playlist->id }}</td>
                            <td>
                                <a class="" href="{{ route('playlistcategory.details', ['id' => $playlist->category->id]) }}">  {{ $playlist->category->title }}</a>

                            </td>
                            <td>
                                <a class="" href="{{ route('playlistmusic.details', ['id' => $playlist->music->id]) }}">{{ $playlist->music->title }}</a>
                                </td>
                            <td style="
                            width: 404px;
                            display: inline-block;
                        ">
                                @if($playlist->music->music_link)
                                        <a href="{{ $playlist->music->music_link }}" class="card-link my-3" style="
                                            width: 404px;
                                            display: inline-block;
                                        ">Link: {{ $playlist->music->music_link }}</a>
                                @else
                                    <a href="{{ asset('music_file/' . $playlist->music->music_file ) }}" class="card-link " style="
                                        width: 404px;
                                        display: inline-block;
                                    ">Link: {{ asset('music_file/' . $playlist->music->music_file ) }}</a>
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
                
            </table> --}}
            <table class="table table-hover table-sm">
                <thead>
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">id</th>
                    <th scope="col">
                        <form method="get" action="{{ route('playlist.index') }}" class="row">
                            <select class="form-control col-md-7 mr-2" name="filter_category" id="filter_category">
                                <option value="all" {{ request('filter_category') == 'all' ? 'selected' : '' }}>All Categories</option>
                                @foreach ($categories as $category)
                                    <option class="" value="{{ $category->id }}" {{ request('filter_category') == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                        
                            <button type="submit" class="btn btn-primary btn-sm col-md-4">Apply</button>
                        </form>
                    </th>
                    <th scope="col">Music</th>
                    <th scope="col">file</th>
                    <th scope="col">Image</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($playlists as $playlist)
                  <tr style="">
                    <td>
                        <div class="d-flex gap-2">
                            <form class="" action="{{ route('playlist.destroy', ['id' => $playlist->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this playlist record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </td>
                  
                    
                    <th scope="row"> {{ $playlist->id }}</th>
                    <td>
                        <a class="" href="{{ route('playlistcategory.details', ['id' => $playlist->category->id]) }}">  {{ $playlist->category->title }}</a>
                    </td>
                    <td>
                        <a class="" href="{{ route('playlistmusic.details', ['id' => $playlist->music->id]) }}">{{ $playlist->music->title }}</a>
                    </td>
                    <td style="width: 350px;display:block">
                        @if($playlist->music->music_link)
                        <a href="{{ $playlist->music->music_link }}" class="card-link my-3" style="
                            width: 404px;
                            display: inline-block;
                        ">Link: {{ $playlist->music->music_link }}</a>
                        @else
                            <a href="{{ asset('music_file/' . $playlist->music->music_file ) }}" class="card-link " style="
                                width: 404px;
                                display: inline-block;
                            ">Link: {{ asset('music_file/' . $playlist->music->music_file ) }}</a>
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
                    
                    <td style="display: none">
                       
                        
                    </td>
                  </tr>
                  @endforeach
    
                 
                </tbody>
            </table>
            {{ $playlists->links('pagination::bootstrap-4') }}
        </div>
        

    </div>
</div>
@endsection