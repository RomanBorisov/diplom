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
            <small>{{$doc->created_at}}</small>
        </div>
    </div>
</div>
@endsection
