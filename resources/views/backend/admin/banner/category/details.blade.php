@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">{{ $banner_category->title }}</h4>
                        <div class="d-flex gap-2">
                            <form action="{{ route('banner.create')}}">
                                <input type="hidden" name="banner_category_id" value="{{$banner_category->id}}">
                                <button type="submit" class="btn btn-primary btn-sm ml-2">Add Banner</button>
                            </form>
                            <a href="{{ route('banner_category.index')}}" class="btn btn-primary btn-sm ml-2">Category List</a>
                           
                        </div>
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
                <th scope="col">Banner Title</th>
                <th scope="col">Banner Link</th>
                <th scope="col">Image</th>
                <th scope="col">Status</th>
              </tr>
            </thead>
            <tbody>
                @foreach($banners as $banner)
                <tr id="banner_{{ $banner->id }}">
                    <td>
                    <!-- Edit option -->
                    <div class="d-flex gap-2">
                        <form class="mr-1" action="{{ route('banner.edit', ['id' => $banner->id]) }}">
                            <input type="hidden" name="banner_category_id" value="{{$banner_category->id}}">
                            <button type="submit" class="btn btn-sm btn-primary mb-2" data-toggle="tooltip" data-placement="top" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                        </form>
                     
                        <form class="" action="{{ route('banner.destroy', ['id' => $banner->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="banner_category_id" value="{{$banner_category->id}}">
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Banner Record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                </td>
              
                
                <th scope="row"> {{ $banner->id }}</th>
                <td>
           {{ $banner->title }}
                </td>
                <th>
           {{ $banner->banner_link }}
                </th>
               
                <th>
                    <img src="{{ asset('image/banner/' . $banner->image) }}" alt="{{ $banner->title }}" style="width: 50px; height: 50px">
                </th>
              
              
                <td>
                    <form class="" action="{{ route('banner.status', ['id' => $banner->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        @if($banner->status =='active')
                            <input type="hidden" value="inactive" name="status">
                            <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                {{$banner->status}}
                            </button>
                        @endif
                        @if($banner->status =='inactive')
                            <input type="hidden" value="active" name="status">
                            <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                {{$banner->status}}
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
        {{ $banners->links('pagination::bootstrap-4') }}
        
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