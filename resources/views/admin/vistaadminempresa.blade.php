<!DOCTYPE html>
<html lang="en">
@include('plantilla/admin/headEmpresaAdmin')

<head>
    <!--  css botones datatable  -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/2.3.3/css/buttons.dataTables.min.css" />

    <!---- script ---->
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <!-- script buttons datatable-->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.3/js/buttons.print.min.js"></script>

    <title>Empresas registradas</title>
</head>

<body>
    @include('plantilla/admin/navBar')
    <section class="full-box dashboard-contentPage" style="margin: 5%">
        <!-- Notificaciones -->
        @include('notificaciones/notificaciones')
        @include('sweetalert::alert')
        <!-- Content page -->
        <div class="row align-items-center justify-content-center">
            <h3 class="text-titles text-justify text-center">Empresas<small>(Registradas)</small> </h3>
        </div>



        <div class="row">

            <div class="col-md-3">
                <form action="{{ route('empresa_registro.index') }}" method="GET">
                    @csrf
                    <button type="submit" value="Agregar empresa" class="btn btn-info"> <i
                            class="zmdi zmdi-account-add"></i> Agregar empresa</button>
                </form>
            </div>
        </div>
        <br>
        <div class="table-responsive">

            <table class="table table-striped" id="empresas">
                <thead>
                    <tr style="background: rgb(217, 214, 214)">
                        <th>Nombre</th>
                        <th>Direccion</th>
                        <th>Correo</th>
                        <th>Telefono</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($empresa as $Edatos)
                        <tr>
                            <td>{{ $Edatos->Nombre }}</td>
                            <td>{{ $Edatos->Direccion }}</td>
                            <td>{{ $Edatos->Correo }}</td>
                            <td>{{ $Edatos->Telefono }}</td>
                            <td>
                                <form action="{{ route('ver_datos_empresa.index', $Edatos->IdEmp) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btnEliminarUser"> Editar <i
                                            class="zmdi zmdi-edit"></i></button>
                                </form>

                            </td>
                            <td>
                                <form action="{{ route('eliminarEmpresa.index', $Edatos->IdEmp) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btnEliminarUser">Eliminar</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </section>


    <section>

    </section>

</body>
<script>
    $(document).ready(function() {
        $('#empresas').DataTable({
            dom: "Bfrtip",
            buttons: {
                dom: {
                    button: {
                        className: 'btn'
                    }
                },
                buttons: [{
                        extend: "excel",
                        text: 'Exportar a Excel',
                        className: 'btn btn-outline-success',
                        excelStyles: {
                            template: 'header-blue'
                        },
                        exportOptions: {
                            columns: function(column, data, node) {
                                if (column > 3) {
                                    return false;
                                }
                                return true;
                            }
                        }
                    },
                    {
                        extend: "pdf",
                        text: 'Exportar a PDF',
                        className: 'btn btn-outline-danger',
                        excelStyles: {
                            template: 'header-blue'
                        },
                        exportOptions: {
                            columns: function(column, data, node) {
                                if (column > 3) {
                                    return false;
                                }
                                return true;
                            }
                        }
                    }
                ]
            }
        });
    });
</script>

</html>
