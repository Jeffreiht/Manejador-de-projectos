@extends('layouts.app')

@section('content')
    <div class="container">
        <div>
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header">Editar Tarea</div>

                    <div class="card-body">
                        <form action="{{ route('tarea.store', $tarea) }}" method="POST">
                            @method('PUT')
                            <div class="form-group">
                                <label class="text-muted">Titulo *</label>
                                @if ($errors->any())
                                    <div class="alert alert-sm alert-danger">
                                        @error('title')
                                            <span class="error">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif
                                <input type="text" name="title" class="form-control"
                                    value="{{ old('title', $tarea->title) }}">
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
                                <textarea name="description"
                                    class="form-control">{{ old('description', $tarea->description) }}</textarea>
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
                                        <input type="checkbox" name="empleado_id[]" value="{{ $empleado->id }}">
                                        <label>{{ $empleado->name }}</label>
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
