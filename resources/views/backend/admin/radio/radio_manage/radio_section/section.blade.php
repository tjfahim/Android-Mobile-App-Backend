@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Section Manage</h4>
        <a href="{{ route('radio.section.create', ['radio_id' => $radio_id])}}" class="btn btn-primary">Radio Section Create</a>
        <a href="{{ route('radio.index')}}" class="btn btn-primary">Radio List</a>

        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <table class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($radioSection as $radioSection)
                  <tr>
                    <th scope="row"> {{ $radioSection->id }}</th>
                    <td>
                            {{ $radioSection->title }}
                    </td>
                    <td>
                        @if($radioSection->status =='active')
                        <span class="badge badge-success">{{$radioSection->status}}</span>
                        @endif
                        @if($radioSection->status =='inactive')
                        <span class="badge badge-danger">{{$radioSection->status}}</span>
                        @endif
                    </td>
                    <td>
                      <!-- Edit option -->
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary mb-2" href="{{ route('radio.section.details', ['radio_id' => $radio_id,'id' => $radioSection->id]) }}">Section Item Manage</a>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col">
                              <a class="btn btn-sm btn-primary" href="{{ route('radio.section.edit', ['radio_id' => $radio_id,'id' => $radioSection->id]) }}">Edit</a>
                          </div>
                      </div>
                      <!-- Delete option -->
                      <div class="row">
                          <div class="col">
                              <form action="{{ route('radio.section.destroy', ['id' => $radioSection->id]) }}" method="post">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger mt-2" onclick="return confirm('Are you sure you want to delete this Section record?')">Delete</button>
                              </form>
                          </div>
                      </div>
                  </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
    </div>
</div>
@endsection