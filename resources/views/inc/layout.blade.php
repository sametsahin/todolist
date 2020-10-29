<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"/>
    <link rel="stylesheet" href="{{asset('style.css')}}">
    @yield('css')
    @notify_css
    <title>QUIZ</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd;">
    <a class="navbar-brand" href="{{route('home')}}">
        <img src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" width="30" height="30"
             class="d-inline-block align-top" alt="">
        Todo List
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        @if(Auth::user())
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{(Request::segment(1)=='maddeler')?'active':null}}">
                    <a class="nav-link" href="{{route('tasks')}}">Maddeler</a>
                </li>
                <li class="nav-item {{(Request::segment(1)=='madde-ekle')?'active':null}}">
                    <a class="nav-link" href="{{route('add.task')}}">Madde Ekle</a>
                </li>
            </ul>
        @endif
        <ul class="navbar-nav ml-auto">
            @if(Auth::user())
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{route('tasks')}}">Maddeler</a>
                        <a class="dropdown-item" href="{{route('logout')}}">Cikis Yap</a>
                    </div>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Giris Yap</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('register')}}">Kayit Ol</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
<div class="container">
    @yield('content')
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
@notify_js
@notify_render
@yield('js')
</body>
</html>
