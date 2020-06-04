@extends('layouts.app', ['title' => 'Настройки профиля'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Start sidebar--> 
            @include('inc.sidebar', ['user_id' => auth()->user()->id])
        <!-- End sidebar--> 

        <!-- Start profile info-->
    <div class="col-md-9">
        <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#profile">Профиль</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#resetPassword">Сменить пароль</a>
            </li>
        </ul>
        <div class="tab-content p-3">
            <div class="tab-pane fade show active" id="profile">
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
            <div class="tab-pane fade" id="resetPassword">
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
        <!-- End profile info--> 
    </div>
</div>
@endsection
