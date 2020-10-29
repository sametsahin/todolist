@extends('inc.layout')
@section('content')
    <div class="col-md-8">
        <ul class="list-group list-group-flush">
            @foreach($tasks as $task)

                <li class="list-group-item
                   {{(($task->finished_at < date('Y-m-d')) and ($task->is_ok==0))?'text-danger':null}}
                {{($task->is_ok ==1)?'text-success':null}}
                    ">
                    <input {{($task->is_ok ==1) ?'checked':null}} class=" switch" type="checkbox"
                           data-id="{{$task->id}}" data-toggle="toggle"
                           data-on="Aktif" data-off="Pasif" data-onstyle="success" data-offstyle="danger">
                    <a href="{{route('edit.task',$task->id)}}" title="Duzenle"
                       class="btn btn-info btn-sm"><i class="fa fa-edit"></i>
                    </a>
                    <a href="{{route('delete.task',$task->id)}}" title="Sil"
                       class="btn btn-danger btn-sm"><i class="fa fa-times"></i>
                    </a>
                    @if($task->finished_at < date('Y-m-d') and ($task->is_ok==0))
                        <del> {{$task->name}}</del>
                    @else
                        {{$task->name}}
                    @endif

                </li>
            @endforeach

        </ul>
    </div>
@endsection

@section('css')
    <link href="{{asset('back')}}/vendor/bootstrap-toggle/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
    <script src="{{asset('back')}}/vendor/bootstrap-toggle/bootstrap-toggle.min.js"></script>
    <script>
        $(function () {
            $('.switch').change(function () {
                id = $(this).data("id")
                is_ok = $(this).prop('checked');
                $.get("{{route('switch.task')}}", {id: id, is_ok: is_ok}, function (data) {
                    console.log(data);
                })
            })
        })
    </script>
@endsection
