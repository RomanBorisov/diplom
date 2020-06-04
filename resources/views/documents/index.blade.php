@extends('layouts.app', ['title' => 'Список документов'])

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- Start sidebar--> 
            @include('inc.sidebar', ['user_id' => auth()->user()->id])
        <!-- End sidebar--> 
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">Мои документы</div>
                <div class="card-body">
                    @if (count($docs) > 0)
                        <div class="card-deck">
                            @foreach ($docs as $doc)
                                <div class="col-6 col-sm-5 col-md-4 pb-3">
                                    <a href="/documents/{{$doc->id}}" class="card list-group-item-action">
                                        <div class="card-body">
                                            <h4 class="card-title">{{$doc->title}}</h4>
                                        </div>
                                        <div class="card-footer">
                                            <small class="text-muted">Последнее изменение: {{$doc->updated_at->diffForHumans()}}</small>
                                        </div>
                                    </a>
                                </div>
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
