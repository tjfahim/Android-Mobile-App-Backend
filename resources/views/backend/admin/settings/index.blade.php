@extends('backend.layouts.main')

@section('main_content')

<div class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header mb-2">
             
                <div class="d-flex gap-2 my-3">
                    <h4 class="card-title">
                        Menu Bar Manage
                     </h4>
                     <a href="{{ route('menu_bar.index') }}" class="btn btn-primary btn-sm ml-4 ">Menu Bar </a>
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
                    <div class="card-header">
                            <h4 class="card-title">
                                Settings
                             </h4>
                             
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.process') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>App Title</label>
                                        <input type="text" class="form-control" placeholder="Enter Music Name" value="{{ isset($setting) ? $setting->title : old('title') }}" name="title">
                                        @error('title')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>logo</label>
                                        <input type="file" class="form-control" name="logo" id="logoInput" onchange="previewLogo()">
                                        @if(isset($setting) && $setting->logo)
                                            <img src="{{ asset('image/setting/' . $setting->logo) }}" alt="{{ $setting->title }}" id="logoPreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="logoPreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('logo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Favicon</label>
                                        <input type="file" class="form-control" name="favicon" id="faviconInput" onchange="previewfavicon()">
                                        @if(isset($setting) && $setting->favicon)
                                            <img src="{{ asset('image/setting/' . $setting->favicon) }}" alt="{{ $setting->title }}" id="faviconPreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="faviconPreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('favicon')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>App Topber Logo</label>
                                        <input type="file" class="form-control" name="app_topber_logo" id="app_topber_logoInput" onchange="previewapp_topber_logo()">
                                        @if(isset($setting) && $setting->app_topber_logo)
                                            <img src="{{ asset('image/setting/' . $setting->app_topber_logo) }}" alt="{{ $setting->title }}" id="app_topber_logoPreview" style="max-width: 100px; max-height: 100px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="app_topber_logoPreview" style="max-width: 100px; max-height: 100px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('app_topber_logo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>App Store Share Link</label>
                                        <input type="text" class="form-control" placeholder="App Link" value="{{ isset($setting) ? $setting->appstore_share_link : old('appstore_share_link') }}" name="appstore_share_link">
                                        @error('appstore_share_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Play Store Share Link</label>
                                        <input type="text" class="form-control" placeholder="App Link" value="{{ isset($setting) ? $setting->playstore_share_link : old('playstore_share_link') }}" name="playstore_share_link">
                                        @error('playstore_share_link')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info btn-fill">
                               Update
                            </button>
                            <div class="clearfix"></div>
                        </form>
                        
                    </div>
                </div>
            </div>
          
        </div>
    </div>
</div>
<script>
    function previewLogo() {
        var input = document.getElementById('logoInput');
        var preview = document.getElementById('logoPreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    function previewfavicon() {
        var input = document.getElementById('faviconInput');
        var preview = document.getElementById('faviconPreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function previewapp_topber_logo() {
        var input = document.getElementById('app_topber_logoInput');
        var preview = document.getElementById('app_topber_logoPreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection