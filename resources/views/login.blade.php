@extends('inc.layout')
@section('content')
    <div class="col-md-6">
        <div class="form-box">
            <form method="post" action="{{route('login.post')}}">
                @csrf
                <div class="form-group">
                    <label>E-Posta</label>
                    <input type="email" name="email" class="form-control" placeholder="Eposta giriniz">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Parola">
                </div>
                <button type="submit" class="btn btn-primary">Giris</button>
            </form>
        </div>
    </div>

@endsection
