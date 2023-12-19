@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($radioSection) && $radioSection->id ? 'Section Edit' : 'Section Create' }}
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('radio.section.index',['radio_id' => $radio_id])}}" class="btn btn-primary btn-sm ml-2">Section List</a>

                            @if(isset($radioSection->id))
                               
                                <form action="{{ route('radio.section.destroy', ['id' => $radioSection->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Radio Section record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ isset($radioSection) && $radioSection->id ? route('radio.section.process', ['radio_id' => $radio_id,'id' => $radioSection->id]) : route('radio.section.process', ['radio_id' => $radio_id]) }}" enctype="multipart/form-data">
                            @csrf
                            @if(isset($radioSection) && $radioSection->id)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Section Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Section Name" value="{{ isset($radioSection) ? $radioSection->title : old('title') }}" name="title">
                                        @error('title')
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
                                            <option value="active" {{ isset($radioSection->status  === 'active') ? 'selected' : '' }}>Active</option>
                                            <option value="active" {{ isset($radioSection->status  === 'inactive') ? 'selected' : '' }}>Active</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                                {{ isset($radioSection) && $radioSection->id ? 'Update' : 'Add' }}
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