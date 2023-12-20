@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4>Event Manage</h4>
        <a href="{{ route('home.section.event.create')}}" class="btn btn-primary">Event Create</a>

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
                    @foreach($events as $event)
                  <tr>
                    <th scope="row"> {{ $event->id }}</th>
                    <td>
                         {{ $event->title }}
                    </td>
                    <td>
                        <img src="{{ asset('image/event/' . $event->image) }}" alt="{{ $event->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                    </td>
                    <td>
                        @if($event->status =='active')
                        <span class="badge badge-success">{{$event->status}}</span>
                        @endif
                        @if($event->status =='inactive')
                        <span class="badge badge-danger">{{$event->status}}</span>
                        @endif  
                    </td>
                    <td>
                     
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary" href="{{ route('home.section.event.edit', ['id' => $event->id]) }}">Edit</a>
                          </div>
                      </div>
                      <!-- Delete option -->
                      <div class="row">
                          <div class="col">
                              <form action="{{ route('home.section.event.destroy', ['id' => $event->id]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this Event record?')">Delete</button>
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