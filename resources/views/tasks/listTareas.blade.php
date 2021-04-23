@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-primary mr-auto">Volver a Projectos</a>
                        <h5 class="mr-auto">{{ $projecto->name }}</h5>
                        @foreach (Auth::user()->roles as $roles)
                            @foreach ($roles->permisos as $permiso)
                                @if ((Auth::user()->id == $projecto->user_id && $projecto->estado == 1) || $permiso->name == 'Crear tarea')
                                    <a id="disabled" href="{{ route('tarea.create', $projecto) }}"
                                        class="btn btn-sm btn-primary">Crear
                                        tarea</a>
                                @elseif (Auth::user()->id == $projecto->user_id || $permiso->name == 'Crear tarea')
                                    <a href="{{ route('tarea.create', $projecto) }}" class="btn btn-sm btn-primary">Crear
                                        tarea</a>
                                @endif
                            @endforeach
                        @endforeach
                    </div>
                    <div class="card-body">
                        <p>{{ $projecto->description }}</p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped bg-success progress-bar-animated"
                                role="progressbar" style="width: {{ $progreso }}%" aria-valuenow="{{ $progreso }}"
                                aria-valuemin="0" aria-valuemax="100">
                                {{ $progreso }} %
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <h6>
                            {{ $projecto->user->name }}
                        </h6>
                        <h6>
                            {{ $projecto->created_at->diffForHumans() }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            @foreach ($tareas as $tarea)
                @if ($projecto->id == $tarea->projecto_id)
                    <div class="col-md-4">
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="text-center"><strong>Titulo: </strong>{{ $tarea->title }}</p>
                                <p><strong>Descripcion: </strong>{{ $tarea->description }}</p>
                                <p><strong>Manager: </strong>{{ $tarea->user->name }}</p>
                                <p><strong>Empleados: </strong>
                                    @foreach ($tarea->users as $user)
                                        {{ $user->name }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="card-footer d-flex justify-content-between">
                                @foreach (Auth::user()->roles as $role)
                                    @if (Auth::user()->id == $projecto->user_id || ($role->name == 'Manager' && Auth::user()->name == $tarea->user->name))

                                        @if ($tarea->estado == 1)
                                            <form action="{{ route('tarea.destroy', $tarea) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button disabled type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                            <a id="disabled" href="{{ route('tarea.edit', $tarea) }}"
                                                class="btn btn-primary">Editar</a>
                                            <form action="{{ route('estado.store', $tarea) }}" method="POST">
                                                @method('put')
                                                <input type="checkbox" name="estado" value="1" hidden checked>
                                                @csrf
                                                <button disabled type="submit" class="btn btn-success">Completar</button>
                                            </form>

                                        @elseif (Auth::user()->name == $tarea->user->name)
                                            <form action="{{ route('tarea.destroy', $tarea) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button disabled type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                            <a id="disabled" href="{{ route('tarea.edit', $tarea) }}"
                                                class="btn btn-primary">Editar</a>
                                            <form action="{{ route('estado.store', $tarea) }}" method="POST">
                                                @method('put')
                                                <input type="checkbox" name="estado" value="1" hidden checked>
                                                @csrf
                                                <button type="submit" class="btn btn-success">Completar</button>
                                            </form>
                                        @else
                                            <form action="{{ route('tarea.destroy', $tarea) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Borrar</button>
                                            </form>
                                            <a href="{{ route('tarea.edit', $tarea) }}"
                                                class="btn btn-primary">Editar</a>
                                            <form action="{{ route('estado.store', $tarea) }}" method="POST">
                                                @method('put')
                                                <input type="checkbox" name="estado" value="1" hidden checked>
                                                @csrf
                                                <button type="submit" class="btn btn-success">Completar</button>
                                            </form>
                                        @endif
                                    @else
                                        <form action="{{ route('tarea.destroy', $tarea) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button disabled type="submit" class="btn btn-danger">Borrar</button>
                                        </form>
                                        <a id="disabled" href="{{ route('tarea.edit', $tarea) }}"
                                            class="btn btn-primary">Editar</a>
                                        <form action="{{ route('estado.store', $tarea) }}" method="POST">
                                            @method('put')
                                            <input type="checkbox" name="estado" value="1" hidden checked>
                                            @csrf
                                            <button disabled type="submit" class="btn btn-success">Completar</button>
                                        </form>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@endsection
