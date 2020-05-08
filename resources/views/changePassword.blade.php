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
                    <a href="/profile" class="btn btn-primary btn-block">
                        {{ __('Настройки профиля') }}
                    </a>
                    <a href="#" class="btn btn-primary btn-block">
                        {{ __('Сменить пароль') }}
                    </a>
                </div>
            </div>
        </div>
        <!-- End sidebar--> 

        <!-- Start change password view--> 
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Смена пароля</div>
                <div class="card-body">
                    {!! Form::open(['action' => ['ProfileController@changePasswordView'], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            <label for="current-password"><strong>Текущий пароль:</strong></label>
                            <input type="password" name="current-password" id="current-password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="new-password"><strong>Новый пароль:</strong></label>
                            <input type="password" name="new-password" id="new-password" class="form-control">
                        </div>
                        <div class="form-group">
                                <label for="new-password_confirmation"><strong>Подтвердите новый пароль:</strong></label>
                                <input type="password" name="new-password_confirmation" id="new-password_confirmation" class="form-control">
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
