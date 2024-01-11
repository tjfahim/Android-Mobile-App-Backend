@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">

        <div class="card">
            <div class="card-header mb-2">
                <div class="d-flex gap-2 my-3">
                    <h4 class="card-title">
                        Event Manage
                     </h4>
                     <a href="{{ route('home.section.event.create')}}" class="btn btn-primary btn-sm ml-4">Event Create</a>
        <a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm ml-4"><i class="fa fa-caret-square-o-left"></i>Section List</a>

                    </div>
                    @if(session('error'))
                    <div class="alert alert-danger mt-2">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success mt-2">
                        {{ session('success') }}
                    </div>
                @endif
             </div>
        </div>
        <div class="card">
            <div class="card-body mb-2">
                <div class="row">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th scope="col">Action</th>
                            <th scope="col">id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                          <tr>
                           
                            <td style="width:20%">
                                <div class="d-flex gap-2">
                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('home.section.event.edit', ['id' => $event->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit	
                                        "></i>
                                    </a>
                                    <!-- Delete option -->
                                    <form class="" action="{{ route('home.section.event.destroy', ['id' => $event->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Event record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                                    </form>
                                </div>
                            </td>
                            <th scope="row"> {{ $event->id }}</th>
                            <td>
                                 {{ $event->title }}
                            </td>
                            <td>
                                <img src="{{ asset('image/event/' . $event->image) }}" alt="{{ $event->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                            </td>
                            <td>
                                <form class="" action="{{ route('event.status', ['id' => $event->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($event->status =='active')
                                        <input type="hidden" value="inactive" name="status">
                                        <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{$event->status}}
                                        </button>
                                    @endif
                                    @if($event->status =='inactive')
                                        <input type="hidden" value="active" name="status">
                                        <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{$event->status}}
                                        </button>
                                    @endif
                                </form>
        
                            </td>
                            <td></td>
                            
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
             </div>
        </div>

    </div>
</div>
@endsection