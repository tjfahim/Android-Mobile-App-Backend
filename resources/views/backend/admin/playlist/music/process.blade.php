@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($playlistmusic) && $playlistmusic->id ? 'Music Edit' : 'Music Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('playlistmusic.index')}}" class="btn btn-primary btn-sm ml-2">Music List</a>
                            @if(isset($playlistmusic->id)){

                            <a href="{{ route('playlistmusic.details', ['id' => $playlistmusic->id])}}" class="btn btn-primary btn-sm ml-2">Details</a>
                            <form action="{{ route('playlistmusic.destroy', ['id' => $playlistmusic->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this playlistmusic record?')">Delete</button>
                            </form>
                        }
                        @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($playlistmusic) && $playlistmusic->id ? route('playlistmusic.process', ['id' => $playlistmusic->id]) : route('playlistmusic.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($playlistmusic) && $playlistmusic->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Music Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Music Name" value="{{ isset($playlistmusic) ? $playlistmusic->title : old('title') }}" name="title">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sub Title</label>
                                        <input type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="{{ isset($playlistmusic) ? $playlistmusic->subtitle : old('subtitle') }}">
                                        @error('subtitle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Artist</label>
                                        <input type="text" class="form-control" name="artist" placeholder="Enter Artist" value="{{ isset($playlistmusic) ? $playlistmusic->artist : old('artist') }}">
                                        @error('artist')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Music Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Link" value="{{ isset($playlistmusic) ? $playlistmusic->music_link : old('music_link') }}" name="music_link">
                                        @error('music_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Music File (Audio)</label>
                                        <input type="file" class="form-control" name="music_file" id="audioInput" onchange="previewAudio()">
                                        @if(isset($playlistmusic) && $playlistmusic->music_file)
                                            <audio controls style="margin-top: 10px;">
                                                <source src="{{ asset('music_file/' . $playlistmusic->music_file) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @else
                                            <audio controls style="margin-top: 10px; display: none;" id="audioPreview">
                                                <source src="#" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @endif
                                        @error('music_file')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="imageInput" onchange="previewImage()">
                                        @if(isset($playlistmusic) && $playlistmusic->image)
                                            <img src="{{ asset('image/music/' . $playlistmusic->image) }}" alt="{{ $playlistmusic->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Feature Image</label>
                                        <input type="file" class="form-control" name="feature_image" id="feature_imageInput" onchange="previewfeature_image()">
                                        @if(isset($playlistmusic) && $playlistmusic->feature_image)
                                            <img src="{{ asset('image/music/' . $playlistmusic->feature_image) }}" alt="{{ $playlistmusic->title }}" id="feature_imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="feature_imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('feature_image')
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
                                            <option value="active"  {{ $playlistmusic->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $playlistmusic->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($playlistmusic) && $playlistmusic->id ? 'Update Music' : 'Add Music' }}
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
    function previewfeature_image() {
        var input = document.getElementById('feature_imageInput');
        var preview = document.getElementById('feature_imagePreview');

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
    function previewAudio() {
        var input = document.getElementById('audioInput');
        var audio = document.getElementById('audioPreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                audio.src = e.target.result;
                audio.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection