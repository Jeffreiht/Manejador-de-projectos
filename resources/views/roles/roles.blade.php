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
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Crear Role</div>

                    <div class="card-body">
                        <form action="{{ route('role.store') }}" method="POST">
                            <div class="form-group">
                                <label class="text-muted">Nombre *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('name')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Descripcion *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('description')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Agregar Permisos</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('permiso_id')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="border border-secondary">
                                    @foreach ($permisos as $permiso)
                                        <label>{{ $permiso->name }}</label>
                                        <input type="checkbox" name="permiso_id[]" value="{{ $permiso->id }}">
                                    @endforeach
                                </div>
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <h4>
                    Buscar Role
                    <form action="{{ route('role.index') }}" method="GET" class="form-inline float-right mb-2">
                        <div class="form-group">
                            <input type="text" name="role" class="form-control mr-1" placeholder="Role" value="{{ request('role') }}">
                        </div>
                        <div class="form-group">
                            <input type="text" name="permiso" class="form-control mr-1" placeholder="Permiso" value="{{ request('permiso') }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Buscar</button>
                        </div>
                    </form>
                </h4>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                            <th >Permisos</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            <td>{{ $role->description }}</td>
                            @foreach ($role->permisos as $permiso)
                                <td>{{ $permiso->name }} </td>
                            @endforeach
                            <td width="10px">
                                <a href="{{ route('role.edit', $role) }}" class="btn btn-sm btn-primary">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('role.destroy', $role) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $roles->links() }}
            </div>
        </div>
    </div>
@endsection
