@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($homeSection) ? $homeSection->title : old('title') }} - Manage
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>
                                Section List</a>

                            @if(isset($homeSection->id))
                               
                                <form action="{{ route('home.section.destroy', ['id' => $homeSection->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Home Section record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('home.section.item.create',['home_section_id' => $home_section_id]) }}" class="mt-3">
                            @csrf
                            <input type="hidden" name="home_section_id" value="{{ $home_section_id }}">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div>Choose Type:</div>
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="homePodcastCategory" value="podcastCategory">
                                        <label class="ml-2" for="homePodcastCategory">Podcast Category</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="homePodcast" value="podcast">
                                        <label class="ml-2" for="homePodcast">Podcast</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="homePlaylist" value="playlist">
                                        <label class="ml-2" for="homePlaylist">Playlist</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="homeMusic" value="music">
                                        <label class="ml-2" for="homeMusic">Music</label>
                                    </div>
                                </div>
                                <div class="podcast-category-section" style="display: none;">
                                    <div class=" mt-2">
                                        <div class="form-group">
                                            <label for="podcast">Podcast Category</label>
                                            <select name="podcast_categorie_id" id="podcast_categorie_id" class="form-control">
                                                <option value="">Select Podcast Category</option>

                                                @foreach ($podcast_catgory as $podcast_cat)
                                                    <option value="{{ $podcast_cat->id }}">{{ $podcast_cat->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="podcast-section" style="display: none;">
                                    <div class=" mt-2">
                                        <div class="form-group">
                                            <label for="podcast">Podcast</label>
                                            <select name="podcast_id" id="podcast_id" class="form-control">
                                                <option value="">Select Podcast</option>

                                                @foreach ($podcasts as $podcast)
                                                    <option value="{{ $podcast->id }}">{{ $podcast->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="playlist-section" style="display: none;">
                                    <div class="mt-2">
                                        <div class="">
                                            <label for="music">Playlist:</label>
                                            <select name="playlist_categorie_id" id="playlist_categorie_id" class="form-control">
                                                <option value="">Select Playlist</option>

                                                @foreach ($playlist_catgory as $playlist)
                                                    <option value="{{ $playlist->id }}">{{ $playlist->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="music-section" style="display: none;">
                                    <div class="mt-2">
                                        <div class="">
                                            <label for="music">Music:</label>
                                            <select name="playlist_music_id" id="playlist_music_id" class="form-control">
                                                <option value="">Select Music</option>

                                                @foreach ($musics as $music)
                                                    <option value="{{ $music->id }}">{{ $music->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label> 
                                        <button type="submit" class="btn btn-primary btn-block">Add Item</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sectionItems as $sectionItem)
                                    <tr>
                                        <td style="width:20%">
                                            <div class="d-flex gap-2">
                                            @if(isset($sectionItem->playlist_categorie_id))
                                                
                                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('playlistcategory.details',['id' => $sectionItem->playlistMusic->id])}}" data-toggle="tooltip" data-placement="top" title="Playlist Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                                            @elseif(isset($sectionItem->playlist_music_id))
                                                
                                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('playlistmusic.details',['id' => $sectionItem->music->id])}}" data-toggle="tooltip" data-placement="top" title=" Music Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                                            @elseif(isset($sectionItem->podcast_categorie_id))
                                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('podcastcategory.details',['id' => $sectionItem->podcastCategory->id])}}" data-toggle="tooltip" data-placement="top" title="Podcast Catgory Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                                            @elseif(isset($sectionItem->podcast_id))
                                           
                                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('podcast.details',['id' => $sectionItem->podcast->id])}}" data-toggle="tooltip" data-placement="top" title="Podcast Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                                       
                                    @endif
                                     
                                            <form class="" action="{{ route('home.section.item.destroy', ['id' => $sectionItem->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Section Item record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                                            </form>
                                            </div>
                                        </td>
                                        <td>
                                               {{ $sectionItem->id }}
                                        </td>
                                        <td>
                                                @if(isset($sectionItem->playlist_categorie_id))
                                                <a href="{{ route('playlistcategory.details',['id' => $sectionItem->playlistMusic->id])}}" class="">{{ $sectionItem->playlistMusic->title }}
                                                </a>

                                                @elseif(isset($sectionItem->playlist_music_id))
                                                    <a href="{{ route('playlistmusic.details',['id' => $sectionItem->music->id])}}" class="">
                                                        {{ $sectionItem->music->title }}
                                                    </a>
                                                    
                                                @elseif(isset($sectionItem->podcast_categorie_id))
                                                    <a href="{{ route('podcastcategory.details',['id' => $sectionItem->podcastCategory->id])}}" class="">
                                                        {{ $sectionItem->podcastCategory->title }}
                                                    </a>

                                                @elseif(isset($sectionItem->podcast_id))
                                                    <a href="{{ route('podcast.details',['id' => $sectionItem->podcast->id])}}" class="">
                                                        {{ $sectionItem->podcast->title }}
                                                    </a>

                                                @endif
                                        </td>
                                        
                                        <td>

                                                @if(isset($sectionItem->playlist_categorie_id))
                                                <span class="badge badge-primary">Playlist</span>
            
                                                @elseif(isset($sectionItem->playlist_music_id))
                                                <span class="badge badge-warning">Music</span>

                                                @elseif(isset($sectionItem->podcast_categorie_id))
                                                <span class="badge badge-primary">Podcast Category</span>

                                                @elseif(isset($sectionItem->podcast_id))
                                                <span class="badge badge-success">Podcast</span>
                                                @endif
                                        </td>
                                   
                                        <td>
                                            @if(isset($sectionItem->playlist_categorie_id))
                                                        <a href="{{ route('playlistcategory.details',['id' => $sectionItem->playlistMusic->id])}}" class="">
                                                        <img src="{{ asset('image/playlist/' . $sectionItem->playlistMusic->image) }}" alt="{{ $sectionItem->playlistMusic->title }}" style="width: 50px; height: 50px">
                                                    </a>
                                            @elseif(isset($sectionItem->playlist_music_id))
                                                    <a href="{{ route('playlistmusic.details',['id' => $sectionItem->music->id])}}" class="">
                                                        <img src="{{ asset('image/music/' . $sectionItem->music->image) }}" alt="{{ $sectionItem->music->title }}" style="width: 50px; height: 50px">
                                                    </a>
                                            @elseif(isset($sectionItem->podcast_categorie_id))
                                                    <a href="{{ route('podcastcategory.details',['id' => $sectionItem->podcastCategory->id])}}" class="">
                                                        <img src="{{ asset('podcast/image/' . $sectionItem->podcastCategory->image) }}" alt="{{ $sectionItem->podcastCategory->title }}" style="width: 50px; height: 50px">
                                                      </a>
                                            @elseif(isset($sectionItem->podcast_id))
                                                      <a href="{{ route('podcast.details',['id' => $sectionItem->podcast->id])}}" class="">
                                                        <img src="{{ asset('podcast/image/' . $sectionItem->podcast->image) }}" alt="{{ $sectionItem->podcast->title }}" style="width: 50px; height: 50px">
                                                      </a>
                                                   
                                                @endif

                                        </td>
                                      
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12">No data available</td>
                                    </tr>
                                @endforelse                            
                            </tbody>
                
                        </table>
                    </div>
                </div>
            </div>

         
            
          
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homePodcastCategory = document.getElementById('homePodcastCategory');
    const homeMusic = document.getElementById('homeMusic');
    const homePodcast = document.getElementById('homePodcast');
    const homePlaylist = document.getElementById('homePlaylist');

    const podcastSection = document.querySelector('.podcast-section');
    const musicSection = document.querySelector('.music-section');
    const podcastCategorySection = document.querySelector('.podcast-category-section');
    const playlistSection = document.querySelector('.playlist-section');

    homePodcastCategory.addEventListener('change', function () {
        podcastCategorySection.style.display = this.checked ? 'block' : 'none';
        podcastSection.style.display = 'none';
        musicSection.style.display = 'none';
        playlistSection.style.display = 'none';
    });

    homePlaylist.addEventListener('change', function () {
        podcastCategorySection.style.display = 'none';
        podcastSection.style.display = 'none';
        musicSection.style.display = 'none';
        playlistSection.style.display = this.checked ? 'block' : 'none';
    });

    homePodcast.addEventListener('change', function () {
        podcastCategorySection.style.display = 'none';
        podcastSection.style.display = this.checked ? 'block' : 'none';
        musicSection.style.display = 'none';
        playlistSection.style.display = 'none';
    });

    homeMusic.addEventListener('change', function () {
        podcastCategorySection.style.display = 'none';
        podcastSection.style.display = 'none';
        musicSection.style.display = this.checked ? 'block' : 'none';
        playlistSection.style.display = 'none';
    });
});
</script>
@endsection