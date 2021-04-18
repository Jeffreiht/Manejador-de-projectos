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
            <div class="col-md-6 mx-auto mt-3">
                <div class="card">
                    <div class="card-header">Crear Projecto</div>
                    <div class="card-body">
                        <form action="{{ route('project.store') }}" method="POST">
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
                            @csrf
                            <button type="submit" class="btn btn-success btn-block">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection