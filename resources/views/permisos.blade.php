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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4>
                    Buscar Permisos
                    <form action="{{ route('permiso.index') }}" method="GET" class="form-inline float-right mb-2">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control mr-1" placeholder="Buscar" value="{{ request('name') }}">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-secondary">Buscar</button>
                        </div>
                    </form>
                </h4>
                <table class="table table-bordered table-dark bg-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Descripcion</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $permiso)
                            <tr>
                                <td>{{ $permiso->id }}</td>
                                <td>{{ $permiso->name }}</td>
                                <td>{{ $permiso->description }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $permisos->links() }}
            </div>
        </div>
    </div>
@endsection
