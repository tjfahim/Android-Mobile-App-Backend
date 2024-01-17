@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">
                            {{ isset($homeSection) ? $homeSection->title : old('title') }} - Manage
                        </h4>
                        <div class="d-flex gap-2">
                            <a href="{{ route('home.section.index')}}" class="btn btn-primary btn-sm ml-2"><i class="fa fa-caret-square-o-left"></i>
                                Section List</a>

                            @if(isset($homeSection->id))
                               
                                <form action="{{ route('home.section.destroy', ['id' => $homeSection->id]) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger ml-2" onclick="return confirm('Are you sure you want to delete this Home Section record?')">Delete</button>
                                </form>
                            
                          @endif
                        </div>
                    </div>

                    <div class="card-body">
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

                        <form method="POST" action="{{ route('home.section.item.create',['home_section_id' => $home_section_id]) }}" class="mt-3">
                            @csrf
                            <input type="hidden" name="home_section_id" value="{{ $home_section_id }}">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div>Choose Type:</div>
                                
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="homePodcast" value="podcast">
                                        <label class="ml-2" for="homePodcast">Podcast</label>
                                    </div>
                                  
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="homeVideo" value="video">
                                        <label class="ml-2" for="homeVideo">Video</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="mt-3 " type="radio" name="content_type" id="homeRadio" value="event">
                                        <label class="ml-2" for="homeRadio">Radio</label>
                                    </div>
                                </div>
                                
                                <div class="podcast-section" style="display: none;">
                                    <div class=" mt-2">
                                        <div class="form-group">
                                            <label for="podcast">Podcast</label>
                                            <select name="podcast_id" id="podcast_id" class="form-control">
                                                <option value="">Select Podcast</option>

                                                @foreach ($podcasts as $podcast)
                                                    <option value="{{ $podcast->id }}">{{ $podcast->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="radio-section" style="display: none;">
                                    <div class=" mt-2">
                                        <div class="form-group">
                                            <label for="radio">Radio</label>
                                            <select name="radio_id" id="radio_id" class="form-control">
                                                <option value="">Select Radio</option>

                                                @foreach ($radios as $radio)
                                                    <option value="{{ $radio->id }}">{{ $radio->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="video-section" style="display: none;">
                                    <div class=" mt-2">
                                        <div class="form-group">
                                            <label for="video">Video</label>
                                            <select name="video_id" id="video_id" class="form-control">
                                                <option value="">Select Video</option>

                                                @foreach ($videos as $video)
                                                    <option value="{{ $video->id }}">{{ $video->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="">&nbsp;</label> 
                                        <button type="submit" class="btn btn-primary btn-block">Add Item</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Action</th>
                                    <th scope="col">Id</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Image</th>
                                </tr>
                                
                            </thead>
                            <tbody>
                                @forelse($sectionItems as $sectionItem)
                                    <tr>
                                        <td style="width:20%">
                                            <div class="d-flex gap-2">
                                            @if(isset($sectionItem->podcast_id))
                                                
                                            <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('podcast.details',['id' => $sectionItem->podcast->id])}}" data-toggle="tooltip" data-placement="top" title="Podcast Details"><i class="fa fa-info-circle	
                                                "></i>
                                            </a>
                                                                
                                           
                                            @elseif(isset($sectionItem->video_id))
                                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('video.edit',['id' => $sectionItem->video->id])}}" data-toggle="tooltip" data-placement="top" title="Video Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                                            @elseif(isset($sectionItem->radio_id))
                                                    <a class="btn btn-sm btn-primary mb-2 mx-1 " href="{{ route('radio.edit',['id' => $sectionItem->radio->id])}}" data-toggle="tooltip" data-placement="top" title="Radio Details"><i class="fa fa-info-circle	
                            "></i>
                        </a>
                                            
                                    @endif
                                     
                                            <form class="" action="{{ route('home.section.item.destroy', ['id' => $sectionItem->id]) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this Section Item record?')" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-close"></i></button>
                                            </form>
                                            </div>
                                        </td>
                                        <td>
                                               {{ $sectionItem->id }}
                                        </td>
                                        <td>
                                                @if(isset($sectionItem->podcast_id))
                                                    <a href="{{ route('podcast.details',['id' => $sectionItem->podcast->id])}}" class="">
                                                        {{ $sectionItem->podcast->title }}
                                                    </a>

                                                @elseif(isset($sectionItem->video_id))
                                                    <a href="{{ route('video.edit',['id' => $sectionItem->video->id])}}" class="">
                                                        {{ $sectionItem->video->title }}
                                                    </a>

                                                @elseif(isset($sectionItem->radio_id))
                                                    <a href="{{ route('radio.edit',['id' => $sectionItem->radio->id])}}" class="">
                                                        {{ $sectionItem->radio->title }}
                                                    </a>
                                                    
                                                @endif
                                        </td>
                                        <td>

                                                @if(isset($sectionItem->podcast_id))
                                                <span class="badge badge-primary">Podcast</span>
            
                                                @elseif(isset($sectionItem->video_id))
                                                <span class="badge badge-warning">Video</span>

                                                @elseif(isset($sectionItem->radio_id))
                                                <span class="badge badge-primary">Radio</span>

                                                @endif
                                        </td>
                                   
                                        <td>
                                            @if(isset($sectionItem->podcast_id))
                                            <a href="{{ route('podcast.details',['id' => $sectionItem->podcast->id])}}" class="">
                                                <img src="{{ asset('podcast/image/' . $sectionItem->podcast->image) }}" alt="{{ $sectionItem->podcast->title }}" style="width: 50px; height: 57px">
                                              </a>
                                            @elseif(isset($sectionItem->video_id))
                                            <a href="{{ route('video.edit',['id' => $sectionItem->video->id])}}" class="">
                                                <img src="{{ asset('image/video/' . $sectionItem->video->image) }}" alt="{{ $sectionItem->video->title }}" style="width: 50px; height: 57px">
                                              </a>
                                            @elseif(isset($sectionItem->radio_id))
                                            <a href="{{ route('radio.edit',['id' => $sectionItem->radio->id])}}" class="">
                                                <img src="{{ asset('image/radio/' . $sectionItem->radio->image) }}" alt="{{ $sectionItem->radio->title }}" style="width: 50px; height: 57px">
                                              </a>

                                             @endif

                                        </td>
                                      
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="12">No data available</td>
                                    </tr>
                                @endforelse                            
                            </tbody>
                
                        </table>
                    </div>
                </div>
            </div>

          
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const homeVideo = document.getElementById('homeVideo');
    const homePodcast = document.getElementById('homePodcast');
    const homeRadio = document.getElementById('homeRadio');

    const podcastSection = document.querySelector('.podcast-section');
    const videoSection = document.querySelector('.video-section');
    const radioSection = document.querySelector('.radio-section');


    homePodcast.addEventListener('change', function () {
        podcastSection.style.display = this.checked ? 'block' : 'none';
        videoSection.style.display = 'none';
                radioSection.style.display = 'none';

    });

    homeVideo.addEventListener('change', function () {
        podcastSection.style.display = 'none';
        videoSection.style.display = this.checked ? 'block' : 'none';
        radioSection.style.display = 'none';

    });
    homeRadio.addEventListener('change', function () {
        podcastSection.style.display = 'none';
        videoSection.style.display = 'none';
        radioSection.style.display = this.checked ? 'block' : 'none';
    });
});
</script>
@endsection