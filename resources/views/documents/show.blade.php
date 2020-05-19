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
            @if ($doc->cover_file==='')
                <p>Нет загруженных файлов</p>
            @else
                Загруженный файл: 
                <a href="/storage/cover_files/{{$doc->cover_file}}" download>{{$doc->cover_file}}</a>
            @endif
            <hr>
            <span>Создан: {{$doc->created_at}}</span>
            <br>
            <span>Создатель: {{$doc->user['name']}}</span>
            <hr>
            @if ($doc->verified)
                <p class="font-weight-bold text-success text-uppercase">Документ подтвержден</p>
            @else
                <p class="font-weight-bold text-danger text-uppercase">Документ не подтвержден</p>
            @endif
            @if (auth()->user()->id === $doc->user_id)
                @if (!($doc->verified))
                    {!! Form::open(['action' => ['DocumentsController@verificate', $doc->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        {{Form::hidden('_method','PUT')}}
                        {{Form::submit('Подтвердить', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                @endif 
                <hr>            
                <div class="row justify-content-between">
                    <a href="/documents/{{$doc->id}}/edit" class="btn btn-success">Редактировать</a>
                    {!!Form::open(['action' => ['DocumentsController@destroy', $doc->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                        {{Form::hidden('_method', 'DELETE')}}
                        {{Form::submit('Удалить', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                </div>           
            @endif
        </div>
    </div>
</div>
@endsection
