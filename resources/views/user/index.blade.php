@extends('layout.master')

@section('content')
<nav class="navbar bg-primary">
    <div class="container-fluid">
        <i class="bi-person-lines-fill fs-3 text-white"></i>
        <a class="navbar-brand text-white">Usuários</a>

        <form class="d-flex" role="search">
            <input type="text" class="form-control me-2" id="name" name="search" placeholder="Buscar" autofocus value="{{ request()->get('search') }}">
            <button class="btn btn-outline-light me-2" type="submit">Filtrar</button>
        </form>
    </div>
</nav>
<div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary flex-grow-1">
    @if(!empty($models->all()))
    <div class="list-group list-group-flush border-bottom scrollarea">
        @foreach ($models as $model)
        <div class="list-group-item list-group-item-action py-2 lh-sm">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <h5 class="card-title">#{{$model->id}} - {{$model->name}}</h5>
                <p class="card-text">{{$model->email}}</p>
                <div>
                    <div class="d-inline-block me-2">
                        <a type="button" class="btn btn-primary" href="{{ route('user.edit',$model->id) }}">
                            <i class="bi-pencil-square fs-5"></i>
                        </a>
                    </div>
                    <div class="d-inline-block">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modaldelete{{$model->id}}">
                            <i class="bi-trash fs-5"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-5 mb-1 small">Criado em {{$model->created_at->format('d/m/Y H:i:s')}}</div>
        </div>
        <div class="col d-flex justify-content-end">
            <div>
                <form action="{{ route('user.destroy',$model->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal fade" id="modaldelete{{$model->id}}" tabindex="-1" aria-labelledby="modaldeletetitle{{$model->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modaldeletetitle{{$model->id}}">Apagar Usuário</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>Você tem certeza disso?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Não</button>
                                    <button type="submit" class="btn btn-danger">Sim, apagar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p class="mt-5 fs-1 d-flex justify-content-center">Nenhum usuário cadastrado!</p>
    @endif
</div>

@if ($models->hasPages())
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item me-1">
            <a class="btn btn-outline-primary" href="{{ $models->previousPageUrl() }}">Voltar</a>
        </li>

        <li class="page-item">
            <a class="btn btn-outline-primary" href="{{ $models->nextPageUrl() }}">Próxima</a>
        </li>
    </ul>
</nav>
@endif


@endsection