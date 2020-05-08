@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Start sidebar-->  
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="/documents" class="btn btn-primary btn-block">
                        {{ __('Список документов') }}
                    </a>
                    <a href="#" class="btn btn-primary btn-block">
                        {{ __('Настройки профиля') }}
                    </a>
                    <a href="/changepassword" class="btn btn-primary btn-block">
                        {{ __('Сменить пароль') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- End sidebar--> 

        <!-- Start profile info--> 
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Настройки профиля</div>
                <div class="card-body">
                    {!! Form::open(['action' => ['ProfileController@update'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            <label for="name"><strong>Имя:</strong></label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ Auth::user()->name }}">
                        </div>
                        <div class="form-group">
                            <label for="email"><strong>email:</strong></label>
                            <input type="text" name="email" id="email" class="form-control" value="{{ Auth::user()->email }}">
                        </div>
                        {{Form::submit('Сохранить', ['class' => 'btn btn-primary'])}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- End profile info--> 
    </div>
</div>
@endsection
