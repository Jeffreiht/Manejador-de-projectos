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
                <table class="table tabe-hover table-bordered">
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
                
            </div>
        </div>
    </div>
@endsection
