@extends('dashboard')

@section('title', 'Informes')

@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Informes</title>
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
            <input type="text" class="form-control w-25" placeholder="Buscar por descripción o cliente">
        </div>
    </div>

    @if (session("Correcto"))
    <div class="alert alert-success">{{session("Correcto")}}</div>
    @endif
    @if (session("Incorrecto"))
    <div class="alert alert-danger">{{session("Incorrecto")}}</div>
    @endif
    <!-- Modal para Registrar nuevo Informe -->
    <div class="modal fade" id="modalInforme" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalEditarLabel">Registrar nuevo Informe</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route("informes.create")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="fechaInfo" class="form-label">Fecha</label>
                            <input type="date" class="form-control" name="fechaInfo">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" name="descripcion">
                        </div>
                        <div class="mb-3">
                            <label for="idCliente" class="form-label">Cliente</label>
                            <select class="form-control" name="idCliente">
                                @foreach($clientes as $cliente)
                                <option value="{{ $cliente->idCliente }}">{{ $cliente->Nombre }}</option>
                                @endforeach
                            </select>
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

    <div class="p-5 table-responsive">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalInforme">Registrar nuevo
            informe</button>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Fecha</th>
                    <th>Descripción</th>
                    <th>Cliente</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($informes as $item)
                <tr>
                    <td>{{ $item->fechaInfo }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->Nombre }}</td>
                    <!-- Boton para Editar  Informe -->
                    <td>
                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalEditar{{$item->idInforme}}">
                            <i class="fa fa-edit"></i>
                        </button>
                    </td>

                    <!-- Modal para editar informe -->
                    <div class="modal fade" id="modalEditar{{$item->idInforme}}" tabindex="-1"
                        aria-labelledby="modalEditarLabel{{$item->idInforme}}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="modalEditarLabel{{$item->idInforme}}">Editar
                                        Informe</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('informes.update', $item->idInforme) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="fechaInfo" class="form-label">Fecha</label>
                                            <input type="date" class="form-control" name="fechaInfo"
                                                value="{{ $item->fechaInfo }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="descripcion" class="form-label">Descripción</label>
                                            <input type="text" class="form-control" name="descripcion"
                                                value="{{ $item->descripcion }}">
                                        </div>
                                        <div class="mb-3">
                                            <label for="idCliente" class="form-label">Cliente</label>
                                            <select class="form-control" name="idCliente">
                                                @foreach($clientes as $cliente)
                                                <option value="{{ $cliente->idCliente }}"
                                                    {{ $cliente->idCliente == $item->idCliente ? 'selected' : '' }}>
                                                    {{ $cliente->Nombre }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancelar</button>
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Botón para abrir el modal de eliminar -->
                    <td>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#modalEliminar{{$item->idInforme}}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </td>

                    <!-- Modal para eliminar informe -->
                <div class="modal fade" id="modalEliminar{{$item->idInforme}}" tabindex="-1" aria-labelledby="modalEliminarLabel{{$item->idInforme}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEliminarLabel{{$item->idInforme}}">Eliminar Informe</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Estás seguro de que deseas eliminar este informe?
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('informes.destroy', $item->idInforme) }}" method="POST">
                                    @csrf
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
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
</body>

</html>

@endsection