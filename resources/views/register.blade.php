@extends('inc.layout')
@section('content')
    <div class="col-md-12">
        <div class="form-box">
            <form method="post" action="{{route('register.post')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Ad</label>
                        <input type="text" name="name" class="form-control" placeholder="Adiniz">
                    </div>
                    <div class="form-group col-md-4">
                        <label>E-Posta</label>
                        <input type="email" name="email" class="form-control" placeholder="Eposta">
                    </div>

                    <div class="form-group col-md-4">
                        <label>Parola</label>
                        <input type="password" name="password" class="form-control" placeholder="Parola">
                    </div>
                </div>
                <button type="submit" class="btn btn-info">Kayit Ol</button>
            </form>
        </div>
    </div>
@endsection
