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
                                @if (Auth::user()->id == $projecto->user_id)
                                    <a href="{{ route('tarea.create', $projecto) }}" class="btn btn-sm btn-primary">Crear
                                        tarea</a>
                                @endif
                            </div>

                            <p class="card-text text-truncate">{{ $projecto->description }}</p>

                            <p class="card-text text-muted">{{ $projecto->user->name }} <br>
                                {{ $projecto->created_at->diffForHumans() }}</p>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-dark" role="progressbar" style="width: 25%"
                                    aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            @if (Auth::user()->id == $projecto->user_id)
                                <form action="{{ route('project.destroy', $projecto) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                </form>
                                <a href="{{ route('project.edit', $projecto) }}" class="btn btn-primary btn-sm">Editar</a>
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
    </div>
@endsection
