@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="w-100">
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
                            {{$docs->links()}}
                        @else 
                            <p>Документов нет!</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
   
@endsection
