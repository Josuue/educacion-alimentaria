@extends('layouts.app')

@section('title', 'Verificación de Integración')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">Verificación de Integración</h1>
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Estado de la Base de Datos</h5>
                </div>
                <div class="card-body">
                    <p><strong>Conexión a la base de datos:</strong> 
                        @if($dbConnection)
                            <span class="badge bg-success">Conectado</span>
                        @else
                            <span class="badge bg-danger">Desconectado</span>
                        @endif
                    </p>
                    
                    @if($dbConnection)
                        <p><strong>Nombre de la base de datos:</strong> {{ $dbName }}</p>
                        
                        <h6 class="mt-4">Migraciones ({{ $migrations->count() }})</h6>
                        <div class="table-responsive">
                            <table class="table table-sm table-striped">
                                <thead>
                                    <tr>
                                        <th>Migración</th>
                                        <th>Batch</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($migrations as $migration)
                                        <tr>
                                            <td>{{ $migration->migration }}</td>
                                            <td>{{ $migration->batch }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Modelos</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($models as $model => $exists)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $model }}
                                        @if($exists)
                                            <span class="badge bg-success rounded-pill">✓</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill">✗</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Controladores</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @foreach($controllers as $controller => $exists)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        {{ $controller }}
                                        @if($exists)
                                            <span class="badge bg-success rounded-pill">✓</span>
                                        @else
                                            <span class="badge bg-danger rounded-pill">✗</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Vistas</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach($views as $view => $exists)
                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span>{{ $view }}</span>
                                    @if($exists)
                                        <span class="badge bg-success rounded-pill">✓</span>
                                    @else
                                        <span class="badge bg-danger rounded-pill">✗</span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <a href="{{ route('integration.routes') }}" class="btn btn-primary">
                    <i class="fas fa-route me-1"></i>Ver Rutas
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
