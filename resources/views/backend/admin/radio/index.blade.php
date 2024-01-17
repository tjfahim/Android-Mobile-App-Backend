@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mb-2">
                <div class="d-flex gap-2 my-3">
                    <h4 class="card-title">
                        Radio Manage
                     </h4>
                     <a href="{{ route('radio.create')}}" class="btn btn-primary btn-sm ml-4">Add New Radio Channel</a>
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
                <h4 class="mt-0">Radio List:</h4>
                <div class="row">
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
                            <th scope="col">Radio Title</th>
                            <th scope="col">Stream Link</th>
                            <th scope="col">Image</th>
                            <th scope="col">Total Users</th>
                            <th scope="col">Status</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($RadioRecords as $radio)
                            <tr id="radio_{{ $radio->id }}">
                                <td>
                                <!-- Edit option -->
                                <div class="d-flex gap-2">
                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('radio.edit', ['id' => $radio->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit
                                            "></i>
                                    </a>
                                    <!-- Delete option -->
                                    <form class="" action="{{ route('radio.destroy', ['id' => $radio->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Radio record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                                    </form>
                                </div>
                            </td>
                            <th scope="row"> {{ $radio->id }}</th>
                            <td>
                    {{ $radio->title }}
                            </td>
                            <td>
                                {{ $radio->radio_link }}
                            </td>
                            <th>
                                <img src="{{ asset('image/radio/' . $radio->image) }}" alt="{{ $radio->title }}" style="width: 50px; height: 50px;border-radius:25px">
                            </th>
                            <td>
                                <div style="display: inline;margin-top:30px">
                                    <span><i class="fa fa-users" aria-hidden="true"></i> {{ $radio->connected_user }}</span>
                                    <div  style="display: inline; float:right">
                                        <p style="display: inline;"><i class="fa fa-android" aria-hidden="true"></i>{{ $radio->android_listener }}</p>
                                        <p style="display: inline;"><i class="fa fa-apple" aria-hidden="true"></i>
                                            {{ $radio->ios_listener }}</p>
                                    </div>
                                </div>
                            </td>
                        
                            <td>
                                <form class="" action="{{ route('radio.status', ['id' => $radio->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    @if($radio->status =='active')
                                        <input type="hidden" value="inactive" name="status">
                                        <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{$radio->status}}
                                        </button>
                                    @endif
                                    @if($radio->status =='inactive')
                                        <input type="hidden" value="active" name="status">
                                        <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                            {{$radio->status}}
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
                    {{ $RadioRecords->links('pagination::bootstrap-4') }}
                
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