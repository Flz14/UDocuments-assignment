<!DOCTYPE html>
<html lang="es">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> Datos del alumno </title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="img/images/favicon.ico" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="css/font.css" rel="stylesheet">

  <!-- Custom styles for this template-->

  <link href="css/sb-admin-2.css" rel="stylesheet">
  <link href="css/dash.css" rel="stylesheet">

  <link href="css/style.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php require 'front/general/sidebar.php';?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php require 'front/general/navbar.php';?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <!-- Contenido Variable - Todo lo demas es fijo -->
        <div id="page-student-datos" class="container-fluid">

          <!-- Título de página -->
          <div class="d-sm-flex col-sm-12 col-xl-10 align-items-center justify-content-between mb-4 mx-auto">
            <h1 class="h3 mb-0 text-gray-800">Datos del alumno<br><small class="text-muted"> asegúrese de rellenar
                correctamente sus datos</small></h1>
            <a class="d-none d-sm-inline-block"><i class="fas fa-user-edit fa-2x text-gray-300"></i></a>
          </div>
          <!-- /.Título de página -->

          <!-- Formulario Datos -->
          <div class="col-sm-12 col-xl-10 mx-auto">
            <div class="card shadow mb-4">
              <div class="card-body">
                <div class="px-4 py-2">
                  <form id="datosForm" method="POST" class="user needs-validation" novalidate>
                  <div class="alert alert-success" role="alert" id="exito" style="display: none"></div>

                    <div class="form-group row">
                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Estado civil</small></label><br>
                        <select id="estado_civil" name="estado_civil" class="form-control" required>
                          <option disabled selected value="">Estado civil</option>
                          <option value="1">Casado</option>
                          <option value="2">Soltero</option>
                          <option value="3">Divorciado</option>
                          <option value="4">Viudo</option>
                        </select>

                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Fecha nacimiento</small></label><br>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento"
                          class="form-control" placeholder="Fecha nacimiento"
                          min="<?php echo date('Y-m-d', strtotime('-150 year')) ?>"
                          max="<?php echo date('Y-m-d', strtotime('-10 year')) ?>" required>
                        <div class="invalid-feedback">
                          Por favor introduzca un fecha de nacimiento válido.
                        </div>
                      </div>

                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Discapacidad</small></label><br>
                        <select id="discapacidad" name="discapacidad" class="form-control" required>
                          <option value="1">No</option>
                          <option value="2">Sí</option>
                        </select>
                        <div class="invalid-feedback">
                          Por favor introduzca una opción.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-3" id="tipo_disc" name="tipo_disc">
                        <label class="pl-2"><small>Tipo de discapacidad</small></label><br>
                        <input type='text' id='tipo_discapacidad' name='tipo_discapacidad' class='form-control form-control-user'
                          placeholder='Tipo discapacidad' minlength='4' disabled>
                        <div class='invalid-feedback'>
                          Por favor introduzca un Tipo de discapacidad válida.
                        </div>
                      </div>

                    </div>

                    <div class="form-group row">
                      <div class="col-sm-12 col-md-6 col-lg-4">
                        <label class="pl-2"><small>Teléfono de habitación</small></label><br>
                        <input type="number" id="habitacion" name="habitacion" class="form-control"
                          placeholder="Teléfono de habitación" min="2400000000" pattern="\d*.{11,13}">
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 11 cifras.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-4">
                        <label class="pl-2"><small>Teléfono móvil</small></label><br>
                        <input type="number" id="movil" name="movil" class="form-control"
                          placeholder="Teléfono móvil" min="4100000000" pattern="\d*.{11,13}" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 11 cifras.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-12 col-lg-4">
                        <label class="pl-2"><small>Teléfono de trabajo</small></label><br>
                        <input type="number" id="trabajo" name="trabajo" class="form-control"
                          placeholder="Teléfono de trabajo" min="2400000000" pattern="\d*.{11,13}">
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 11 cifras.
                        </div>
                      </div>

                    </div>

                    <br>
                    <div class="text-center">
                      <h5 class="text-gray-900 mb-4">Lugar de nacimiento(*)</h5>
                    </div>
                    <hr class="sidebar-divider">
                    <div class="form-group row">
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>País</small></label><br>
                        <input type="text" id="pais" name="pais" class="form-control form-control-user"
                          placeholder="País" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Estado</small></label><br>
                        <input type="text" id="estado" name="estado" class="form-control form-control-user"
                          placeholder="Estado" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Ciudad</small></label><br>
                        <input type="text" id="ciudad" name="ciudad" class="form-control form-control-user"
                          placeholder="Ciudad" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Municipio</small></label><br>
                        <input type="text" id="municipio" name="municipio" class="form-control form-control-user"
                          placeholder="Municipio" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                    </div>


                    <br>
                    <div class="text-center">
                      <h5 class="text-gray-900 mb-4">Dirección de habitación(*)</h5>
                    </div>
                    <hr class="sidebar-divider">
                    <div class="form-group row">
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Zona postal</small></label><br>
                        <input type="text" id="nac_postal" name="nac_postal" class="form-control form-control-user"
                          placeholder="Zona postal" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Estado</small></label><br>
                        <input type="text" id="nac_estado" name="nac_estado" class="form-control form-control-user"
                          placeholder="Estado" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Ciudad</small></label><br>
                        <input type="text" id="nac_ciudad" name="nac_ciudad" class="form-control form-control-user"
                          placeholder="Ciudad" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Municipio</small></label><br>
                        <input type="text" id="nac_municipio" name="nac_municipio"
                          class="form-control form-control-user" placeholder="Municipio" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-12 col-md-6 col-lg-4">
                        <label class="pl-2"><small>Urbanización</small></label><br>
                        <input type="text" id="nac_urbanizacion" name="nac_urbanizacion"
                          class="form-control form-control-user" placeholder="Urbanización" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-4">
                        <label class="pl-2"><small>Casa o Apartamento</small></label><br>
                        <input type="text" id="nac_aptcasa" name="nac_aptcasa" class="form-control form-control-user"
                          placeholder="Casa o Apartamento" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-12 col-lg-4">
                        <label class="pl-2"><small>Calle</small></label><br>
                        <input type="text" id="nac_calle" name="nac_calle" class="form-control form-control-user"
                          placeholder="Calle" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                    </div>
                    <br>
                    <div class="text-center">
                      <h5 class="text-gray-900 mb-4">Dirección de trabajo</h5>
                    </div>
                    <hr class="sidebar-divider">
                    <div class="form-group row">
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Zona postal</small></label><br>
                        <input type="text" id="t_postal" name="t_postal" class="form-control form-control-user"
                          placeholder="Zona postal" minlength="4">
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Estado</small></label><br>
                        <input type="text" id="t_estado" name="t_estado" class="form-control form-control-user"
                          placeholder="Estado" minlength="4">
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Ciudad</small></label><br>
                        <input type="text" id="t_ciudad" name="t_ciudad" class="form-control form-control-user"
                          placeholder="Ciudad" minlength="4">
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                        <label class="pl-2"><small>Municipio</small></label><br>
                        <input type="text" id="t_municipio" name="t_municipio" class="form-control form-control-user"
                          placeholder="Municipio" minlength="4">
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                    </div>


                    <br>
                    <div class="text-center">
                      <h5 class="text-gray-900 mb-4">Contacto en caso de emergencia(*)</h5>
                    </div>
                    <hr class="sidebar-divider">


                    <div class="form-group row">
                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Nombre y apellido</small></label><br>
                        <input type="text" id="e_nombre" name="e_nombre" class="form-control form-control-user"
                          placeholder="Nombre y apellido" minlength="8" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 8 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Parentesco</small></label><br>
                        <input type="text" id="parentesco" name="parentesco" minlength="3" class="form-control form-control-user"
                          placeholder="Parentesco" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 3 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Teléfono local</small></label><br>
                        <input type="number" id="e_local" name="e_local" class="form-control"
                          placeholder="Teléfono local" min="2400000000" pattern="\d*.{11,13}">
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 11 cifras.
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Teléfono móvil</small></label><br>
                        <input type="number" id="e_movil" name="e_movil" class="form-control"
                          placeholder="Teléfono móvil" min="4100000000" pattern="\d*.{11,13}" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 11 cifras.
                        </div>
                      </div>
                    </div>


                    <br>
                    <div class="text-center">
                      <h5 class="text-gray-900 mb-4">Datos título de bachiller(*)</h5>
                    </div>
                    <hr class="sidebar-divider">

                    <div class="form-group row">
                      <div class="col">
                        <label class="pl-2"><small>Nombre de la institución (no abreviar)</small></label><br>
                        <input type="text" id="i_nombre" name="i_nombre" class="form-control form-control-user"
                          placeholder="Nombre de la institución (no abreviar)" minlength="11" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 11 caracteres.
                        </div>
                      </div>

                    </div>

                    <div class="form-group row">
                      <div class="col-sm-6 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Año de egreso</small></label><br>
                        <input type="number" id="i_egreso" name="i_egreso" class="form-control"
                          placeholder="Año de egreso" min="1930" pattern="\d*.{4,4}" max="<?php echo date('Y') ?>" required>
                        <div class="invalid-feedback">
                          Este campo debe tener solo 4 cifras.
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Código de la institución</small></label><br>
                        <input type="text" id="i_codigo" name="i_codigo" class="form-control form-control-user"
                          placeholder="Código de la institución" minlength="6" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 6 caracteres.
                        </div>
                      </div>
                      
                      <div class="col-sm-6 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Municipio</small></label><br>
                        <input type="text" id="i_estado" name="i_estado" class="form-control form-control-user"
                          placeholder="Estado" minlength="4" required>
                        <div class="invalid-feedback">
                          Este campo debe tener al menos 4 caracteres.
                        </div>
                      </div>
                      <div class="col-sm-6 col-md-6 col-lg-3">
                        <label class="pl-2"><small>Tipo de institución</small></label><br>
                        <select id="tipo_inst" name="tipo_inst" class="form-control" required>
                          <option disabled selected value="">Tipo de institución</option>
                          <option value="1">Privada</option>
                          <option value="2">Pública</option>
                        </select>
                        <div class="invalid-feedback">
                          Por favor seleccione una opción.
                        </div>
                      </div>
                    </div>

                    <div class="alert alert-danger" role="alert" id="resultado" style="display: none"></div>
                    <!-- </div> No dejar div regados :( -->
                    <br>

                    <button id="enviarDat" type="submit" class="btn btn-primary btn-user btn-block">
                      Guardar
                    </button>
                    
                    <?php if (isset($_GET['ci'])) {?>
                      <input id="cedula " name="cedula " value="<?php echo $_GET['ci'] ?>" hidden >
                    <?php }?>

                    <?php if (isset($_GET['ida'])) {?>
                      <input id="id" name="id" value="<?php echo $_GET['ida'] ?>" hidden >
                    <?php }?>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- /.Formulario Datos -->

        </div>
        <!-- /.Contenido Variable - Todo lo demas es fijo -->
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php require 'front/general/footer.php';?>
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
  <?php require 'front/general/modal-logout.php';?>
  <!-- End of Logout Modal-->

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages / carga automaticamente dashboard.php-->
  <script src="js/sb-admin-2.js"></script>

  <!-- Page level custom scripts -->
  <script src="scripts/datos.js"></script>

  <script>
    $(document).ready(function () {
      $("#discapacidad").change(function () {
        var selectedOpt = $(this).val();
        if (selectedOpt == 2) {
          $("#tipo_discapacidad").removeAttr('disabled');
          $("#tipo_discapacidad").attr('required','true');
        } else {
          $("#tipo_discapacidad").attr('disabled','true');
          $("#tipo_discapacidad").removeAttr('required');
        };
      });
    });
  </script>

</body>

</html>