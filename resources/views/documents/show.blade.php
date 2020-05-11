@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100 justify-content-center">
            <a href="/documents" class="btn btn-default border border-dark mb-5">Назад</a>
            <h1>Название документа: "{{$doc->title}}"</h1>
            <div class="border">
                {!!$doc->body!!}
            </div>
            <hr>
            @if ($doc->cover_file==='nofile.jpg')
                <p>Нет загруженных файлов</p>
            @else
                Загруженный файл: <a href="/storage/cover_files/{{$doc->cover_file}}" download>{{$doc->cover_file}}</a>
            @endif
            <hr>
            <small>Создан: {{$doc->created_at}}</small>
            <hr>
            @if ($doc->verified)
                <p class="text-success">Документ подтвержден</p>
            @else
                <p class="text-danger">Документ не подтвержден</p>
            @endif
            <hr>            
            <div class="row justify-content-between">
                <a href="/documents/{{$doc->id}}/edit" class="btn btn-success">Редактировать</a>
                {!!Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            </div>
        </div>
    </div>
</div>
@endsection
