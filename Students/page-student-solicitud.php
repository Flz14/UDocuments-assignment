<!DOCTYPE html>
<html lang="es">

<head>
 

  <title> Solicitud de ingreso </title>
  <?php require '../Layouts/HeaderLinks.php'; ?>


</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require '../front/general/sidebar.php'; ?>
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
        <div id="page-student-solicitud" class="container-fluid">

         <!-- Título de página -->
          <div class="d-sm-flex col-sm-12 col-md-10 col-lg-8 align-items-center justify-content-between mb-4 mx-auto">
            <h1 class="h3 mb-0 text-gray-800">Solicitud de ingreso</h1>
            <a class="d-none d-sm-inline-block"><i class="fas fa-vote-yea fa-2x text-gray-300"></i></a>
          </div>
          <!-- /.Título de página -->

          <!-- Formulario Solicitudes -->
          <div class="col-sm-12 col-md-10 col-lg-8 mx-auto">
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="p-4">
                  <form id="solicitudForm" method="POST" class="user needs-validation" novalidate>
                  <div class="alert alert-success" role="alert" id="exito" style="display: none;"></div>
                    <div class="form-group row">
                      <div class="col-sm-6 my-auto">
                         <label class="pl-2"><small>Carrera</small></label><br>
                        <select id="carrera" name="carrera" class="form-control" required>
                          <option disabled selected value="">Carrera</option>
                          <?php 
                            include '../back/conexion.php';

                            $sql = "SELECT * FROM carreras WHERE estatus=1";
                            $result = mysqli_query($conexion, $sql);
                            $resultArray = array();
                            $i=1;
                            if ($result->num_rows > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                              echo "<option data-id=".$i." value=". $row["codigo"] .">".$row["nombre"]."</option>";
                              $resultArray[]=array("codigo"=>$row["codigo"],"nombre"=>$row["nombre"],"manana"=>$row["manana"],"tarde"=>$row["tarde"],"noche"=>$row["noche"]);
                              $i++;
                              };                            
                            };
                          ?>
                        </select>
                        <div class="invalid-feedback">
                          Por favor seleccione una opción.
                        </div>
                      </div>
                      <div class="col-sm-6 my-auto">
                         <label class="pl-2"><small>Turno</small></label><br>
                        <select id="turno" name="turno" class="form-control" required>
                          <option disabled="disabled" selected value="">Seleccionar turno</option>

                        </select>
                        <div class="invalid-feedback">
                          Por favor seleccione una opción.
                        </div>
                      </div>



                    </div>

                    <div class="form-group row">
                      <div class="col my-auto">
                         <label class="pl-2"><small>Método de ingreso</small></label><br>
                        <select id="nombre_solicitud" name="nombre_solicitud" class="form-control" required>
                          <option disabled selected value="">Método de ingreso</option>
                          <?php 
                            $sql2 = "SELECT * FROM tipo_solicitud WHERE activa=1";
                            $result2 = mysqli_query($conexion, $sql2);

                            if ($result2->num_rows > 0) {                
                              while ($row2 = mysqli_fetch_assoc($result2)) {
                            ?>
                                <option value="<?= $row2['tipo']; ?>"> <?= $row2['nombre_solicitud']; ?></option>

                          <?php
                              };
                            
                            };
                          ?>
                        </select>
                        <div class="invalid-feedback">
                          Por favor seleccione una opción.
                        </div>
                      </div>
                    </div>

                    <div class="alert alert-danger" role="alert" id="resultado" style="display: none;">
                    </div>
                    <br>

                    <button id="enviarSol" type="submit" class="btn btn-primary btn-user btn-block">
                      Guardar
                    </button>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.Formulario Solicitudes -->

        </div>
        <!-- /.Contenido Variable - Todo lo demas es fijo -->
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

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
  <?php require '../front/general/modal-logout.php'; ?>
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
  <?php if($rol>0){ ?>
  <script src="../scripts/editAdminPassSelf.js"></script>
  <script>
// ---------------------- Sin conflictos con lightbox
$(window).on("load", function () {
    $("#btnEditarSelf").on("click", function (e) {
        e.preventDefault();
        
        $("#editarAdminSelfModal").modal("toggle");
    });
  });
  </script>
  <?php }; ?>
  <?php if($rol == 0){ ?>
  <script src="../scripts/editAlumnoPassSelf.js"></script>
  <?php }; ?>

  <script>
// ---------------------- Sin conflictos con lightbox
$(window).on("load", function () {
    $("#btnEditarBoth").on("click", function (e) {
        e.preventDefault();
        
        $("#editarAlumnoBothModal").modal("toggle");
    });
    $("#btnEditarBoth2").on("click", function (e) {
        e.preventDefault();
        
        $("#editarAlumnoBothModal").modal("toggle");
    });
    $("#btnEditarBoth3").on("click", function (e) {
        e.preventDefault();
        
        $("#editarAlumnoBothModal").modal("toggle");
    });
});
// ---------------------- /.Sin conflictos con lightbox
</script>

  <script>
    $(document).ready(function () {

      var carreras = <?php echo json_encode($resultArray) ?> ;

      $("#carrera").change(function () {

        var codigo = $("#carrera option:selected").attr('data-id');        
        var nuevasopciones = "";

        if (carreras[codigo - 1]["manana"] == 1) {
          nuevasopciones += "<option value='1'>Mañana</option>";
        }
        if (carreras[codigo - 1]["tarde"] == 1) {
          nuevasopciones += "<option value='2'>Tarde</option>";
        }
        if (carreras[codigo - 1]["noche"] == 1) {
          nuevasopciones += "<option value='3'>Noche</option>";
        }

        $("select#turno").html(nuevasopciones);
      });
    });
  </script>
<script src="../scripts/estudianteSolicitud.js"> </script>
</body>

</html>