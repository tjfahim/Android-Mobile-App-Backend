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
                                        <label>Logo </label><small class="text-small text-danger"> (* Preferred Logo 500*500 Circle and PNG)</small>

                                        <input type="file" class="form-control" name="logo" id="logoInput" onchange="previewLogo()">
                                        @if(isset($setting) && $setting->logo)
                                            <img src="{{ asset('image/setting/' . $setting->logo) }}" alt="{{ $setting->title }}" id="logoPreview" style="width: 100px; height: 100px;border-radius: 50px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="logoPreview" style="width: 100px; height: 100px;border-radius: 50px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('logo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Favicon </label><small class="text-small text-danger"> (* Preferred Favicon 50*50 and PNG)</small>

                                        <input type="file" class="form-control" name="favicon" id="faviconInput" onchange="previewfavicon()">
                                        @if(isset($setting) && $setting->favicon)
                                            <img src="{{ asset('image/setting/' . $setting->favicon) }}" alt="{{ $setting->title }}" id="faviconPreview" style="width: 50px; height: 50px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="faviconPreview" style="width: 50px; height: 50px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('favicon')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>App Topber Logo </label><small class="text-small text-danger"> (* Preferred App Topber Logo 200*50 and PNG)</small>
                                        <input type="file" class="form-control" name="app_topber_logo" id="app_topber_logoInput" onchange="previewapp_topber_logo()">
                                        @if(isset($setting) && $setting->app_topber_logo)
                                            <img src="{{ asset('image/setting/' . $setting->app_topber_logo) }}" alt="{{ $setting->title }}" id="app_topber_logoPreview" style="width: 200px; height: 50px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="app_topber_logoPreview" style="width: 200px; height: 50px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('app_topber_logo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                     <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Number" value="{{ isset($setting) ? $setting->phone : old('phone') }}" name="phone">
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                  
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Whats App Number</label>
                                        <input type="text" class="form-control" placeholder="Enter Number" value="{{ isset($setting) ? $setting->whats_app : old('whats_app') }}" name="whats_app">
                                        @error('whats_app')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone Logo </label><small class="text-small text-danger"> (* Preferred Phone Logo 200*200 Circle and PNG)</small>
                                        <input type="file" class="form-control" name="phone_logo" id="phoneInput" onchange="previewphone()">
                                        @if(isset($setting) && $setting->phone_logo)
                                            <img src="{{ asset('image/setting/' . $setting->phone_logo) }}" alt="{{ $setting->title }}" id="phonePreview" style="width: 100px; height: 100px;border-radius: 50px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="phonePreview" style="width: 100px; height: 100px;border-radius: 50px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('phone')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Whats App Logo </label><small class="text-small text-danger"> (* Preferred Whats App Logo 200*200 Circle and PNG)</small>
                                        <input type="file" class="form-control" name="whats_app_logo" id="whats_app_logoInput" onchange="previewwhats_app_logo()">
                                        @if(isset($setting) && $setting->whats_app_logo)
                                            <img src="{{ asset('image/setting/' . $setting->whats_app_logo) }}" alt="{{ $setting->title }}" id="whats_app_logoPreview" style="width: 100px; height: 100px;border-radius:50px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="whats_app_logoPreview" style="width: 100px; height: 100px;border-radius: 50px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('whats_app_logo')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Menu Bar Background Image </label><small class="text-small text-danger"> (* Preferred Menu Bar Background Image 320*50 Circle and PNG)</small>
                                        <input type="file" class="form-control" name="menu_bar_background" id="menu_bar_backgroundInput" onchange="previewmenu_bar_background()">
                                        @if(isset($setting) && $setting->menu_bar_background)
                                            <img src="{{ asset('image/setting/' . $setting->menu_bar_background) }}" alt="" id="menu_bar_backgroundPreview" style="width: 320px; height: 50px; margin-top: 10px;">
                                        @else
                                            <img src="#" alt="Preview" id="menu_bar_backgroundPreview" style="width: 320px; height: 50px; display: none; margin-top: 10px;">
                                        @endif
                                        @error('menu_bar_background')
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
                               Update Setting
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
    function previewphone() {
        var input = document.getElementById('phoneInput');
        var preview = document.getElementById('phonePreview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    function previewwhats_app_logo() {
        var input = document.getElementById('whats_app_logoInput');
        var preview = document.getElementById('whats_app_logoPreview');

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
    function previewmenu_bar_background() {
        var input = document.getElementById('menu_bar_backgroundInput');
        var preview = document.getElementById('menu_bar_backgroundPreview');

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