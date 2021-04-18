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
                    <div class="card-header">Crear Usuario</div>
                    <div class="card-body">
                        <form action="{{ route('user.store') }}" method="POST">
                            <div class="form-group">
                                <label class="text-muted">Nombre *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('name')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <input type="text" name="name" placeholder="Nombre" class="form-control"
                                    value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Email *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('email')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <input type="email" name="email" placeholder="Email" class="form-control"
                                    value="{{ old('email') }}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Clave *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('password')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <input type="password" name="password" placeholder="Clave" class="form-control"
                                    value="{{ old('password') }}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Roles *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('role_id')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="border border-secondary">
                                    @foreach ($roles as $role)
                                        <label>{{ $role->name }}</label>
                                        <input type="checkbox" name="role_id[]" value="{{ $role->id }}">
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
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                @foreach ($user->roles as $role)
                                    <td>
                                        <p>{{ $role->name }}</p>
                                    </td>
                                @endforeach
                                <td width="10px">
                                    <a href="{{ route('user.edit', $user) }}" class="btn btn-sm btn-primary">Editar</a>
                                </td>
                                <td width="10px">
                                    <form action="{{ route('user.destroy', $user) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger">Borrar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
