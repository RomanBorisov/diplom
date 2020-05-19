@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100">
            <a href="/documents" class="btn btn-default border border-dark mb-5">Назад</a>
            <h1>Редактировать документ</h1>
            {!! Form::open(['action' => ['DocumentsController@update', $doc->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Название документа')}}
                    {{Form::text('title', $doc->title, ['class' => 'form-control', 'placeholder' => 'Название документа'])}}
                </div>
                <div class="form-group">
                        {{Form::label('body', 'Документ')}}
                        {{Form::textarea('body', $doc->body, ['class' => 'form-control', 'placeholder' => 'Введите текст', 'id' => 'editor'])}}
                </div>
                <div class="form-group">
                    @if ($doc->cover_file === '')
                        {{Form::file('cover_file')}}
                    @else
                        <a href="" download="{{$doc->cover_file}}">{{$doc->cover_file}}</a>
                    @endif
                </div>
                {{Form::hidden('_method','PUT')}}
                {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
