@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mb-2">
                <div class="d-flex gap-2 my-3">
                    <h4 class="card-title">
                        Section Manage
                     </h4>
                     <a href="{{ route('home.section.create')}}" class="btn btn-primary  btn-sm ml-4">Home Section Create</a>
                     <a href="{{ route('home.section.event.index')}}" class="btn btn-primary  btn-sm ml-4">Event</a>
                     <a href="{{ route('home.slider.index')}}" class="btn btn-primary  btn-sm ml-4">Slider</a>
             
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
                            <th scope="col">id</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($homeSections as $homeSection)
                            <tr id="homeSection_{{ $homeSection->id }}">
                          
                            
                            <td style="width:20%">
                                <!-- Edit option -->
                                <div class="d-flex gap-2">
                             
                                   
                                    <a class="btn btn-sm btn-primary mb-2 " href="{{ route('home.section.edit', ['id' => $homeSection->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit	
                                        "></i>
                                    </a>
                                     <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('home.section.details',['id' => $homeSection->id]) }}" data-toggle="tooltip" data-placement="top" title="Section Manage"><i class="fa fa-info	
                                        "></i>
                                    </a>
                                    <!-- Delete option -->
                                    <form class="" action="{{ route('home.section.destroy', ['id' => $homeSection->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Section record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                                    </form>
                                </div>
                            </td>
        
                            <th scope="row"> {{ $homeSection->id }}</th>
                            <td>
                                 {{ $homeSection->title }}
                            </td>
                            <td>
                                <img src="{{ asset('image/home/' . $homeSection->image) }}" alt="{{ $homeSection->title }}" id="imagePreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                            </td>
                            <td>
                                <form class="" action="{{ route('homesection.status', ['id' => $homeSection->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($homeSection->status =='active')
                                        <input type="hidden" value="inactive" name="status">
                                        <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{$homeSection->status}}
                                        </button>
                                    @endif
                                    @if($homeSection->status =='inactive')
                                        <input type="hidden" value="active" name="status">
                                        <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{$homeSection->status}}
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