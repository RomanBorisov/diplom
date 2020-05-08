@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Start sidebar-->  
        <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <a href="/documents/create" class="btn btn-primary btn-block">
                                {{ __('Создать документ') }}
                        </a>
                        <a href="/profile" class="btn btn-primary btn-block">
                            {{ __('Настройки профиля') }}
                        </a>
                    </div>
                </div>
            </div>
            <!-- End sidebar--> 
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Список документов</div>
                <div class="card-body">
                        @if (count($docs) > 0)
                            <div class="list-group">
                                @foreach ($docs as $doc)
                                    <a href="/documents/{{$doc->id}}" class="list-group-item list-group-item-action flex-column  ml-auto mr-auto mb-2">
                                        <div class="d-flex justify-content-between p-2">
                                            <h5 class="mb-1">{{$doc->title}}</h5>
                                            <small>{{$doc->created_at}}</small>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else 
                            <p>Документов нет!</p>
                            <a class="btn btn-success" href="/documents/create">
                                {{ __('Создать документ') }}
                            </a>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>  
@endsection
