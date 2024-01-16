@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($homeSection) && $homeSection->id ? 'Content Section Edit' : 'Content Section Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>Section List</a>

                            @if(isset($homeSection->id))
                               
                                <form action="{{ route('home.section.destroy', ['id' => $homeSection->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Home Section record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($homeSection) && $homeSection->id ? route('home.section.process', ['id' => $homeSection->id]) : route('home.section.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($homeSection) && $homeSection->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Section Name" value="{{ isset($homeSection) ? $homeSection->title : old('title') }}" name="title">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" id="imageInput" onchange="previewImage()">
                                        @if(isset($homeSection) && $homeSection->image)
                                            <img src="{{ asset('image/home/' . $homeSection->image) }}" alt="{{ $homeSection->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="imagePreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('image')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="">
                                            <option value="active" {{ isset($homeSection) && $homeSection->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($homeSection) && $homeSection->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($homeSection) && $homeSection->id ? 'Update Content Section' : 'Add Content Section' }}
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