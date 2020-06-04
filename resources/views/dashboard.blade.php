@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
        <!-- Start sidebar--> 
            @include('inc.sidebar', ['user_id' => auth()->user()->id])
        <!-- End sidebar--> 
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">Список всех пользователей</div>
                    <div class="card-body">
                        @if (auth()->user()->id === 1) 
                            @if (count($users) > 0) 
                                @foreach ($users as $user)
                                    @if ($user->id === 1) 
                                        @continue 
                                    @endif
                                    <div class="dropdown show pb-3">
                                        <button type="button" class="btn btn-secondary dropdown-toggle w-100" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{ $user->name }}
                                        </button>
                                        <div class="dropdown-menu w-100 justify-content-center" aria-labelledby="dropdownMenuLink">
                                            @if (count($user->documents) > 0 )
                                                @foreach ($user->documents as $doc)
                                                @if ($doc->verified)
                                                    <a class="dropdown-item border border-success text-success" href="documents/{{$doc->id}}">
                                                @else
                                                    <a class="dropdown-item border border-danger text-danger" href="documents/{{$doc->id}}">
                                                @endif
                                                        {{$doc->id}} | {{$doc->title}}
                                                        @if ($doc->verified)
                                                            <div>Подтвержден</div>
                                                        @else
                                                            <div>Не подтвержден</div>
                                                        @endif
                                                    </a>
                                                @endforeach
                                            @else
                                                <span class="ml-auto">Список пуст</span>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach 
                            @else
                                <p>Пользователей нет!</p>
                            @endif 
                            @else 
                            Вы не являетесь менеджером. 
                        @endif
              </div>
            </div>
      
          </div>
        </div>
      </div>

@endsection
