@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                 

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Category Details Page</h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('playlistcategory.index')}}" class="btn btn-primary btn-sm ml-2">Music List</a>
                            <a href="{{ route('playlistcategory.edit', ['id' => $playlistcategory->id])}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <form action="{{ route('playlistcategory.destroy', ['id' => $playlistcategory->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Category record?')">Delete</button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Title: </label><br>
                                        {{ isset($playlistcategory) ? $playlistcategory->title : old('title') }}
                                       
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image: </label><br>
                                      
                                        @if(isset($playlistcategory) && $playlistcategory->image)
                                            <img src="{{ asset('image/' . $playlistcategory->image) }}" alt="{{ $playlistcategory->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
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