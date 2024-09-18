@extends('dashboard')

@section('title', 'Clientes')

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
            
            <!-- Búsqueda por nombre o email -->
            <input type="text" class="form-control w-25" placeholder="Buscar por nombre o email">
    
        </div>
    
        <!-- Formulario para agregar o editar cliente -->
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Agregar/Editar Cliente</h5>
            </div>
            <div class="card-body">
                <form action="/clientes" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <label for="nombre" class="col-sm-2 col-form-label">Nombre</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="direccion" name="direccion" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="rucDni" class="col-sm-2 col-form-label">RUC/DNI</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="rucDni" name="rucDni" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="numero" class="col-sm-2 col-form-label">Número</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="numero" name="numero" required>
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
    
        <!-- Tabla de clientes -->
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Cod Cliente</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>RUC/DNI</th>
                    <th>Número</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Historial</th>
                </tr>
            </thead>
            <tbody>
                <!-- Ejemplo de un cliente, puedes hacer esto dinámico con datos desde la base -->
                <tr>
                    <td>1</td>
                    <td>Jose Lozano</td>
                    <td>Mz 11 lote 4 2da zona de Bayovar</td>
                    <td>74209352</td>
                    <td>940740047</td>
                    <td>
                        <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                    </td>
                    <td>
                        <button class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button>
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
