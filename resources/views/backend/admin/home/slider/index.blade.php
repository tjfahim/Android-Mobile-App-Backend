@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4>Slider Manage</h4>
        <a href="{{ route('home.slider.create')}}" class="btn btn-primary">Slider Create</a>

        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Link</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($sliders as $slider)
                  <tr>
                    <th scope="row"> {{ $slider->id }}</th>
                    <td>
                         {{ $slider->title }}
                    </td>
                    <td>
                         {{ $slider->slider_link }}
                    </td>
                    <td>
                        <img src="{{ asset('image/slider/' . $slider->image) }}" alt="{{ $slider->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                    </td>
                    <td>
                        @if($slider->status =='active')
                        <span class="badge badge-success">{{$slider->status}}</span>
                        @endif
                        @if($slider->status =='inactive')
                        <span class="badge badge-danger">{{$slider->status}}</span>
                        @endif  
                    </td>
                    <td>
                     
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary" href="{{ route('home.slider.edit', ['id' => $slider->id]) }}">Edit</a>
                          </div>
                      </div>
                      <!-- Delete option -->
                      <div class="row">
                          <div class="col">
                              <form action="{{ route('home.slider.destroy', ['id' => $slider->id]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this Slider record?')">Delete</button>
                              </form>
                          </div>
                      </div>
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection