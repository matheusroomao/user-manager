@extends('layout.master')

@section('content')
<nav class="navbar bg-body-tertiary">
    <div class="container-fluid">
        <i class="bi-person-lines-fill fs-3"></i>
        <a class="navbar-brand">Usuários</a>

        <form class="d-flex" role="search">
            <input type="text" class="form-control me-2" id="name" name="search" placeholder="Buscar" autofocus value="{{ request()->get('search') }}">
            <button class="btn btn-outline-primary me-2" type="submit">Filtrar</button>
        </form>
    </div>
</nav>
<div class="d-flex flex-column align-items-stretch flex-shrink-0 bg-body-tertiary flex-grow-1">
    <div class="list-group list-group-flush border-bottom scrollarea">
        @foreach ($models as $model)
        <div class="list-group-item list-group-item-action py-2 lh-sm">
            <div class="d-flex w-100 align-items-center justify-content-between">
                <strong class="mb-1">{{$model->name}}</strong>
                <button type="button" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#modaldelete{{$model->id}}">
                <i class="bi-trash fs-5"></i>
                </button>
            </div>
            <div class="col-5 mb-1 small">{{$model->email}}</div>
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