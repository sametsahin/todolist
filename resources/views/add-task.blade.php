@extends('inc.layout')
@section('content')
    <div class="col-md-12">
        <div class="form-box">
            @include('inc.errors')
            <form method="post" action="{{route('add.task.post')}}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>TASK Number</label>
                        <input type="text"  name="name" class="form-control"
                               value="TASK{{++$last_task_number}}" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Task Baslik</label>
                        <input type="text" name="title" class="form-control" placeholder="Task Basligi Giriniz">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Bitiş Tarihi</label>
                        <input name="finished_at" type="date" class="form-control">
                    </div>
                    <div class="form-group col-md-12">
                        <label>Task Icerigi Giriniz</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                    <input name="admin_id" type="hidden" value="{{Auth::user()->id}}">
                </div>
                <button type="submit" class="btn btn-info">Yeni Madde Ekle</button>
            </form>
        </div>
    </div>
@endsection
