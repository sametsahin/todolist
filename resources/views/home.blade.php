@extends('inc.layout')
@section('content')
    <div class="col-md-12">
        <div class="jumbotron">
            <h2 class="display-4">TODOLISTE HOSGELDIN!</h2>

            @if(Auth::user())
                <p class="lead">Hosgeldin {{Auth::user()->name}}</p>
            @else
                <p class="lead">Kayit yap veya giris yap</p>
                <hr class="my-4">
                <p class="lead">
                    <a class="btn btn-info btn-lg" href="{{route('register')}}" role="button">Kayit Ol</a>
                    <a class="btn btn-primary btn-lg" href="{{route('login')}}" role="button">Giris Yap</a>
                </p>
            @endif
        </div>
    </div>
@endsection
