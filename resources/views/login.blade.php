<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      body {
        display: flex;
        align-items: center;
        padding-top: 150px;
        padding-bottom: 40px;
        background-color: #ffffff;
        height: 100%;
      }

      .form-signin {
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
      }

      .form-signin .checkbox {
        font-weight: 400;
      }

      .form-signin .form-floating:focus-within {
        z-index: 2;
      }

      .form-signin input[type="email"] {
        margin-bottom: -1px;
        border-bottom-right-radius: 0;
        border-bottom-left-radius: 0;
      }

      .form-signin input[type="password"] {
        margin-bottom: 10px;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
      }
          </style>

</head>
<body class="text-center">
    
<main class="form-signin">
  <div class="middle-box text-center loginscreen animated fadeInDown">
        @if(session('error'))
        <div class="alert alert-danger">
          <b>Opps!</b> {{session('error')}}
        </div>
        @endif
      <form action="{{ route('actionlogin') }}" method="post">
      @csrf
      <img class="mb-4" src="{{ asset('image/logo.png') }}" alt="" width="250">
      <div class="mb-4">
        <input type="text" class="form-control text-center" name="username" id="username" placeholder="Username">
      </div>
      <div class="mb-4">
        <input type="password" class="form-control text-center" name="password" id="password" placeholder="Password">
      </div>
      <button class="w-100 btn btn-lg btn-primary" type="submit">LOGIN</button>
    </form>
  </div>
  
</main>
  </body>
</html>
