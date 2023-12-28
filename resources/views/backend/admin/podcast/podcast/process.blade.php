@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($podcast) && $podcast->id ? 'Podcast Edit' : 'Podcast Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                       
                            @if(isset($podcast->id))
                            <a href="{{ route('podcast.details', ['id' => $podcast->id])}}" class="btn btn-primary btn-sm ml-2">Details</a>
                            <form action="{{ route('podcast.destroy', ['id' => $podcast->id]) }}" method="post">
                                @csrf
                                <input type="hidden" name="podcast_category_id" value="{{$podcast->podcast_category_id}}">
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this podcast record?')">Delete</button>
                            </form>
                        
                        @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($podcast) && $podcast->id ? route('podcast.process', ['id' => $podcast->id]) : route('podcast.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($podcast) && $podcast->id)
                                @method('PUT')
                            @endif
                            <input type="hidden" name="podcast_category_id" value="{{ $podcast_category_id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Podcast Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Music Name" value="{{ isset($podcast) ? $podcast->title : old('title') }}" name="title">
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
                                        <input type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="{{ isset($podcast) ? $podcast->subtitle : old('subtitle') }}">
                                        @error('subtitle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Audio Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Link" value="{{ isset($podcast) ? $podcast->audio_link : old('audio_link') }}" name="audio_link">
                                        @error('audio_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Audio</label>
                                        <input type="file" class="form-control" name="audio" id="audioInput" onchange="previewAudio()">
                                        @if(isset($podcast) && $podcast->audio)
                                            <audio controls style="margin-top: 10px;">
                                                <source src="{{ asset('audio/' . $podcast->audio) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @elseif(isset($podcast) && $podcast->audio_link)
                                            <audio controls style="margin-top: 10px; display: none;" id="audioPreview">
                                                <source src="{{ $podcast->audio_link }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @endif
                                        @error('audio')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Video Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Link" value="{{ isset($podcast) ? $podcast->video_link : old('video_link') }}" name="video_link">
                                        @error('video_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                        @if(isset($podcast) && $podcast->video_link)
                                     
                                        <video controls style="margin-top: 10px; display: none;height:200px;width:200px;" id="videoPreview">
                                            <source src="{{ asset($podcast->video_link) }}" >
                                            Your browser does not support the video element.
                                        </video>
                                    @endif
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>video</label>
                                        <input type="file" class="form-control" name="video" id="videoInput" onchange="previewvideo()">
                                        @if(isset($podcast) && $podcast->video)
                                            <video controls style="margin-top: 10px;height:200px;width:200px;">
                                                <source src="{{ asset('video/' . $podcast->video) }}" type="video/mpeg">
                                                Your browser does not support the video element.
                                            </video>
                                        @else
                                            <video controls style="margin-top: 10px; display: none;height:200px;width:200px;" id="videoPreview">
                                                <source src="#" type="video/mpeg">
                                                Your browser does not support the video element.
                                            </video>
                                        @endif
                                        @error('video')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="imageInput" onchange="previewImage()">
                                        @if(isset($podcast) && $podcast->image)
                                            <img src="{{ asset('podcast/image/' . $podcast->image) }}" alt="{{ $podcast->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Color Code</label>
                                        <input type="color" class="form-control" name="background_color" value="{{ $podcast->background_color ?? '#000000' }}" placeholder="Select color">
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="">
                                            <option value="active" {{ isset($podcast) && $podcast->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($podcast) && $podcast->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                          
                                        </select>
                                    </div>
                                 </div>
                                
                            </div>
                                
                            </div>

                      
                            
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($podcast) && $podcast->id ? 'Update Podcast' : 'Add Podcast' }}
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

<script>
    function previewvideo() {
        var input = document.getElementById('videoInput');
        var video = document.getElementById('videoPreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                video.src = e.target.result;
                video.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection