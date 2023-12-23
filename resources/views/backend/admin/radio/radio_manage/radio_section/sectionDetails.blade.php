@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($radioSection) ? $radioSection->title : old('title') }} - Manage
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('radio.section.index',['radio_id' => $radio_id])}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>
                                Section List</a>

                            @if(isset($radioSection->id))
                               
                                <form action="{{ route('radio.section.destroy', ['id' => $radioSection->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Radio Section record?')">Delete</button>
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

                        <form method="POST" action="{{ route('radio.section.item.create',['radio_custom_categorie_id' => $radio_custom_categorie_id]) }}" class="mt-3">
                            @csrf
                            <input type="hidden" name="radio_custom_categorie_id" value="{{ $radioSection->id }}">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div>Choose Type:</div>
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="radioPodcast" value="podcast">
                                        <label class="ml-2" for="radioPodcast">Podcast</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="radioMusic" value="music">
                                        <label class="ml-2" for="radioMusic">Music</label>
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
                                    <th scope="col">File</th>
                                    <th scope="col">Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categoryItems as $categoryItem)
                                    <tr>
                                            <td>
                                                <!-- Edit option -->
                    <div class="d-flex gap-2">
                    
                        @if(isset($categoryItem->playlist_music_id))
                        <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('playlistmusic.details',['id' => $categoryItem->music->id])}}" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                    @else
                        <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('podcast.details',['id' => $categoryItem->podcast->id])}}" data-toggle="tooltip" data-placement="top" title="Podcast Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                    @endif
                       
                   
                        <form class="" action="{{ route('radio.section.item.destroy', ['radioSectionItemId' => $categoryItem->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this section record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                                        </td>
                                        <td>
                                            {{ $categoryItem->id}}
                                        </td>
                                        <td>
                                                @if(isset($categoryItem->playlist_music_id))
                                                <a href="{{ route('playlistmusic.details',['id' => $categoryItem->music->id])}}" class="">{{ $categoryItem->music->title }}
                                                </a>

                                                @else
                                                    <a href="{{ route('podcast.details',['id' => $categoryItem->podcast->id])}}" class="">
                                                        {{ $categoryItem->podcast->title }}
                                                    </a>
                                                @endif
                                        </td>
                                        
                                        <td>
                                            
                                                @if(isset($categoryItem->playlist_music_id))
                                                <span class="badge badge-primary">Music</span>
            
                                                @else
                                                <span class="badge badge-warning">Podcast</span>
                                                @endif
                                        </td>
                                        <td style="width: 30%">
                                                @if(isset($categoryItem->playlist_music_id))
                                                    @if($categoryItem->music->music_link)
                                                       <a href="{{ $categoryItem->music->music_link }}" class="card-link my-3" style="margin-top:10px;margin-button:10px">Link: {{ $categoryItem->music->music_link }}</a>
                                                    @else
                                                        <a href="{{ asset('music_file/' . $categoryItem->music->music_file ) }}" class="card-link " style="margin-top:10px;margin-button:10px">Link: {{ asset('music_file/' . $categoryItem->music->music_file ) }}</a>
                                                    @endif
                                                    @if($categoryItem->music->music_link )
                                                        <audio controls style="width: 100%;
                                                        height: 35px;">
                                                            <source src="{{ $categoryItem->music->music_link }}" type="audio/mpeg">
                                                        </audio>
                                                    
                                                    @else
                                                        <audio controls style="width: 100%;
                                                        height: 35px;">
                                                            <source src="{{ asset('music_file/' . $categoryItem->music->music_file ) }}" type="audio/mpeg">
                                                        </audio>
                                                    @endif
                                                @else
                                                    @if($categoryItem->podcast->audio_link)
                                                      <a href="{{ $categoryItem->podcast->audio_link }}" class="card-link my-3" style="margin-top:10px;margin-button:10px">Link: {{ $categoryItem->podcast->audio_link }}</a>

                                                    @else
                                                        <a href="{{ asset('podcast/audio/' . $categoryItem->podcast->audio_link ) }}" class="card-link " style="margin-top:10px;margin-button:10px">Link: {{ asset('podcast/audio/' . $categoryItem->podcast->audio_link ) }}</a>
                                                    @endif
                                                    @if($categoryItem->podcast->audio_link )
                                                         <audio controls style="width: 100%;
                                                            height: 35px;">
                                                            <source src="{{ $categoryItem->podcast->audio_link }}" type="audio/mpeg">
                                                        </audio>
                                                    @else
                                                        <audio controls style="width: 100%;
                                                        height: 35px;">
                                                            <source src="{{ asset('podcast/audio/' . $categoryItem->podcast->audio ) }}" type="audio/mpeg">
                                                        </audio>
                                                       
                                                    @endif
                                                @endif
                                        </td>
                                   
                                        <td>
                                                @if(isset($categoryItem->playlist_music_id))
                                                    <a href="{{ route('playlistmusic.details',['id' => $categoryItem->music->id])}}" class="">
                                                        <img src="{{ asset('image/music/' . $categoryItem->music->image) }}" alt="{{ $categoryItem->music->title }}" style="width: 50px; height: 50px">
                                                    </a>

                                                    
                                                @else
                                                      <a href="{{ route('podcast.details',['id' => $categoryItem->podcast->id])}}" class="">
                                                        <img src="{{ asset('podcast/image/' . $categoryItem->podcast->image) }}" alt="{{ $categoryItem->podcast->title }}" style="width: 50px; height: 50px">
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
        const radioPodcast = document.getElementById('radioPodcast');
        const radioMusic = document.getElementById('radioMusic');
        const podcastSection = document.querySelector('.podcast-section');
        const musicSection = document.querySelector('.music-section');

        radioPodcast.addEventListener('change', function () {
            podcastSection.style.display = this.checked ? 'block' : 'none';
            musicSection.style.display = 'none';
        });

        radioMusic.addEventListener('change', function () {
            musicSection.style.display = this.checked ? 'block' : 'none';
            podcastSection.style.display = 'none';
        });
    });
</script>
@endsection