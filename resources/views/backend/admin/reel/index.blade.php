@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4>Reel Manage</h4>
        <a href="{{ route('reel.create')}}" class="btn btn-primary">Reel Create</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">Action</th>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">SubTitle</th>
                    <th scope="col">Link</th>
                    <th scope="col">Fovorite</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($reels as $reel)
                  <tr>
                    <td style="width:20%">
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('reel.edit', ['id' => $reel->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit	
                                "></i>
                            </a>
                            <form class="" action="{{ route('reel.destroy', ['id' => $reel->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Reel record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </td>
                    <th scope="row"> {{ $reel->id }}</th>
                    <td>
                         {{ $reel->title }}
                    </td>
                    <td>
                         {{ $reel->subtitle }}
                    </td>
                    <td>
                         {{ $reel->video_link }}
                    </td>
                    <td>
                         {{ $reel->favourite }}
                    </td>
                  
                    <td>
                        <form class="" action="{{ route('reel.status', ['id' => $reel->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($reel->status =='active')
                                <input type="hidden" value="inactive" name="status">
                                <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$reel->status}}
                                </button>
                            @endif
                            @if($reel->status =='inactive')
                                <input type="hidden" value="active" name="status">
                                <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$reel->status}}
                                </button>
                            @endif
                        </form>
                    </td>
                    
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection