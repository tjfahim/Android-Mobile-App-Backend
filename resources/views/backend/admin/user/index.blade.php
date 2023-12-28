@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4>User Manage</h4>
        <a href="{{ route('user.create')}}" class="btn btn-primary">User Create</a>
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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Status</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                  <tr>
                    <td style="width:20%">
                        <div class="d-flex gap-2">
                            <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('user.edit', ['id' => $user->id]) }}" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit	
                                "></i>
                            </a>
                            <form class="" action="{{ route('user.destroy', ['id' => $user->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this User record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                    </td>
                    <th scope="row"> {{ $user->id }}</th>
                    <td>
                         {{ $user->name }}
                    </td>
                    <td>
                         {{ $user->email }}
                    </td>
                    <td>
                         {{ $user->role }}
                    </td>
                    <td>
                        <form class="" action="{{ route('user.status', ['id' => $user->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            @if($user->status =='active')
                                <input type="hidden" value="inactive" name="status">
                                <button type="submit" class="badge badge-success" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$user->status}}
                                </button>
                            @endif
                            @if($user->status =='inactive')
                                <input type="hidden" value="active" name="status">
                                <button type="submit" class="badge badge-danger" data-toggle="tooltip" data-placement="top" title="Change Status">
                                    {{$user->status}}
                                </button>
                            @endif
                        </form>
                    </td>
                    
                  </tr>
                  @endforeach
                </tbody>
                
            </table>
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection