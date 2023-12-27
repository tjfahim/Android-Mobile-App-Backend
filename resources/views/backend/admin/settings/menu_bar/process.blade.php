@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($bar) && $bar->id ? 'Menu Edit' : 'Menu Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('menu_bar.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>Menu List</a>

                            @if(isset($bar->id))
                                <form action="{{ route('menu.bar.destroy', ['id' => $bar->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Menu record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($bar) && $bar->id ? route('menu.bar.process', ['id' => $bar->id]) : route('menu.bar.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($bar) && $bar->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Menu Name</label>
                                        <input type="text" class="form-control" placeholder="Enter Name" value="{{ isset($bar) ? $bar->name : old('name') }}" name="name">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Menu Link</label>
                                        <input type="text" class="form-control" placeholder="Enter link" value="{{ isset($bar) ? $bar->link : old('link') }}" name="link">
                                        @error('link')
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
                                        @if(isset($bar) && $bar->image)
                                            <img src="{{ asset('image/menu_bar/' . $bar->image) }}" alt="{{ $bar->name }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
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
                                            <option value="active" {{ isset($bar) && $bar->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($bar) && $bar->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($bar) && $bar->id ? 'Update' : 'Add' }}
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