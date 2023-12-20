@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $podcastcategory->title }}</h4>
                        <div class="d-flex gap-2">
                            <form action="{{ route('podcast.create')}}">
                                <input type="hidden" name="podcast_category_id" value="{{$podcastcategory->id}}">
                                <button type="submit" class="btn btn-primary btn-sm ml-2">Add Podcast</button>
                            </form>
                            <a href="{{ route('podcastcategory.index')}}" class="btn btn-primary btn-sm ml-2">Category List</a>
                            <a href="{{ route('podcastcategory.edit', ['id' => $podcastcategory->id])}}" class="btn btn-primary btn-sm ml-2">Edit</a>
                            <form action="{{ route('podcastcategory.destroy', ['id' => $podcastcategory->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                       

                                <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Category Record?')">Delete</button>
                            </form>
                   
                        </div>
                    </div>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
      
        <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th scope="col">id</th>
                <th scope="col">Podcast Title</th>
                <th scope="col">Audio</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach($podcasts as $podcast)
              <tr style="">
                <th scope="row"> {{ $podcast->id }}</th>
                <td>
           {{ $podcast->title }}
                </td>
                <td style="width: 20%">
                    @if($podcast->audio_link)
                            <a href="{{ $podcast->audio_link }}" class="card-link my-3" style="margin-top:10px;margin-button:10px;width:50%">Link: {{ $podcast->audio_link }}</a>
                    @else
                        <a href="{{ asset('podcast/audio/' . $podcast->audio) }}" class="card-link " style="margin-top:10px;margin-button:10px">Link: {{ asset('podcast/audio/' . $podcast->audio) }}</a>
                    @endif
                    @if($podcast->audio)
                    <audio controls style="width: 100%;
                    height: 35px;">
                        <source src="{{ asset('podcast/audio/' . $podcast->audio) }}" type="audio/mpeg">
                    </audio>
                @else
                    <audio controls style="width: 100%;
                    height: 35px;">
                        <source src="{{ $podcast->audio_link }}" type="audio/mpeg">
                    </audio>
                @endif
                </td>
              
           
                <td>
                    <img src="{{ asset('podcast/image/' . $podcast->image) }}" alt="{{ $podcast->title }}" style="width: 50px; height: 50px">
                </td>
                <td>
                    @if($podcast->status =='active')
                    <span class="badge badge-success">{{$podcast->status}}</span>
                    @endif
                    @if($podcast->status =='inactive')
                    <span class="badge badge-danger">{{$podcast->status}}</span>
                    @endif
                <td>
                    <!-- Edit option -->
                    <div class="btn-group-vertical">
                    
                        <form action="{{ route('podcast.edit', ['id' => $podcast->id]) }}">
                            <input type="hidden" name="podcast_category_id" value="{{$podcastcategory->id}}">
                            <button type="submit" class="btn btn-sm btn-primary mb-2">Edit</button>
                        </form>
                        <a class="btn btn-sm btn-primary mb-2" href="{{ route('podcast.details', ['id' => $podcast->id]) }}">Details</a>
                        <!-- Delete option -->
                        <form action="{{ route('podcast.destroy', ['id' => $podcast->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="podcast_category_id" value="{{$podcastcategory->id}}">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this podcast record?')">Delete</button>
                        </form>
                    </div>
                </td>
                

                
              </tr>
              @endforeach

             
            </tbody>
            {{ $podcasts->links('pagination::bootstrap-4') }}
          </table>
        
        
                </div>
            </div>
          
        </div>
    </div>
</div>

@endsection