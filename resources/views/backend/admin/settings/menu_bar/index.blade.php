@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4>Menu Manage</h4>
        <a href="{{ route('menu.bar.create')}}" class="btn btn-primary">Menu Create</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
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
                    <th scope="col">Name</th>
                    <th scope="col">Link</th>
                    <th scope="col">Image</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($bars as $bar)
                    <tr id="bar_{{ $bar->id }}">
                        <td style="width:20%">


                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('menu.bar.edit', ['id' => $bar->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit	
                                "></i>
                            </a>
                            <form class="" action="{{ route('menu.bar.destroy', ['id' => $bar->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Menu Bar Item record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </td>
                    <th scope="row"> {{ $bar->id }}</th>
                    <td>
                         {{ $bar->name }}
                    </td>
                    <td>
                         {{ $bar->link }}
                    </td>
                    <td>
                        <img src="{{ asset('image/menu_bar/' . $bar->image) }}" alt="{{ $bar->name }}" id="imagePreview" style="max-width: 60px; max-height: 60px; margin-top: 10px;">
                    </td>
                    <td>
                        <form class="" action="{{ route('menu.bar.status', ['id' => $bar->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($bar->status =='active')
                                <input type="hidden" value="inactive" name="status">
                                <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$bar->status}}
                                </button>
                            @endif
                            @if($bar->status =='inactive')
                                <input type="hidden" value="active" name="status">
                                <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$bar->status}}
                                </button>
                            @endif
                        </form>
                    </td>
                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $bars->links('pagination::bootstrap-4') }}

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