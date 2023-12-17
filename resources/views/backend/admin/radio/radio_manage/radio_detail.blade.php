@extends('backend.layouts.main')

@section('main_content')
<div class="content">
    <div class="container-fluid">
        <h4 >Radio Manage</h4>
        <a href="{{ route('radio.section.create', ['radio_id' => $radio_id])}}" class="btn btn-primary">Radio Section Create</a>
        <a href="" class="btn btn-primary">Music Manage</a>
        @if(session('success'))
            <div class="alert alert-success mt-2">
                {{ session('success') }}
            </div>
        @endif
        
        <h4 class="my-3">Play-List</h4>
        
    </div>
</div>
@endsection