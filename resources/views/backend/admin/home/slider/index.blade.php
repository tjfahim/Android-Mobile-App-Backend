@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4>Slider Manage</h4>
        <a href="{{ route('home.slider.create')}}" class="btn btn-primary">Slider Create</a>
        <a href="{{ route('home.section.index')}}" class="btn btn-primary"><i class="fa fa-caret-square-o-left"></i>
            Section List</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Type</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                  <tr>
                    <td style="width:20%">


                        <div class="d-flex gap-2">
                        
                            <form class="" action="{{ route('home.slider.destroy', ['id' => $slider->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Slider record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </td>
                    <th scope="row"> {{ $slider->id }}</th>
                    <td>
                         {{ $slider->title }}
                    </td>
                    <td>
                         {{ $slider->type }}
                    </td>
                    <td>
                        <img src="{{ asset('image/slider/' . $slider->image) }}" alt="{{ $slider->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                    </td>
                    <td>
                        <form class="" action="{{ route('slider.status', ['id' => $slider->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($slider->status =='active')
                                <input type="hidden" value="inactive" name="status">
                                <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$slider->status}}
                                </button>
                            @endif
                            @if($slider->status =='inactive')
                                <input type="hidden" value="active" name="status">
                                <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$slider->status}}
                                </button>
                            @endif
                        </form>
                    </td>
                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection