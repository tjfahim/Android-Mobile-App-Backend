@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Music Details Page</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('playlistmusic.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>Music List</a>
                            <a href="{{ route('playlistmusic.edit', ['id' => $playlistmusic->id])}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <form action="{{ route('playlistmusic.destroy', ['id' => $playlistmusic->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Music record?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card-body text-center">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title: </label><br>
                                        {{ isset($playlistmusic) ? $playlistmusic->title : old('title') }}
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sub Title: </label><br>
                                        {{ isset($playlistmusic) ? $playlistmusic->subtitle : old('subtitle') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Artist: </label><br>
                                        {{ isset($playlistmusic) ? $playlistmusic->artist : old('artist') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Music Link: </label><br>
                                        {{ isset($playlistmusic) ? $playlistmusic->music_link : old('music_link') }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Music File (Audio): </label><br>
                                     
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
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image: </label><br>
                                      
                                        @if(isset($playlistmusic) && $playlistmusic->image)
                                            <img src="{{ asset('image/music/' . $playlistmusic->image) }}" alt="{{ $playlistmusic->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Feature Image: </label><br>
                                       
                                        @if(isset($playlistmusic) && $playlistmusic->feature_image)
                                            <img src="{{ asset('image/music/' . $playlistmusic->feature_image) }}" alt="{{ $playlistmusic->title }}" id="feature_imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="feature_imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
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