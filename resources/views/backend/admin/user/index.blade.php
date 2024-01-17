@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mb-2">
                <div class="d-flex gap-2 my-3">
                    <h4 class="card-title">
                        User Manage
                     </h4>
                     <a href="{{ route('user.create')}}" class="btn btn-primary btn-sm ml-4">User Create</a>

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
                <h4 class="mt-0">User List:</h4>
                <div class="row">
                    <div class="row justify-content-center col-12">
                        <div class="col-md-6 mb-3">
                            <div class="d-flex align-items-center">
                                <label for="search" class="form-label mb-0 mr-2">Search: </label>
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
                            <th scope="col">Email</th>
                            <th scope="col">Device</th>
                            <th scope="col">Role</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr id="user_{{ $user->id }}">
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
                                @if($user->user_type =='android')
                                <i class="fa fa-android" aria-hidden="true"></i>
                                @elseif($user->user_type =='apple')
                                    <i class="fa fa-apple" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td>
                                @if($user->role =='user')
                                        <span class="badge badge-primary">User</span>
                                    @endif
                                    @if($user->role =='admin')
                                        <span class="badge badge-secondary">Admin</span>
        
                                    @endif
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