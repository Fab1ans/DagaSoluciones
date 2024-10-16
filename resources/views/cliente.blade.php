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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
        </div>

        @if (session("Correcto"))
            <div class="alert alert-success">{{session("Correcto")}}</div>
        @endif
        @if (session("Incorrecto"))
            <div class="alert alert-danger">{{session("Incorrecto")}}</div>
        @endif

        <script>
            var res = function() {
                var not = confirm("Estas seguro de eliminar?");
                return not;
            }
        </script>

        <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditarLabel">Registrar nuevo cliente</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route("crud.create")}}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="txtNombre">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Direccion</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="txtDireccion">
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Entidad</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="txtentidad">
                            </div>

                            <div class="mb-3">
                                <label for="tipoDocumento" class="form-label">Tipo de Documento</label>
                                <select class="form-select" id="tipoDocumento" name="tipoDocumento" required>
                                    <option value="" selected>Seleccionar Tipo de Documento</option>
                                    <option value="dni">DNI</option>
                                    <option value="ruc">RUC</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="documento" class="form-label">Número de Documento</label>
                                <input type="text" class="form-control" id="documento" name="txtRUC_DNI" maxlength="8"
                                    inputmode="numeric" pattern="\d*" required oninput="this.value = this.value.replace(/\D/g, '')">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de clientes -->
        <div class="p-5 table-responsive">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo cliente</button>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>idCliente</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
                        <th>entidad</th>
                        <th>RUC_DNI</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                        <th>Historial</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datos as $item)
                    <tr>
                        <td>{{ $item->idCliente }}</td>
                        <td>{{ $item->Nombre }}</td>
                        <td>{{ $item->Direccion }}</td>
                        <td>{{ $item->entidad }}</td>
                        <td>{{ $item->RUC_DNI }}</td>
                        <td>
                            <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->idCliente }}"
                                class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                        </td>
                        <td>
                            <a href="{{route("crud.delete", $item->idCliente)}}" onclick="return res()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </td>
                        <td>
                            <button class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button>
                        </td>

                        <!-- Modal Editar -->
                        <div class="modal fade" id="modalEditar{{ $item->idCliente }}" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar datos del cliente</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{route("crud.update")}}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">idCliente</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="txtidCliente" value="{{$item->idCliente}}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="txtNombre" value="{{$item->Nombre}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Direccion</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="txtDireccion" value="{{$item->Direccion}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Entidad</label>
                                                <input type="text" class="form-control" id="exampleInputEmail1" name="txtentidad" value="{{$item->entidad}}">
                                            </div>

                                            <div class="mb-3">
                                                <label for="tipoDocumentoEditar" class="form-label">Tipo de Documento</label>
                                                <select class="form-select" id="tipoDocumentoEditar" name="tipoDocumento" required>
                                                    <option value="" {{ $item->RUC_DNI == '' ? 'selected' : '' }}>Seleccionar Tipo de Documento</option>
                                                    <option value="dni" {{ $item->RUC_DNI == 'dni' ? 'selected' : '' }}>DNI</option>
                                                    <option value="ruc" {{ $item->RUC_DNI == 'ruc' ? 'selected' : '' }}>RUC</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="documentoEditar" class="form-label">Número de Documento</label>
                                                <input type="text" class="form-control" id="documentoEditar" name="txtRUC_DNI" value="{{ $item->RUC_DNI }}"
                                                    maxlength="{{ $item->RUC_DNI == 'dni' ? '8' : '11' }}" inputmode="numeric" pattern="\d*" required
                                                    oninput="this.value = this.value.replace(/\D/g, '')">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Modificar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>

        <script>
            document.getElementById('tipoDocumento').addEventListener('change', function() {
                const documentoInput = document.getElementById('documento');
                if (this.value === 'dni') {
                    documentoInput.setAttribute('maxlength', '8');
                } else if (this.value === 'ruc') {
                    documentoInput.setAttribute('maxlength', '11');
                }
            });

            document.getElementById('tipoDocumentoEditar').addEventListener('change', function() {
                const documentoInput = document.getElementById('documentoEditar');
                if (this.value === 'dni') {
                    documentoInput.setAttribute('maxlength', '8');
                } else if (this.value === 'ruc') {
                    documentoInput.setAttribute('maxlength', '11');
                }
            });
        </script>

    </body>

    </html>

@endsection
