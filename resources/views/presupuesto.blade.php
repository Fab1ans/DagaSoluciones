@extends('dashboard')

@section('title', 'Presupuesto')

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
            <!-- Búsqueda por número de presupuesto -->
            <input type="text" class="form-control w-25" placeholder="Buscar Presupuesto">
        </div>
    
        <!-- Formulario para agregar o editar presupuesto -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Agregar/Editar Presupuesto</h5>
            </div>
            <div class="card-body">
                <form action="/presupuestos" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="info" class="col-sm-2 col-form-label">Información</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="info" name="info" required>
                        </div>
                    </div>
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
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
        <!-- Tabla de presupuestos -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Información</th>
                    <th>Fecha</th>
                    <th>Descargar</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de un presupuesto, puedes hacer esto dinámico con datos desde la base -->
                <tr>
                    <td>quiroga 502</td>
                    <td>12/04/2024</td>
                    <td>
                        <button class="btn btn-warning btn-sm"><i class="fa-solid fa-download"></i></button>
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
