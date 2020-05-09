@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100">
            <a href="/documents" class="btn btn-default border border-dark mb-5">Назад</a>
            <h1>Создать документ</h1>
            {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Название документа')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Название документа'])}}
                </div>
                <div class="form-group">
                    {{Form::label('body', 'Документ')}}
                    {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Введите текст', 'id' => 'editor'])}}
                </div>
                <div class="form-group">
                    {{Form::file('cover_file')}}
                </div>

                {{Form::submit('Создать', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
