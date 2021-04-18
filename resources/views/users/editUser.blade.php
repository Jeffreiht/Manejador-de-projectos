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
                        <form action="{{ route('user.update',$user) }}" method="POST">
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
                                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
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
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Clave *</label>
                                <input type="password" name="password" class="form-control">
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
        </div>
    </div>
@endsection