@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Category Manage</h4>
        <a href="{{ route('playlistcategory.create')}}" class="btn btn-primary">Add New Category</a>
        <a href="{{ route('playlist.index')}}" class="btn btn-primary"><i class="fa fa-caret-square-o-left"></i>Playlist Manage</a>
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
                    <th scope="col">Id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($playlistCatgories as $playlistCatgory)
    
                  <tr>
                  
                      <td style="width: 20%">
                    <!-- Edit option -->
                    <div class="d-flex gap-2">
                        <a class="btn btn-sm btn-primary mb-2 mx-1" href="{{ route('playlistcategory.edit', ['id' => $playlistCatgory->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                        
                        <a class="btn btn-sm btn-primary mb-2 mx-1 "  href="{{ route('playlistcategory.details', ['id' => $playlistCatgory->id]) }}" data-toggle="tooltip" data-placement="top" title="Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                        <!-- Delete option -->
                        <form class="" action="{{ route('playlistcategory.destroy', ['id' => $playlistCatgory->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Category record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                </td>
                    <th scope="row"> {{ $playlistCatgory->id }}</th>

                    <td>
               {{ $playlistCatgory->title }}
                    </td>
                   
                    <td>
                        <img src="{{ asset('image/playlist/' . $playlistCatgory->image) }}" alt="{{ $playlistCatgory->title }}" style="width: 50px; height: 50px">
                    </td>
                    <td>
                        <form class="" action="{{ route('playlistcategory.status', ['id' => $playlistCatgory->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($playlistCatgory->status =='active')
                                <input type="hidden" value="inactive" name="status">
                                <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$playlistCatgory->status}}
                                </button>
                            @endif
                            @if($playlistCatgory->status =='inactive')
                                <input type="hidden" value="active" name="status">
                                <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$playlistCatgory->status}}
                                </button>
                            @endif
                        </form>
                    </td>

                    
                  
                  </tr>
                  @endforeach
    
                 
                </tbody>
            </table>
            {{ $playlistCatgories->links('pagination::bootstrap-4') }}
         
        </div>
                
    </div>
</div>
@endsection