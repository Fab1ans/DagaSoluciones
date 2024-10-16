@extends('dashboard')

@section('title', 'Presupuestos')

@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presupuestos</title>
    <link rel="stylesheet" href="{{ asset('css/factura.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/65c5954a63.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between mb-3">
            <input type="text" class="form-control w-25" placeholder="Buscar por descripción o cliente">
        </div>
    </div>

    @if (session("Correcto"))
        <div class="alert alert-success">{{session("Correcto")}}</div>
    @endif
    @if (session("Incorrecto"))
        <div class="alert alert-danger">{{session("Incorrecto")}}</div>
    @endif

    <!-- Modal para agregar nuevo presupuesto -->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Registrar nuevo presupuesto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
         
                <div class="modal-body">
                    <form action="{{ route('presupuestos.create') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fechaPresu" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fechaPresu">
                        </div>
                        <div class="mb-3">
                            <label for="descripcionPres" class="form-label">Descripción General</label>
                            <input type="text" class="form-control" name="descripcionPres">
                        </div>
                        <div class="mb-3">
                            <label for="idCliente" class="form-label">Cliente</label>
                            <select class="form-control" name="idCliente">
                                @foreach($clientes as $cliente)
                                    <option value="{{ $cliente->idCliente }}">{{ $cliente->Nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <h5>Detalles del Presupuesto</h5>
                        <div id="detalles-container">
                            <!-- Aquí puedes agregar múltiples detalles del presupuesto -->
                            <div class="detalle mb-3">
                                <label for="descriptabla" class="form-label">Descripción Detalle</label>
                                <input type="text" class="form-control" name="detalles[0][descriptabla]" required>

                                <label for="unidadMed" class="form-label">Unidad de Medida</label>
                                <input type="text" class="form-control" name="detalles[0][unidadMed]" required>

                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="detalles[0][cantidad]" required>

                                <label for="precioUnitario" class="form-label">Precio Unitario</label>
                                <input type="number" class="form-control" name="detalles[0][precioUnitario]" required>

                                <label for="descuentoPres" class="form-label">Descuento</label>
                                <input type="number" class="form-control" name="detalles[0][descuentoPres]">

                                <label for="TotalPres" class="form-label">Total</label>
                                <input type="number" class="form-control" name="detalles[0][TotalPres]" required>

                                <label for="nota" class="form-label">Nota</label>
                                <input type="text" class="form-control" name="detalles[0][nota]">

                                <label for="garantia" class="form-label">Garantía</label>
                                <input type="text" class="form-control" name="detalles[0][garantia]">
                            </div>
                        </div>

                        <button type="button" id="add-detail" class="btn btn-secondary">Agregar Detalle</button>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Ver Detalles del Presupuesto -->
    <div class="modal fade" id="modalVerDetalles" tabindex="-1" aria-labelledby="modalVerDetallesLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalVerDetallesLabel">Detalles del Presupuesto</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detalles-content">
                    <!-- Aquí se cargarán los detalles dinámicamente -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de presupuestos -->
    <div class="p-5 table-responsive">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo presupuesto</button>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Detalles</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($presupuestos as $item)
                    <tr>
                        <td>{{ $item->fechaPresu }}</td>
                        <td>{{ $item->descripcionPres }}</td>
                        <td>{{ $item->Nombre }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm" onclick="verDetalles({{ $item->idPresu }})" data-bs-toggle="modal" data-bs-target="#modalVerDetalles">Ver Detalles</button>
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('add-detail').addEventListener('click', function () {
            let index = document.querySelectorAll('.detalle').length;
            let container = document.getElementById('detalles-container');
            let newDetail = `
                <div class="detalle mb-3">
                    <label for="descriptabla" class="form-label">Descripción Detalle</label>
                    <input type="text" class="form-control" name="detalles[${index}][descriptabla]" required>

                    <label for="unidadMed" class="form-label">Unidad de Medida</label>
                    <input type="text" class="form-control" name="detalles[${index}][unidadMed]" required>

                    <label for="cantidad" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" name="detalles[${index}][cantidad]" required>

                    <label for="precioUnitario" class="form-label">Precio Unitario</label>
                    <input type="number" class="form-control" name="detalles[${index}][precioUnitario]" required>

                    <label for="descuentoPres" class="form-label">Descuento</label>
                    <input type="number" class="form-control" name="detalles[${index}][descuentoPres]">

                    <label for="TotalPres" class="form-label">Total</label>
                    <input type="number" class="form-control" name="detalles[${index}][TotalPres]" required>

                    <label for="nota" class="form-label">Nota</label>
                    <input type="text" class="form-control" name="detalles[${index}][nota]">

                    <label for="garantia" class="form-label">Garantía</label>
                    <input type="text" class="form-control" name="detalles[${index}][garantia]">
                </div>`;
            container.insertAdjacentHTML('beforeend', newDetail);
        });

        function verDetalles(idPresu) {
            fetch(`/presupuesto/detalles/${idPresu}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('detalles-content').innerHTML = data;
                });
        }
    </script>
</body>

</html>

@endsection
