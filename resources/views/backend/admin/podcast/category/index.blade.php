@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Category Manage</h4>
        <a href="{{ route('podcastcategory.create')}}" class="btn btn-primary">Add New Category</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach($podcastCatgories as $podcastCatgory)
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-right">
                                <button class="btn btn-sm btn-secondary dropdown-toggle dropdown-btn-bg-none" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: none;font-size: 25px;    margin-top: -6px;
                                padding-right: 18px;">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                   
                                    <a class="dropdown-item" href="{{ route('podcastcategory.details', ['id' => $podcastCatgory->id]) }}">Manage</a>
                                    <a class="dropdown-item" href="{{ route('podcastcategory.edit', ['id' => $podcastCatgory->id]) }}">Edit</a>
                                    <form action="{{ route('podcastcategory.destroy', ['id' => $podcastCatgory->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this podcastCatgory record?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                    
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $podcastCatgory->title }}</h4>
                                <form class="ml-auto" action="{{ route('podcastcategory.status', ['id' => $podcastCatgory->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($podcastCatgory->status =='active')
                                        <input type="hidden" value="inactive" name="status">
                                        <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{ $podcastCatgory->status }}
                                        </button>
                                    @endif
                                    @if($podcastCatgory->status =='inactive')
                                        <input type="hidden" value="active" name="status">
                                        <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{ $podcastCatgory->status }}
                                        </button>
                                    @endif
                                </form>
                            </div>
                            
                            <a href="{{ route('podcastcategory.details', ['id' => $podcastCatgory->id]) }}"><img src="{{ asset('podcast/image/' . $podcastCatgory->image) }}" alt="{{ $podcastCatgory->title }}" style="width: 100%; height: 177px; object-fit:cover;overflow:hidden;"></a>

                            
                        </div>
                    </div>
                    
                    
                </div>
            @endforeach
        </div>
        
        {{ $podcastCatgories->links('pagination::bootstrap-4') }}
        
    </div>
</div>
@endsection