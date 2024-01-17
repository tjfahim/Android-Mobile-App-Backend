@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($video) && $video->id ? 'Video Edit' : 'Video Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('video.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>Video List</a>

                            @if(isset($video->id))
                             
                                <form action="{{ route('video.destroy', ['id' => $video->id]) }}" method="post">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Video record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($video) && $video->id ? route('video.process', ['id' => $video->id]) : route('video.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($video) && $video->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Video Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Title" value="{{ isset($video) ? $video->title : old('title') }}" name="title">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div>Choose Type:</div>
                                    <div class="form-check form-check-inline">
                                        <input class="" type="radio" name="type" id="video" value="video" {{ (isset($video) && $video->type == 'video') ? 'checked' : '' }}>
                                        <label class="ml-2" for="video">Video</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="" type="radio" name="type" id="iframe" value="iframe" {{ (isset($video) && $video->type == 'iframe') ? 'checked' : '' }}>
                                        <label class="ml-2" for="iframe">Iframe</label>
                                    </div>
                                </div>
                                
                                <div class="video-section ml-2 col-md-8" style="display: none;">
                                    <div class=" mt-2">
                                        <div class="form-group">
                                            <label for="video_link">Enter Video Link</label><small class="text-small text-danger"> (* Preferred Mp4 Video)</small>
                                            <input type="text" class="form-control" placeholder="Enter Video Link" value="{{ isset($video) ? $video->video_link : old('video_link') }}" name="video_link">
                                            @error('video_link')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="iframe-section ml-2 col-md-8" style="display: none;">
                                    <div class=" mt-2">
                                        <div class="form-group">
                                            <label for="iframe_link">Iframe Video Link </label><small class="text-small text-danger"> (* Iframe Video Link Only)</small>
                                            <input type="text" class="form-control" placeholder="Enter Iframe Link" value="{{ isset($video) ? $video->video_link : old('video_link') }}" name="iframe_link">
                                            @error('iframe_link')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <input type="text" class="form-control" placeholder="Enter Description" value="{{ isset($video) ? $video->details : old('details') }}" name="details">
                                        @error('details')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                         
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image </label><small class="text-small text-danger"> (* Preferred Image 400*460 and PNG)</small>
                                        <input type="file" class="form-control" name="image" id="imageInput" onchange="previewImage()">
                                        @if(isset($video) && $video->image)
                                            <img src="{{ asset('image/video/' . $video->image) }}" alt="{{ $video->name }}" id="imagePreview" style="width: 100px; height: 115px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="width: 100px; height: 115px; display: none; margin-top: 10px;">
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
                                            <option value="active" {{ isset($video) && $video->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($video) && $video->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($video) && $video->id ? 'Update Video' : 'Add Video' }}
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
        const iframe = document.getElementById('iframe');
        const video = document.getElementById('video');
    
        const iframeSection = document.querySelector('.iframe-section');
        const videoSection = document.querySelector('.video-section');
    
        iframe.addEventListener('change', function () {
            iframeSection.style.display = this.checked ? 'block' : 'none';
            videoSection.style.display = 'none';
        });
    
        video.addEventListener('change', function () {
            iframeSection.style.display = 'none';
            videoSection.style.display = this.checked ? 'block' : 'none';
        });
    });
    </script>


@endsection