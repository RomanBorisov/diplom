@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="w-100">
            <a href="/documents" class="btn btn-default border border-dark mb-5">Назад</a>
            <h1>Создать документ</h1>
            {!! Form::open(['action' => 'DocumentsController@store', 'method' => 'POST']) !!}
                <div class="form-group">
                    {{Form::label('title', 'Название документа')}}
                    {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Название документа'])}}
                </div>
                <div class="form-group">
                        {{Form::label('body', 'Документ')}}
                        {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Введите текст', 'id' => 'editor'])}}
                </div>
                {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
            {!! Form::close() !!}
        
            <form method="post" enctype="multipart/form-data">
                @csrf              <!-- с версии Laravel 5.6 -->
            
                <!-- поле для загрузки файла -->
                <input type="file" name="userfile">
            
                <input type="submit">
            </form>
        </div>
    </div>
</div>

@endsection
