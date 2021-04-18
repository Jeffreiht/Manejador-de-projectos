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
                    <div class="card-header">Editar Role</div>

                    <div class="card-body">
                        <form action="{{ route('role.update', $role) }}" method="POST">
                            @method('PUT')
                            <div class="form-group">
                                <label class="text-muted">Nombre *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('name')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <input type="text" name="name" class="form-control" value="{{ old('name', $role->name) }}">
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
                                <textarea name="description" class="form-control">{{ old('description',$role->description) }}</textarea>
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
                                        <input type="checkbox" name="permiso_id" value="{{ $permiso->id }}">
                                    @endforeach
                                </div>
                            </div>
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection