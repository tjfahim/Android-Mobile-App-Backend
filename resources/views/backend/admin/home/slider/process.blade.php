@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($slider) && $slider->id ? 'Slider Edit' : 'Slider Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('home.slider.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>Slider List</a>

                            @if(isset($slider->id))
                                <form action="{{ route('home.slider.destroy', ['id' => $slider->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this slider record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($slider) && $slider->id ? route('home.slider.process', ['id' => $slider->id]) : route('home.slider.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($slider) && $slider->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>slider Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" value="{{ isset($slider) ? $slider->title : old('title') }}" name="title">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="form-group col-md-12">
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
                                            <div class="form-check form-check-inline">
                                                <input class="mt-3" type="radio" name="content_type" id="homeCustom" value="custom">
                                                <label class="ml-2" for="homeCustom">Custom</label>
                                            </div>
                                        </div>
                                        <div class="podcast-category-section ml-3" style="display: none;">
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
                                        <div class="podcast-section ml-3" style="display: none;">
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
                                        <div class="playlist-section ml-3" style="display: none;">
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
                                        <div class="music-section ml-3" style="display: none;">
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
                                        <div class="custom-section ml-3" style="display: none;">
                                            <div class="mt-2">
                                                <div class="">
                                                    <label for="customInput">Custom Link</label>
                                                    <input type="text" name="custom_input" id="customInput" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Slider Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Slider Link" value="{{ isset($slider) ? $slider->slider_link : old('title') }}" name="slider_link">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="imageInput" onchange="previewImage()">
                                        @if(isset($slider) && $slider->image)
                                            <img src="{{ asset('image/slider/' . $slider->image) }}" alt="{{ $slider->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="">
                                            <option value="active" {{ isset($slider) && $slider->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($slider) && $slider->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($slider) && $slider->id ? 'Update' : 'Add' }}
                            </button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
<script>
    function previewImage() {
        var input = document.getElementById('imageInput');
        var preview = document.getElementById('imagePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        const homePodcastCategory = document.getElementById('homePodcastCategory');
    const homeMusic = document.getElementById('homeMusic');
    const homePodcast = document.getElementById('homePodcast');
    const homePlaylist = document.getElementById('homePlaylist');
    const homeCustom = document.getElementById('homeCustom'); 

    const podcastSection = document.querySelector('.podcast-section');
    const musicSection = document.querySelector('.music-section');
    const podcastCategorySection = document.querySelector('.podcast-category-section');
    const playlistSection = document.querySelector('.playlist-section');
    const customSection = document.querySelector('.custom-section'); 

    homePodcastCategory.addEventListener('change', function () {
        podcastCategorySection.style.display = this.checked ? 'block' : 'none';
        podcastSection.style.display = 'none';
        musicSection.style.display = 'none';
        playlistSection.style.display = 'none';
                customSection.style.display = 'none';

    });

    homePlaylist.addEventListener('change', function () {
        podcastCategorySection.style.display = 'none';
        podcastSection.style.display = 'none';
        musicSection.style.display = 'none';
        playlistSection.style.display = this.checked ? 'block' : 'none';
                customSection.style.display = 'none';

    });

    homePodcast.addEventListener('change', function () {
        podcastCategorySection.style.display = 'none';
        podcastSection.style.display = this.checked ? 'block' : 'none';
        musicSection.style.display = 'none';
        playlistSection.style.display = 'none';
                customSection.style.display = 'none';

    });

    homeMusic.addEventListener('change', function () {
        podcastCategorySection.style.display = 'none';
        podcastSection.style.display = 'none';
        musicSection.style.display = this.checked ? 'block' : 'none';
        playlistSection.style.display = 'none';
        customSection.style.display = 'none';
    });
    homeCustom.addEventListener('change', function () {
            podcastCategorySection.style.display = 'none';
            podcastSection.style.display = 'none';
            musicSection.style.display = 'none';
            playlistSection.style.display = 'none';

            customSection.style.display = this.checked ? 'block' : 'none';
        });
});
</script>
@endsection