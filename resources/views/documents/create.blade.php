@extends('layouts.app', ['title' => 'Создать документ'])

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
                @if (auth()->user()->id === 1) 
                    <div class="form-group">
                        {{Form::label('user_id', 'Пользователь: ')}}
                        {{Form::select('user_id', $users->pluck('name', 'id')) }}
                    </div>
                @endif

                <!-- Large modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Сохранить</button>

                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Пользовательское соглашение</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @include('inc.termsOfUse')
                        </div>
                        <div class="modal-footer">
                            {{Form::button('Закрыть', ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal'])}}
                            {{Form::submit('Подтвердить', ['class' => 'btn btn-primary'])}}
                        </div>                    
                    </div>
                </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
