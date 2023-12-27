@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($reel) && $reel->id ? 'Reel Edit' : 'Reel Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('reel.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>Reel List</a>

                            @if(isset($reel->id))
                                <form action="{{ route('reel.destroy', ['id' => $reel->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Reel record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($reel) && $reel->id ? route('reel.process', ['id' => $reel->id]) : route('reel.process') }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($reel) && $reel->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Reel Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Title" value="{{ isset($reel) ? $reel->title : old('title') }}" name="title">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Reel Sub Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Sub Title" value="{{ isset($reel) ? $reel->subtitle : old('subtitle') }}" name="subtitle">
                                        @error('subtitle')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Reel Link</label>
                                        <input type="text" class="form-control" placeholder="Enter video_link" value="{{ isset($reel) ? $reel->video_link : old('video_link') }}" name="video_link">
                                        @error('video_link')
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
                                            <option value="active" {{ isset($reel) && $reel->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ isset($reel) && $reel->status === 'inactive' ? 'selected' : '' }}>Inactive</option>

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($reel) && $reel->id ? 'Update' : 'Add' }}
                            </button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>





@endsection