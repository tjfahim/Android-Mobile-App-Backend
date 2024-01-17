<!DOCTYPE html>

 <html lang="en">
 
 <head>
     <meta charset="utf-8" />
     <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('backend/assets/img/apple-icon.png')}}">
     <link rel="icon" type="image/png" href="{{ asset('image/setting/' . $settings->favicon) }}">

     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     <title>Admin</title>
     <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
     <link href="{{ asset('backend/assets/css/bootstrap.min.css')}}" rel="stylesheet" />
     <link href="{{ asset('backend/assets/css/light-bootstrap-dashboard.css?v=2.0.0')}} " rel="stylesheet" />
     <link href="{{ asset('backend/assets/css/demo.css')}}" rel="stylesheet" />
     <style>
        .card {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Add box shadow */
        transition: box-shadow 0.3s ease; /* Add smooth transition for hover effect */
    }
    
    /* Hover effect */
    .card:hover {
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }
    
    /* Image styling */
    .podcast-image {
        width: 100%;
        height: 177px;
        object-fit: cover;
        overflow: hidden;
    }


    </style>
 </head>
 
 <body>
     <div class="wrapper">
        @include('backend.layouts.sidebar')

         <div class="main-panel">
             <!-- Navbar -->
             <nav class="navbar navbar-expand-lg " color-on-scroll="500">
                 <div class="container-fluid">
                     
                     <div class="collapse navbar-collapse justify-content-end" id="navigation">
                         <ul class="nav navbar-nav mr-auto">
                         </ul>
                         <ul class="navbar-nav ml-auto">
                             <li class="nav-item">
                                 <a class="nav-link" href="{{ route('logout')}}">
                                     <span class="no-icon">Log out</span>
                                 </a>
                             </li>
                         </ul>
                     </div>
                 </div>
             </nav>
