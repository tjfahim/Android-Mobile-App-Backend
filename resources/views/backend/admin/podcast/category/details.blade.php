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
                           
                        </div>
                    </div>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center col-12 my-3">
            <div class="col-md-6 mb-3">
                <div class="d-flex align-items-center">
                    <label for="search" class="form-label mb-0 mr-2">Search:</label>
                    <input type="text" class="form-control ms-2" id="search">
                </div>
            </div>
        </div>
        <table class="table table-hover table-sm">
            <thead>
              <tr>
                <th scope="col">Action</th>
                <th scope="col">id</th>
                <th scope="col">Podcast Title</th>
                <th scope="col">Audio</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach($podcasts as $podcast)
                <tr id="podcast_{{ $podcast->id }}">
                    <td>
                    <!-- Edit option -->
                    <div class="d-flex gap-2">
                        <form class="" action="{{ route('podcast.edit', ['id' => $podcast->id]) }}">
                            <input type="hidden" name="podcast_category_id" value="{{$podcastcategory->id}}">
                            <button type="submit" class="btn btn-sm btn-primary mb-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>
                        <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('podcast.details', ['id' => $podcast->id]) }}" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                        <!-- Delete option -->
                        <form class="" action="{{ route('podcast.destroy', ['id' => $podcast->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="podcast_category_id" value="{{$podcastcategory->id}}">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this podcast record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                </td>
              
                
                <th scope="row"> {{ $podcast->id }}</th>
                <td>
           {{ $podcast->title }}
                </td>
                <td style="width: 350px;display:block">
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
                    <form class="" action="{{ route('podcast.status', ['id' => $podcast->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if($podcast->status =='active')
                            <input type="hidden" value="inactive" name="status">
                            <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                {{$podcast->status}}
                            </button>
                        @endif
                        @if($podcast->status =='inactive')
                            <input type="hidden" value="active" name="status">
                            <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                {{$podcast->status}}
                            </button>
                        @endif
                    </form>
                </td>
                <td style="display: none">
                   
                    
                </td>
              </tr>
              @endforeach

             
            </tbody>
        </table>
        {{ $podcasts->links('pagination::bootstrap-4') }}
        
                </div>
            </div>
          
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#search').on('input', function(){
            var searchTerm = $(this).val().toLowerCase();
            filterTable(searchTerm);
        });

        function filterTable(searchTerm){
            $('tbody tr').each(function(){
                var rowText = $(this).text().toLowerCase();
                if(rowText.indexOf(searchTerm) === -1){
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        }
    });
</script>
@endsection