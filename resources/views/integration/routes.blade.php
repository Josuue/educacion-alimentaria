@extends('layouts.app')

@section('title', 'Rutas de la Aplicación')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">Rutas de la Aplicación</h1>
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Listado de Rutas</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Método</th>
                                    <th>URI</th>
                                    <th>Nombre</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($routeList as $route)
                                    <tr>
                                        <td><span class="badge bg-secondary">{{ $route['method'] }}</span></td>
                                        <td>{{ $route['uri'] }}</td>
                                        <td>{{ $route['name'] ?? '-' }}</td>
                                        <td>{{ $route['action'] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('integration.check') }}" class="btn btn-primary">
                    <i class="fas fa-check-circle me-1"></i>Verificar Integración
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
