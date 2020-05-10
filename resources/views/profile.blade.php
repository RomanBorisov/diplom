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
                            <strong>{{Form::label('name', 'Имя')}}</strong>
                            {{Form::text('name', Auth::user()->name, ['class' => 'form-control', 'id' => 'name'])}}
                        </div>
                        <div class="form-group">
                            <strong>{{Form::label('email', 'email')}}</strong>
                            {{Form::text('email', Auth::user()->email, ['class' => 'form-control', 'id' => 'email'])}}
                            @if (Auth::user()->email_verified_at)
                                <small><span class="text-success font-weight-bold">Подтвержден</span></small>
                            @else
                                <small><span class="text-error font-weight-bold">Не подтвержден</span></small>
                            @endif
                        </div>

                        <div class="form-group">
                            <strong>{{Form::label('phone_number', 'Номер телефона')}}</strong>
                            {{Form::text('phone_number', Auth::user()->phone_number, ['class' => 'form-control', 'id' => 'phone_number'])}}
                            @if (Auth::user()->phone_verified_at)
                                <small><span class="text-success font-weight-bold">Подтвержден</span></small>
                            @else
                                <small><span class="text-error font-weight-bold">Не подтвержден</span></small>
                            @endif
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
