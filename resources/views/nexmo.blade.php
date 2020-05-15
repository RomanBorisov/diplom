@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Подтверждение номера телефона') }}</div>
                <div class="card-body">
                    @if(Auth::user()->phone_verified_at )
                        {{ __('Номера телефона телефона подтвержден') }}
                        <br>
                        <a href="/documents" class="btn btn-success">К списку документов</a>
                
                    @else
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
        
                        <form method="POST" action="{{ route('nexmo') }}">
                            @csrf
        
                            <div class="form-group row">
                                <label for="code" class="col-md-4 col-form-label text-md-right">{{ __('Подтверждение номера телефона') }}</label>
                                <div class="col-md-6">
                                    <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" required autocomplete="code" autofocus>
        
                                    @error('code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
        
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Подтвердить') }}
                                    </button>
                                </div>
                            </div>
                        </form>               
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
