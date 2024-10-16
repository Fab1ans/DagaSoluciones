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
            var res=function(){
                var not=confirm("Estas seguro de eliminar?");
                return not;
            }

        </script>
            
        <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="modalEditarLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalEditarLabel">Registrar nuevo cliente</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                            
                                            <form action="{{route("crud.create")}}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                  <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtNombre"></div>
                                                 
                                                  <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Direccion</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtDireccion"></div>
                                            
                                                    <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label"> RUC_DNI </label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtRUC_DNI"></div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Registrar</button>
                                                </div>
                                              </form>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>
        </div>




        <!-- Tabla de clientes -->
        <div class="p-5 table-resposive">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar nuevo cliente</button>
            <table class="table table-bordered">
                <thead class="table-light">
                    <tr>
                        <th>idCliente</th>
                        <th>Nombre</th>
                        <th>Dirección</th>
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
                            <td>{{ $item->RUC_DNI }}</td>
                            <td>
                                <a href="" data-bs-toggle="modal"
                                data-bs-target="#modalEditar{{ $item->idCliente }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{route("crud.delete", $item->idCliente)}}"   onclick="return res()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                            <td>
                                <button class="btn btn-warning btn-sm"><i class="fa fa-print"></i></button>
                            </td>

                            <!-- Modal -->
                            <div class="modal fade" id="modalEditar{{ $item->idCliente }}" tabindex="-1" aria-labelledby="modalEditarLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="modalEditarLabel">Modificar datos del cliente</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form   action="{{route("crud.update")}}" method="POST">
                                                @csrf
                                    
                                                <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">idCliente</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtidCliente" value="{{$item->idCliente}}">
                                                  </div>
                                                <div class="mb-3">
                                                  <label for="exampleInputEmail1" class="form-label">Nombre</label>
                                                  <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtNombre" value="{{$item->Nombre}}">
                                                </div>
                                                 
                                                  <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">Direccion</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtDireccion" value="{{$item->Direccion}}">
                                                </div>
                                               
                                                    <div class="mb-3">
                                                    <label for="exampleInputEmail1" class="form-label">RUC_DNI</label>
                                                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="txtRUC_DNI" value="{{$item->RUC_DNI}}" >
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-primary">Modificar</button>
                                                </div>
                                              </form>
                                        </div>
                                       
                                    </div>
                                </div>
                            </div>


                        </tr>
                    @endforeach
                    <!-- Ejemplo de un cliente, puedes hacer esto dinámico con datos desde la base -->

                    <!-- Más filas -->
                </tbody>
            </table>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>

    </html>

@endsection
