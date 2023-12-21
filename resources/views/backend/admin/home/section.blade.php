@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4>Section Manage</h4>
        <a href="{{ route('home.section.create')}}" class="btn btn-primary">Home Section Create</a>
        <a href="{{ route('home.section.event.index')}}" class="btn btn-primary">Event</a>
        <a href="{{ route('home.slider.index')}}" class="btn btn-primary">Slider</a>

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
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($homeSections as $homeSection)
                  <tr>
                    <th scope="row"> {{ $homeSection->id }}</th>
                    <td>
                         {{ $homeSection->title }}
                    </td>
                    <td>
                        <img src="{{ asset('image/home/' . $homeSection->image) }}" alt="{{ $homeSection->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                    </td>
                    <td>
                        @if($homeSection->status =='active')
                        <span class="badge badge-success">{{$homeSection->status}}</span>
                        @endif
                        @if($homeSection->status =='inactive')
                        <span class="badge badge-danger">{{$homeSection->status}}</span>
                        @endif
                    </td>
                    <td>
                      <!-- Edit option -->
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary mb-2" href="{{ route('home.section.details',['id' => $homeSection->id]) }}">Section Item Manage</a>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary" href="{{ route('home.section.edit', ['id' => $homeSection->id]) }}">Edit</a>
                          </div>
                      </div>
                      <!-- Delete option -->
                      <div class="row">
                          <div class="col">
                              <form action="{{ route('home.section.destroy', ['id' => $homeSection->id]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this Section record?')">Delete</button>
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