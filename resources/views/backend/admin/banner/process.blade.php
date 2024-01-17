@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($banner) && $banner->id ? 'Banner Edit' : 'Banner Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                       
                            @if(isset($banner->id))
                            <a href="{{ route('banner.details', ['id' => $banner->id])}}" class="btn btn-primary btn-sm ml-2">Details</a>
                            <form action="{{ route('banner.destroy', ['id' => $banner->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this banner record?')">Delete</button>
                            </form>
                        
                        @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ isset($banner) && $banner->id ? route('banner.process', ['id' => $banner->id]) : route('banner.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($banner) && $banner->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Banner Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Music Name" value="{{ isset($banner) ? $banner->title : old('title') }}" name="title">
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
                                        <input type="text" class="form-control" name="subtitle" placeholder="Enter Subtitle" value="{{ isset($banner) ? $banner->subtitle : old('subtitle') }}">
                                        @error('subtitle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Banner Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Link" value="{{ isset($banner) ? $banner->banner_link : old('banner_link') }}" name="banner_link">
                                        @error('banner_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                      
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image </label><small class="text-small text-danger"> (* Preferred Image 320*50 and PNG)</small>

                                        <input type="file" class="form-control" name="image" id="imageInput" onchange="previewImage()">
                                        @if(isset($banner) && $banner->image)
                                            <img src="{{ asset('image/banner/' . $banner->image) }}" alt="{{ $banner->title }}" id="imagePreview" style="width: 320px; height: 50px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="width: 320px; height: 50px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="">
                                            <option value="active" {{ isset($banner) && $banner->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($banner) && $banner->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                 </div>
                            </div>
                            </div>

                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($banner) && $banner->id ? 'Update Banner' : 'Add Banner' }}
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




@endsection