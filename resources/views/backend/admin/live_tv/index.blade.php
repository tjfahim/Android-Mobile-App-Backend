@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
       
        <div class="card">
            <div class="card-header mb-2">
             
                <div class="d-flex gap-2 my-3">
                    <h4 class="card-title">
                        Live TV Manage
                     </h4>
                     <a href="{{ route('live_tv.create') }}" class="btn btn-primary btn-sm ml-4 ">Live TV Create </a>
                    
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="mt-0">Live TV List:</h4>

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
                                <th scope="col">Live TV Link</th>
                                <th scope="col">Chat Link</th>
                                <th scope="col">Image</th>
                                <th scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($live_tvs as $live_tv)
                                <tr id="bar_{{ $live_tv->id }}">
                                    <td style="width:20%">
                                    <div class="d-flex gap-2">
                                        <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('live_tv.edit', ['id' => $live_tv->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit	
                                            "></i>
                                        </a>
                                        <form class="" action="{{ route('live_tv.destroy', ['id' => $live_tv->id]) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Live Tv Bar Item record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                                        </form>
                                    </div>
                                </td>
                                <th scope="row"> {{ $live_tv->id }}</th>
                                <td>
                                    {{ $live_tv->title }}
                                </td>
                                <td style="width: 25%">
                                    {{ $live_tv->embed_code_link }}
                                </td>
                                <td style="width: 25%">
                                    {{ $live_tv->chat_code_link }}
                                </td>
                                <td>
                                    <img src="{{ asset('image/live_tv/' . $live_tv->image) }}" alt="{{ $live_tv->name }}" id="imagePreview" style="width: 50px; height: 58px;">
                                </td>
                                <td>
                                    <form class="" action="{{ route('live_tv.status', ['id' => $live_tv->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        @if($live_tv->status =='active')
                                            <input type="hidden" value="inactive" name="status">
                                            <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                                {{$live_tv->status}}
                                            </button>
                                        @endif
                                        @if($live_tv->status =='inactive')
                                            <input type="hidden" value="active" name="status">
                                            <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                                {{$live_tv->status}}
                                            </button>
                                        @endif
                                    </form>
                                </td>
                                <td>
                                   
                                </td>
                                
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $live_tvs->links('pagination::bootstrap-4') }}
    
                    </div>
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