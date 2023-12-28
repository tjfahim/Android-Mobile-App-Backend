@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Details Page</h4>
                        <div class="d-flex gap-2">
                        
                            <form action="{{ route('podcast.edit', ['id' => $podcast->id]) }}">
                                <input type="hidden" name="podcast_category_id" value="{{$podcast->podcast_category_id}}">
                                <button type="submit" class="btn btn-sm btn-primary ml-2">Edit</button>
                            </form>
                            <form action="{{ route('podcast.destroy', ['id' => $podcast->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="podcast_category_id" value="{{$podcast->podcast_category_id}}">
                                <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title: </label><br>
                                        {{ isset($podcast) ? $podcast->title : old('title') }}
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sub Title: </label><br>
                                        {{ isset($podcast) ? $podcast->subtitle : old('subtitle') }}
                                    </div>
                                </div>
                            </div>
                       
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Audio Link: </label><br>
                                        {{ isset($podcast) ? $podcast->audio_link : old('audio_link') }}
                                        {{ isset($podcast) ? asset('podcast/audio/' .$podcast->audio) : old('audio_link') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Audio: </label><br>
                                        @if(isset($podcast) && $podcast->audio)
                                            <audio controls style="margin-top: 10px;">
                                                <source src="{{ asset('podcast/audio/' . $podcast->audio) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @else
                                            <audio controls style="margin-top: 10px; display: none;" id="audioPreview">
                                                <source src="{{$podcast->audio }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Video Link: </label><br>
                                        {{ isset($podcast) ? $podcast->video_link : old('audio_link') }}
                                        
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Video: </label><br>
                                        @if(isset($podcast) && $podcast->video)
                                            <video controls style="margin-top: 10px;">
                                                <source src="{{ asset('podcast/video/' . $podcast->video) }}">
                                                Your browser does not support the video element.
                                            </video>
                                        @else
                                            <video controls style="margin-top: 10px; display: none;" id="videoPreview">
                                                <source src="{{$podcast->video_link }}">
                                                Your browser does not support the video element.
                                            </video>
                                        @endif
                                    </div>
                                </div>
                            </div> --}}
                            


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image: </label><br>
                                        {{ isset($podcast) ? asset('podcast/image/' .$podcast->image) : old('image') }}

                                        @if(isset($podcast) && $podcast->image)
                                            <img src="{{ asset('podcast/image/' . $podcast->image) }}" alt="{{ $podcast->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                           
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>

@endsection