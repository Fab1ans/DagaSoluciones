@extends('dashboard')

@section('title', 'Factura')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/factura.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/65c5954a63.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>
<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            
            <!-- Búsqueda por número de factura -->
            <input type="text" class="form-control w-25" placeholder="Buscar por número de factura">
    
        </div>
    
        <!-- Formulario para agregar o editar factura -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Agregar/Editar Factura</h5>
            </div>
            <div class="card-body">
                <form action="/facturas" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="fecha" class="col-sm-2 col-form-label">Fecha</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="archivo" class="col-sm-2 col-form-label">Archivo</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="archivo" name="archivo">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="monto" class="col-sm-2 col-form-label">Monto</label>
                        <div class="col-sm-10">
                            <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
        <!-- Tabla de facturas -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Factura</th>
                    <th>Fecha</th>
                    <th>Nombre de Archivo</th>
                    <th>Monto</th>
                    <th>Imprimir</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de una factura, puedes hacer esto dinámico con datos desde la base -->
                <tr>
                    <td>1</td>
                    <td>April 17, 2023</td>
                    <td><a href="{{ asset('uploads/factura1.pdf') }}" target="_blank">factura1.pdf</a></td>
                    <td>412.5</td>
                    <td>
                        <button class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>
                </tr>
                <!-- Más filas -->
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
@endsection
