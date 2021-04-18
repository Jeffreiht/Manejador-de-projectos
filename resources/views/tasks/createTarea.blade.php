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
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header">Crear Tarea</div>

                    <div class="card-body">
                        <form action="{{ route('tarea.store', $projecto) }}" method="POST">
                            <div class="form-group">
                                <label class="text-muted">Titulo *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('title')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <input type="text" name="title" class="form-control" value="{{ old('title') }}">
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
                                <textarea name="description" class="form-control"></textarea>{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Manager *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('manager_id')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <select name="manager_id" class="form-control">
                                    @foreach ($managers as $manager)
                                        <option value="{{ $manager->id }}">{{ $manager->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="text-muted">Empleados *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('empleado_id')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <div class="border border-secondary">
                                    @foreach ($empleados as $empleado)
                                        <label >{{ $empleado->name }}</label>
                                        <input type="checkbox" name="empleado_id[]" value="{{ $empleado->id }}">
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
