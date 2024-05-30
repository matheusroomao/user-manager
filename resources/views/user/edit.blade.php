@extends('layout.master')

@section('content')
<nav class="navbar bg-primary">
    <div class="container-fluid">
        <i class="bi-plus-circle-fill fs-3 text-white"></i>
        <a class="navbar-brand text-white">Atualizar Usuário</a>
        <div></div>
    </div>
</nav>

<div class="container mt-5">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title">{{$model->name}}</h6>
                <form class="forms-sample" method="post" action="{{ route('user.update', $model->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="name">Nome <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="name" value="{{ $model->name }}" />
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="email">Email <b class="text-danger">*</b></label>
                            <input class="form-control" type="text" name="email" value="{{ $model->email }}" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 mb-2">
                            <label for="password">Senha <b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="password" />
                        </div>
                        <div class="col-sm-6 mb-2">
                            <label for="password">Confirme a Senha <b class="text-danger">*</b></label>
                            <input class="form-control" type="password" name="password_confirmation" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-2">Atualizar</button>
                    <a href="{{ route('user.index') }}" class="btn btn-danger"><i data-feather="x"></i>Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection