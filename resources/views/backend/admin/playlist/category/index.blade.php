@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Category Manage</h4>
        <a href="{{ route('playlistcategory.create')}}" class="btn btn-primary">Add New Category</a>
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
                    <th scope="col">title</th>
                    <th scope="col">image</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($playlistCatgories as $playlistCatgory)
    
                  <tr>
                    <th scope="row"> {{ $playlistCatgory->id }}</th>
                    <td>
               {{ $playlistCatgory->title }}</small> 
                    </td>
                   
                    <td>
                        <img src="{{ asset('image/' . $playlistCatgory->image) }}" alt="{{ $playlistCatgory->title }}" style="width: 50px; height: 50px">
                    </td>
                    <td>
                      <!-- Edit option -->
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary" href="{{ route('playlistcategory.edit', ['id' => $playlistCatgory->id]) }}">Edit</a>
                          </div>
                      </div>
                  
                      <!-- Details option -->
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary mt-2" href="{{ route('playlistcategory.details', ['id' => $playlistCatgory->id]) }}">Details</a>
                          </div>
                      </div>
                  
                      <!-- Delete option -->
                      <div class="row">
                          <div class="col">
                              <form action="{{ route('playlistcategory.destroy', ['id' => $playlistCatgory->id]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this Category record?')">Delete</button>
                              </form>
                          </div>
                      </div>
                  </td>
                  
                  </tr>
                  @endforeach
    
                 
                </tbody>
                {{ $playlistCatgories->links('pagination::bootstrap-4') }}
              </table>
         
        </div>
                
    </div>
</div>
@endsection