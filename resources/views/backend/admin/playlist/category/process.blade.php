@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($playlistcategory) && $playlistcategory->id ? 'Category Edit' : 'Category Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('playlistcategory.index')}}" class="btn btn-primary btn-sm ml-2">Music List</a>
                            @if(isset($playlistcategory->id))
                                <a href="{{ route('playlistcategory.details', ['id' => $playlistcategory->id])}}" class="btn btn-primary btn-sm ml-2">Details</a>

                                <form action="{{ route('playlistcategory.destroy', ['id' => $playlistcategory->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this playlistcategory record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($playlistcategory) && $playlistcategory->id ? route('playlistcategory.process', ['id' => $playlistcategory->id]) : route('playlistcategory.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($playlistcategory) && $playlistcategory->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Category Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Category Name" value="{{ isset($playlistcategory) ? $playlistcategory->title : old('title') }}" name="title">
                                        @error('title')
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
                                        @if(isset($playlistcategory) && $playlistcategory->image)
                                            <img src="{{ asset('image/playlist/' . $playlistcategory->image) }}" alt="{{ $playlistcategory->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
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
                                            <option value="active"  {{ $playlistcategory->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $playlistcategory->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($playlistcategory) && $playlistcategory->id ? 'Update' : 'Add Category' }}
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