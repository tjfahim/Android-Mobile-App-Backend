@extends('backend.layouts.main')

@section('main_content')
<div class="content">

    <div class="container-fluid">
        <div class="card">
            <div class="card-header mb-2">
                <div class="d-flex gap-2 my-3">
                    <h4 class="card-title">
                        Category Manage
                     </h4>
                     <a href="{{ route('playlistcategory.create')}}" class="btn btn-primary btn-sm ml-4 ">Add New Category</a>
                    <a href="{{ route('playlist.index')}}" class="btn btn-primary btn-sm ml-4 "><i class="fa fa-caret-square-o-left"></i> Playlist Manage</a>
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
                    <div class="row justify-content-center col-12 my-3">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <label for="search" class="form-label mb-0 mr-2">Search:</label>
                                <input type="text" class="form-control ms-2" id="search">
                            </div>
                        </div>
                    </div>
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
            
                            <tr id="playlistCatgory_{{ $playlistCatgory->id }}">
                          
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