@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Radio Manage</h4>
        <a href="{{ route('radio.create')}}" class="btn btn-primary">Add New Radio Channel</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach($RadioRecords as $radio)
                <div class="col-md-4 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="dropdown float-right">
                                <button class="btn btn-sm btn-secondary dropdown-toggle dropdown-btn-bg-none " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="border: none;font-size: 25px;margin-top: -6px;
                                padding-right: 18px;">
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('radio.section.index', ['radio_id' => $radio->id]) }}">Manage</a>
                                    <a class="dropdown-item" href="{{ route('radio.edit', ['id' => $radio->id]) }}">Edit</a>
                                  
                                    <form action="{{ route('radio.destroy', ['id' => $radio->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to delete this radio record?')">Delete</button>
                                    </form>
                                </div>
                            </div>
                    
                            <!-- Card Content -->
        
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">{{ $radio->title }}</h4>
                                <form class="ml-auto" action="{{ route('radio.status', ['id' => $radio->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($radio->status =='active')
                                        <input type="hidden" value="inactive" name="status">
                                        <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{ $radio->status }}
                                        </button>
                                    @endif
                                    @if($radio->status =='inactive')
                                        <input type="hidden" value="active" name="status">
                                        <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{ $radio->status }}
                                        </button>
                                    @endif
                                </form>
                            </div>
                            <p class="card-text">{{ $radio->subtitle }}</p>
                            <p class="card-text">
                                
                            </p>
                            <img src="{{ asset('image/radio/' . $radio->image) }}" alt="{{ $radio->title }}" style="width: 100%;height:200px;object-fit: cover;overfollow:hidden; ">
                    
                            @if($radio->radio_link)
                                <a href="{{ $radio->radio_link }}" class="card-link my-3" style="margin-top:10px;margin-button:10px">Link: {{ $radio->radio_link }}</a>
                            @else
                                <a href="{{ asset('radio_file/' . $radio->radio_file) }}" class="card-link " style="margin-top:10px;margin-button:10px">Link: {{ asset('radio_file/' . $radio->radio_file) }}</a>
                            @endif
                    
                            @if($radio->radio_file)
                                <audio controls style="width: 100%;">
                                    <source src="{{ asset('radio_file/' . $radio->radio_file) }}" type="audio/mpeg">
                                </audio>
                            @else
                                <audio controls style="width: 100%;">
                                    <source src="{{ $radio->radio_link }}" type="audio/mpeg">
                                </audio>
                            @endif
                        </div>
                    </div>
                    
                    
                </div>
            @endforeach
        </div>
        
        {{ $RadioRecords->links('pagination::bootstrap-4') }}
        
    </div>
</div>
@endsection