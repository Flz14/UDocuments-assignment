<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Tabla de Solicitudes Alumno </title>
  <?php require '../back/admin/restriccionAcceso.php'; ?>

  <!-- Favicon -->
  <link rel="shortcut icon" href="../img/images/favicon.ico" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../css/font.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet">
  <link href="../css/dash.css" rel="stylesheet">

  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/jquery.datatable.min.css" rel="stylesheet">

  <link href="../css/responsive.dataTables.min.css" rel="stylesheet">
  <link href="../css/tableShow.css" rel="stylesheet">


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require_once '../front/general/sidebar.php'; ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require '../front/general/navbar.php'; ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <!-- Contenido Variable - Todo lo demas es fijo -->
        <div id="page-admin-table" class="container-fluid">


          <!-- Título de página -->
          <div class="d-sm-flex align-items-center justify-content-between mb-2 mx-auto">
            <h1 class="h3 mb-0 text-gray-800">Tabla de Solicitudes Alumno</h1>
            <a class="d-none d-sm-inline-block"><i class="fas fa-fw fa-table fa-2x text-gray-300"></i> </a>
          </div>
          <!-- /.Título de página -->


          <!-- Tabla de Admin -->
          <div class="card shadow mb-2">
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataSolicitudes" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th></th>

                      <th>Cédula</th>
                      <th>Alumno</th>
                      <th>Fecha de creación</th>
                      <th>Estado de solicitud</th>
                      <th>Fecha de Atención</th>
                      <th>Tipo</th>
                      <th>Carrera</th>
                      <th>Turno</th>
                      <th>Personal de atención</th>
                      <th>Validar Docs</th>
                      <th>Ver perfil</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- /.Tabla de Admin -->


        </div>
        <!-- /.Contenido Variable - Todo lo demas es fijo -->
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Modal de advertencia de cambios -->
      <div class="modal fade" id="cambiosModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Advertencia</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
              Seleccione "Guardar cambios" a continuación si está seguro de continuar con la operación.<br>
              <b>Este cambio se hace de manera inmediata y puede ser revertido.</b>
              <input type="hidden" id="codigo">
              <input type="hidden" id="elemento">
              <input type="hidden" id="estado">
              <input type="hidden" id="id_alumno">
            </div>
            <div class="modal-footer">
              <label><button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button></label>
              <label><a id="ejecutarCambioSolicitudA" class="btn btn-primary text-white">Guardar cambios</a></label>
            </div>
          </div>
        </div>
      </div>

      <!-- /.Modal de advertencia de cambios -->

      <!-- Footer -->
      <?php require '../front/general/footer.php'; ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <?php require_once '../front/general/modal-logout.php'; ?>
  <!-- End of Logout Modal-->
  <!-- Edit Admin Self Modal-->
  <?php require '../front/general/modal-admin-edit-pass-self.php'; ?>
  <!-- End of Edit Admin Self Modal-->

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages / carga automaticamente dashboard.php-->
  <script src="../js/sb-admin-2.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/datatables-demo.js"></script>
  <script src="../js/front/table.js"></script>
  <script src="../scripts/editAdminPassSelf.js"></script>

  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/jquery.dataTables.responsive.min.js"></script>
  <script src="../vendor/datatables/dataTables.fixedHeader.min.js"></script>

  <script>
    // ---------------------- Sin conflictos con lightbox
    $(window).on("load", function() {
      $("#btnEditarSelf").on("click", function(e) {
        e.preventDefault();

        $("#editarAdminSelfModal").modal("toggle");
      });
      $("#btnEditarBoth").on("click", function(e) {
        e.preventDefault();

        $("#editarAlumnoBothModal").modal("toggle");
      });
      $("#btnEditarBoth2").on("click", function(e) {
        e.preventDefault();

        $("#editarAlumnoBothModal").modal("toggle");
      });
      $("#btnEditarBoth3").on("click", function(e) {
        e.preventDefault();

        $("#editarAlumnoBothModal").modal("toggle");
      });
    });
    // ---------------------- /.Sin conflictos con lightbox
  </script>

  <script>
    $(document).ready(function() {

      var dts = $('#dataSolicitudes').DataTable({

        "ajax": {
          "method": "POST",
          "url": "../back/admin/tablaUtilidades/tabla_solicitudes.php"

        },
        rowId: 'id_solicitud',

        responsive: {
          details: {
            type: 'column',
            target: 'tr',
            renderer: function(api, rowIdx, columns) {
              var data = $.map(columns, function(col, i) {
                if (col.hidden) {
                 return '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
                  '<td>' + col.title + ':' + '</td> ' +
                  '<td>' + col.data + '</td>' +
                  '</tr>'

                } else {
                  return '';
                }
              }).join('');

              return data ?
                $('<table/>').append(data) :
                false;
            }
          }
        },
        "columns": [{
            "class": "control",
            "orderable": false,
            "data": null,
            "defaultContent": ""
          },
          {
            "data": "cedula"
          },
          {
            "data": "nombre"
          },
          {
            "data": "fechaCreacion"
          },
          {
            "data": "estadoSolicitud"
          },
          {
            "data": "fechaAtencion",
            className: 'none'
          },
          {
            "data": "nombre_solicitud",
            className: 'none'
          },
          {
            "data": "carreraNombre"
          },
          {
            "data": "turno",
          },
          {
            "data": "personalAtencion",
            className: 'none'
          },
          {
            "data": "irCheck",
            className: 'none'
          },
          {
            "data": "irPerfil",
            className: 'none'
          }
        ],
        "order": [
          [1, 'asc']
        ],
        "language": {
         "decimal": "",
         "emptyTable": "No hay información",
         "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
         "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
         "infoFiltered": "(Filtrado de _MAX_ total entradas)",
         "infoPostFix": "",
         "thousands": ",",
         "lengthMenu": "Mostrar _MENU_",
         "loadingRecords": "Cargando...",
         "processing": "Procesando...",
         "search": "Buscar:",
         "zeroRecords": "Sin resultados encontrados",
         "paginate": {
           "first": "Primero",
           "last": "Ultimo",
           "next": "Siguiente",
           "previous": "Anterior"
         }
       },
       "lengthMenu": [[8, 16, 30, 50, 100], [8, 16, 30, 50, 100]]
      });

      var detailRows = [];

      $('#dataSolicitudes tbody').on('click', 'tr td.control', function() {
        var tr = $(this).closest('tr');
        var row = dts.row(tr);
        var idx = $.inArray(tr.attr('id'), detailRows);

        if (row.child.isShown()) {

          // Remove from the 'open' array
          detailRows.splice(idx, 1);
        } else {
          //console.log(detailRows);

          // Add to the 'open' array
          if (idx === -1) {
            detailRows.push(tr.attr('id'));
          }
        }
      });

      // On each draw, loop over the `detailRows` array and show any child rows
      dts.on('draw', function() {
        $.each(detailRows, function(i, id) {
          //console.log(detailRows);

          $('#' + id + ' td.details-control').trigger('click');
        });
      });




      $(document).on('click', 'a[data-role=update]', function() {
        var codigoCarrera = $(this).attr('data-id'); // data-id (row['codigo']) codigo de la carrera
        var idElemento = $(this).attr('id'); // id (estatus, manana,tarde,noche)
        var estadoElemento = $(this).attr('data-active');
        var id_alumno = $(this).attr('data-prueba') // data-active (row['idemento']) activo o no

        $('#codigo').val(codigoCarrera);
        $('#elemento').val(idElemento);
        $('#estado').val(estadoElemento);
        $('#id_alumno').val(id_alumno);

        $('#cambiosModal').modal('toggle');
      });

      $('#ejecutarCambioSolicitudA').on('click', ejecutarAjaxSolicitudA);


      function ejecutarAjaxSolicitudA(event) {
        var codigo = $('#codigo').val();
        var elemento = $('#elemento').val();
        var estado = $('#estado').val();
        var id_alumno = $('#id_alumno').val();

        var personalAtencion = $('span[id=usernameActual]').text();

        var datosEnviadosS = {
          'codigo': codigo,
          'elemento': elemento,
          'estado': estado,
          'id_alumno': id_alumno,
          'personalAtencion': personalAtencion
        };

        $.ajax({
            type: 'POST',
            url: '../back/admin/backSolicitudAlumno.php',
            data: datosEnviadosS
          })
          .done(function(dataS) {

            dts.ajax.reload(null, false);
            $('#cambiosModal').modal('toggle');
          })
          .fail(function(err) {
            //console.log(err);
          });

        event.preventDefault();
      };

    });
  </script>
</body>

</html>