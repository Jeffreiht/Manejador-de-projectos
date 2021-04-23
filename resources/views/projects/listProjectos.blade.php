@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('status') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12">
                <h4>
                    Buscar Projectos &nbsp;
                    <form action="" method="GET" class="form-inline float-right mb-3">
                        <div class="form-group">
                            <input type="text" name="user" class="form-control mr-1" placeholder="Administrador"
                                value="{{ request('user') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="projecto" class="form-control mr-1" placeholder="Projecto"
                                value="{{ request('projecto') }}">
                        </div>
                        <div class="form-group">
                            <input type="date" name="fecha-creacion" class="form-control mr-1"
                                placeholder="Fecha de creacion" value="{{ request('fecha-creacion') }}">
                        </div>
                        <div class="form-group">
                            <select name="estado" class="form-control mr-1">
                                <option selected disabled value="">Estado</option>
                                <option value="1">Completo</option>
                                <option value="0">Incompleto</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Buscar</button>
                        </div>
                    </form>
                </h4>
            </div>
            @foreach ($projectos as $projecto)
                <div class="col-md-4 mb-2">
                    <div class="card">
                        <a href="{{ route('tarea.index', $projecto) }}">
                            <img class="card-image-top" src="{{ asset('images/project.jpg') }}"
                                style="width:349px;height:190px;">
                        </a>
                        <div class="card-body">
                            <div class="card-title d-flex justify-content-between">
                                <h4 class="text-truncate">{{ $projecto->name }}</h4>
                                @if (Auth::user()->id == $projecto->user_id && $projecto->estado == 1)
                                    <a id="disabled" href="{{ route('tarea.create', $projecto) }}"
                                        class="btn btn-sm btn-primary">Crear
                                        tarea</a>
                                @elseif (Auth::user()->id == $projecto->user_id)
                                    <a href="{{ route('tarea.create', $projecto) }}" class="btn btn-sm btn-primary">Crear
                                        tarea</a>
                                @endif
                            </div>

                            <p class="card-text text-truncate">{{ $projecto->description }}</p>

                            <p class="card-text text-muted">{{ $projecto->user->name }} <br>
                                {{ $projecto->created_at->diffForHumans() }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">

                            @if (Auth::user()->id == $projecto->user_id && $projecto->estado == 1)
                                <form action="{{ route('project.destroy', $projecto) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                </form>
                                <a id="disabled" href="{{ route('project.edit', $projecto) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('estado.update', $projecto) }}" method="POST">
                                    @method('put')
                                    <input type="checkbox" name="estado" value="1" hidden checked>
                                    @csrf
                                    <button disabled type="submit" class="btn btn-sm btn-success">Completar</button>
                                </form>
                            @elseif (Auth::user()->id == $projecto->user_id)
                                <form action="{{ route('project.destroy', $projecto) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                </form>
                                <a href="{{ route('project.edit', $projecto) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('estado.update', $projecto) }}" method="POST">
                                    @method('put')
                                    <input type="checkbox" name="estado" value="1" hidden checked>
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Completar</button>
                                </form>
                            @else
                                <form action="{{ route('project.destroy', $projecto) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button disabled type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                </form>
                                <a id="disabled" href="{{ route('project.edit', $projecto) }}"
                                    class="btn btn-primary btn-sm">Editar</a>
                                <form action="{{ route('estado.update', $projecto) }}" method="POST">
                                    @method('put')
                                    <input type="checkbox" name="estado" value="1" hidden checked>
                                    @csrf
                                    <button disabled type="submit" class="btn btn-sm btn-success">Completar</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $projectos->links() }}
    </div>
@endsection
