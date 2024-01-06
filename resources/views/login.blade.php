@extends('layouts.template')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="stylelogin.css">
</head>
<body>

    @section('content')
    <!----------------------- Main Container -------------------------->

     <div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #005ae6;">
           <div class="featured-image mb-3">
            <img src="image/login2.jpg" class="img-fluid" style="width: 300px; padding:10px;">
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Web App</p>
           <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Pengelolaan Surat : TU</small><br>
       </div> 

    <!-------------------- ------ Right Box ---------------------------->
        
       <div class="col-md-6 right-box">
          <div class="row align-items-center">
                <div class="header-text mb-4">
                     <h2>Be Verified</h2>
                     <p>Silahkan login terlebih dahulu.</p>
                </div>
                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    @if (Session::get('failed'))
                        <div class="alert alert-danger">{{ Session::get('failed') }}</div>
                    @endif
                    @if (Session::get('logout'))
                        <div class="alert alert-primary">{{ Session::get('logout') }}</div>
                    @endif
                    @if (Session::get('canAccess'))
                        <div class="alert alert-danger">{{ Session::get('canAccess') }}</div>
                    @endif

                <div class="input-group mb-3">
                    <input type="email" name="email" id="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email address">
                    @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
                </div>

                <div class="input-group mb-1">
                    <input type="password" name="password" id="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                    @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                </div>

                <div class="input-group mb-3">
                    <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Login</button>
                </div>
          </div>
       </div> 
      </div>
    </div>
@endsection
</body>
</html>