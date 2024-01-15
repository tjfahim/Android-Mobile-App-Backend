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
                     <a href="{{ route('banner_category.create')}}" class="btn btn-primary btn-sm ml-4">Add New Category</a>
                     <a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm ml-4"><i class="fa fa-caret-square-o-left"></i>
                        Section List</a>
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
        <div class="row">
            @foreach($banner_category as $bannercategory)
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-right">
                                <button class="btn btn-sm btn-secondary dropdown-toggle dropdown-btn-bg-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: none;font-size: 25px;margin-top: -6px;
                                padding-right: 18px;">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('banner_category.details', ['id' => $bannercategory->id]) }}">Banner Manage</a>
                                    <a class="dropdown-item" href="{{ route('banner_category.edit', ['id' => $bannercategory->id]) }}">Edit</a>
                                    <form action="{{ route('banner_category.destroy', ['id' => $bannercategory->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this Banner Catgory Record?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                    
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $bannercategory->title }}</h4>
                                <form class="ml-auto" action="{{ route('banner_category.status', ['id' => $bannercategory->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($bannercategory->status =='active')
                                        <input type="hidden" value="inactive" name="status">
                                        <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{ $bannercategory->status }}
                                        </button>
                                    @endif
                                    @if($bannercategory->status =='inactive')
                                        <input type="hidden" value="active" name="status">
                                        <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{ $bannercategory->status }}
                                        </button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- <div class="row p-2">
            @foreach($banner_category as $bannercategory)

            <div class="card mx-2" style="width: 18rem;background-color: rgb(161 147 151 / 10%);">
              <a href="{{ route('home.section.index')}}" class=""><img src="{{ asset('image/dashboard/pngtree-note-music-logo-watercolor-background-picture-image_1589075.jpg') }}" alt="Background Image" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; margin-bottom:10px"></a>
              
              <div class="card-body">
               <div class="row">
                <div class="col-md-9">          <h4 class="card-title">Home Section</h4>
                  <h6 class="card-subtitle mb-2 text-muted">Total Sections: </h6>
                </div>
                <div class="col-md-3"><a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm float-right card-link"><i class="fa fa-newspaper-o	
                  "></i>All Sections</a></div>
               </div>
              </div>
            </div>
            @endforeach

          </div>
         --}}
        
          {{ $banner_category->links('pagination::bootstrap-4') }}
        
    </div>
</div>
@endsection