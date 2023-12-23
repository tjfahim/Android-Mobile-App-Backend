@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Section Manage</h4>
        <a href="{{ route('radio.section.create', ['radio_id' => $radio_id])}}" class="btn btn-primary">Radio Section Create</a>
        <a href="{{ route('radio.index')}}" class="btn btn-primary"><i class="fa fa-caret-square-o-left"></i>


            Radio List</a>

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
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($radioSection as $radioSection)
                  <tr>
                    <td style="width: 20%">
                      

                         <!-- Edit option -->
                    <div class="d-flex gap-2">

                        <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('radio.section.edit', ['radio_id' => $radio_id,'id' => $radioSection->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit	
                            "></i>
                        </a>
                        <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('radio.section.details', ['radio_id' => $radio_id,'id' => $radioSection->id]) }}" data-toggle="tooltip" data-placement="top" title="Section Manage"><i class="fa fa-info	
                            "></i>
                        </a>
                        <!-- Delete option -->
                        <form class="" action="{{ route('radio.section.destroy', ['id' => $radioSection->id]) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Section record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                        </form>
                    </div>
                    </td>
                    <th scope="row"> {{ $radioSection->id }}</th>
                    <td>
                            {{ $radioSection->title }}
                    </td>
                    <td>
                        <form class="" action="{{ route('radioSection.status', ['id' => $radioSection->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($radioSection->status =='active')
                                <input type="hidden" value="inactive" name="status">
                                <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$radioSection->status}}
                                </button>
                            @endif
                            @if($radioSection->status =='inactive')
                                <input type="hidden" value="active" name="status">
                                <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$radioSection->status}}
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