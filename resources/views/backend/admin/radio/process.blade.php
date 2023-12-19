@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            {{ isset($radio) && $radio->id ? 'Radio Edit' : 'Radio Create' }}
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($radio) && $radio->id ? route('radio.process', ['id' => $radio->id]) : route('radio.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($radio) && $radio->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Radio Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Radio Name" value="{{ isset($radio) ? $radio->title : old('title') }}" name="title">
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
                                        <input type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="{{ isset($radio) ? $radio->subtitle : old('subtitle') }}">
                                        @error('subtitle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Radio Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Link" value="{{ isset($radio) ? $radio->radio_link : old('radio_link') }}" name="radio_link">
                                        @error('radio_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Radio File (Audio)</label>
                                        <input type="file" class="form-control" name="radio_file" id="audioInput" onchange="previewAudio()">
                                        @if(isset($radio) && $radio->radio_file)
                                            <audio controls style="margin-top: 10px;">
                                                <source src="{{ asset('radio_file/' . $radio->radio_file) }}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @else
                                            <audio controls style="margin-top: 10px; display: none;" id="audioPreview">
                                                <source src="#" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @endif
                                        @error('radio_file')
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
                                        @if(isset($radio) && $radio->image)
                                            <img src="{{ asset('image/radio/' . $radio->image) }}" alt="{{ $radio->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
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
                                        <label>Color Code</label>
                                        <input type="color" class="form-control" name="background_color" value="{{ $radio->background_color ?? '#000000' }}" placeholder="Select color">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="">
                                            <option value="active" {{ isset($radio) && $radio->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($radio) && $radio->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                          
                                        </select>
                                    </div>
                                 </div>
                                
                            </div>

                            
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($radio) && $radio->id ? 'Update' : 'Add Radio' }}
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