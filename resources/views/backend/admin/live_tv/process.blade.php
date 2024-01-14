@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($live_tv) && $live_tv->id ? 'Live TV Edit' : 'Live TV Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('live_tv.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>Live TV List</a>

                            @if(isset($live_tv->id))
                             
                                <form action="{{ route('live_tv.destroy', ['id' => $live_tv->id]) }}" method="post">

                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Menu record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($live_tv) && $live_tv->id ? route('live_tv.process', ['id' => $live_tv->id]) : route('live_tv.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($live_tv) && $live_tv->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Live TV Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Title" value="{{ isset($live_tv) ? $live_tv->title : old('title') }}" name="title">
                                        @error('name')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Embed Code Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Embed Code Link" value="{{ isset($live_tv) ? $live_tv->embed_code_link : old('embed_code_link') }}" name="embed_code_link">
                                        @error('embed_code_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Chat Code Link</label>
                                        <input type="text" class="form-control" placeholder="Enter Chat Code Link" value="{{ isset($live_tv) ? $live_tv->chat_code_link : old('chat_code_link') }}" name="chat_code_link">
                                        @error('chat_code_link')
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
                                        @if(isset($live_tv) && $live_tv->image)
                                            <img src="{{ asset('image/live_tv/' . $live_tv->image) }}" alt="{{ $live_tv->name }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
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
                                            <option value="active" {{ isset($live_tv) && $live_tv->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($live_tv) && $live_tv->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($live_tv) && $live_tv->id ? 'Update' : 'Add' }}
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