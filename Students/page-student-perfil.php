<!DOCTYPE html>
<html lang="es">

<head>

  

  <title> Perfil del alumno </title>

  <?php require '../Layouts/HeaderLinks.php'; ?>

  <link rel="stylesheet" href="css/lightbox.css">
  <link href="css/check.css" rel="stylesheet">

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

        <div id="page-student-perfil" class="container-fluid">

          <?php

          include '../back/conexion.php';

          // ------------ Obtener la id del alumno dependiendo la sesion
          if (isset($_GET['ida'])) {
            $ida = $_GET['ida'];
            
          } elseif (isset($_SESSION['id'])) {
            $ida = $_SESSION['id'];
            $ci = $_SESSION['cedula'];
          };
          // ------------ /.Obtener la id del alumno dependiendo la sesion

          $sql = "SELECT *, alumnos.cedula AS ci, 
        concat(concat(p_nombre,' '), s_nombre) as nombres, concat(concat(p_apellido,' '), s_apellido) as apellidos, 
        documentos.cedula AS cedula, carreras.nombre AS carrera
        FROM alumnos
        INNER JOIN documentos ON alumnos.documento=documentos.id_documento
        LEFT JOIN telefonos ON alumnos.id_alumno=telefonos.alumno
        LEFT JOIN direcciones ON alumnos.id_alumno=direcciones.alumno
        LEFT JOIN tipo_solicitud ON alumnos.metodo_ingreso=tipo_solicitud.tipo
        LEFT JOIN carreras ON alumnos.carrera=carreras.codigo

        WHERE alumnos.id_alumno = '$ida'";

          $result = mysqli_query($conexion, $sql);
          if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
          } else {
            $mensaje = "Ocurrió un error al cargar el perfil";
            echo ($mensaje);
          };

          switch ($row['estado_civil']) {
            case 1:
              $estado_civil = 'Casado';
              break;
            case 2:
              $estado_civil = 'Soltero';
              break;
            case 3:
              $estado_civil = 'Divorciado';
              break;
            case 4:
              $estado_civil = 'Viudo';
              break;
            default:
              $estado_civil = '';
              break;
          };

          // -------- Porcentaje de Documentos

          $porcentaje = $row['porcentaje'];          

          // **** Para pie-chart
          $array_pendientes = [];
          $porcentajeFaltante = 100 - $porcentaje;
          array_push($array_pendientes, $porcentaje);
          array_push($array_pendientes, $porcentajeFaltante);
          // **** /.Para pie-chart

          // -------- /.Porcentaje de Documentos

          switch ($row['turno']) {
            case 1:
              $turno = 'Mañana';
              break;
            case 2:
              $turno = 'Tarde';
              break;
            case 3:
              $turno = 'Noche';
              break;
            default:
              $turno = '';
              break;
          };

          switch ($row['tipoInst']) {
            case 1:
              $tipoInst = 'Privada';
              break;
            case 2:
              $tipoInst = 'Pública';
              break;
            default:
              $tipoInst = '';
              break;
          };

          $path_image = '../back/documentos/'; // ruta raiz de los Documentos
          $idd = $row['id_documento']; // para hacer las consultas de cada tipo de Documento

          ?>

          <!-- Título de página -->
          <div class="d-flex col-sm-12 col-md-12 col-lg-12 col-xl-10 align-items-center justify-content-between mb-4 mx-auto">
            <h1 class="h3 mb-0 text-gray-800">Perfil del alumno</h1>
            <!-- Boton para el alumno (Imprimir perfil) -->
            <?php if ($rol == 0) { ?>
            <a id="btnImprimirConstancia2" class="d-sm-inline-block btn btn-sm btn-primary text-white shadow-sm">
              <i class="fas fa-download fa-sm"></i>
              Imprimir constancia
            </a>
            <?php }; ?>
            <!-- /.Boton para el alumno (Imprimir perfil) -->
            <!-- Boton para el admin (Ir a Validaciones) -->
            <?php if ($rol >= 1) { ?>
            <a href="<?= 'page-admin-check.php?idd=' . $idd . '&ida=' . $ida . '&ci=' . $row['ci'] . '&mi=' . $row['metodo_ingreso'] ?>"
              class="d-sm-inline-block btn btn-sm btn-primary text-white shadow-sm">
              <i class="fas fa-clipboard-list fa-sm"></i>
              Ir a validaciones
            </a>
            <?php }; ?>
            <!-- /.Boton para el admin (Ir a Validaciones) -->
          </div>
          <!-- /.Título de página -->

          <!-- Perfil alumno (Resumen/Chart) -->
          <div class="col-sm-12 col-md-12 col-lg-12 col-xl-10 px-2 mx-auto mb-2">

            <div class="row mb-3">

              <div class="col-sm-12 col-md-6 mb-4">
                <!-- Pie Chart -->
                <div id="pie-chart">
                  <div class="card shadow">

                    <!-- Card Body -->
                    <div class="card-body">
                      <div class="chart-pie p-2">
                        <canvas id="myPieChart"></canvas>
                      </div>
                      <div class="mt-4 text-center small">
                        <span class="mr-2 font-weight-bolder">
                          Documentos
                        </span>
                        <br>
                        <span class="mr-2">
                          <i class="fas fa-circle text-success"></i> Validados
                        </span>

                        <span class="mr-2">
                          <i class="fas fa-circle text-danger"></i> Pendientes
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-sm-12 col-md-6 align-self-center text-sm-center mb-4">
<div class="px-2">
                <div class="flex-fill my-auto py-1">

                  <div class="text-gray-900">
                    <h6 class="font-weight-bolder"><i class="fas fa-user"></i>
                      <?= $row['p_nombre'].' '.$row['s_nombre'].' '.$row['p_apellido'].' '.$row['s_apellido'].'' ?></h6>

                  </div>
                </div>
                <div class="flex-fill my-auto py-1">

                  <div class="text-gray-900">
                    <h6 class="font-weight-bolder"><i class="fas fa-address-card"></i>
                       <?= $row['ci'] ?>
                    </h6>
                  </div>

                </div>
                <div class="flex-fill my-auto py-1">

                  <div class="text-gray-900">
                    <h6 class="font-weight-bolder"><i class="fas fa-envelope"></i> <?= $row['correo'] ?></h6>

                  </div>
                </div>
                <div class="flex-fill my-auto py-1">

                  <div class="text-gray-900">
                    <h6 class="font-weight-bolder"><i class="fas fa-mobile-alt"></i> Numeros de contacto</h6>
                    <?= ($row['num_habitacion']==0) ? '': '<b><small>Local:</small></b> '.$row['num_habitacion'].'<br>' ?>
                    <?= ($row['num_movil']==0) ? '': '<b><small>Movil:</small></b> '.$row['num_movil'].'<br>' ?>
                    <?= ($row['num_trabajo']==0) ? '': '<b><small>Trabajo:</small></b> '.$row['num_trabajo'] ?>
                  </div>
                </div>
                <div class="flex-fill my-auto py-1">

                  <div class="text-gray-900">
                    <h6 class="font-weight-bolder"><i class="fas fa-map-marker-alt"></i>
                      <?= $row['estado'].' '.$row['ciudad'].' '.$row['municipio'].' '.$row['urbanizacion'].' '.$row['aptcasa'].' '.$row['calle'] ?></h6>

                  </div>
                </div>
                <div class="flex-fill my-auto py-1">

                  <div class="text-gray-900">
                    <h6 class="font-weight-bolder"><i class="fas fa-graduation-cap"></i> <?= $row['nombre'] ?></h6>
                    <b><small>Turno:</small></b> <?= $turno ?><br>
                    <b><small>Método de ingreso:</small></b> <?= $row['nombre_solicitud'] ?>
                  </div>
                </div>

              </div>
              </div>

            </div>
          </div>
<!-- /.Perfil alumno (Resumen/Chart) -->
          <!-- Perfil alumno -->
          <div id="imprimirPerfil" class="col-sm-12 col-md-12 col-lg-12 col-xl-10 px-2 mx-auto">

            <ul class="nav nav-tabs nav-justified" role="tablist">
              <li class="nav-item">
                <a class="nav-link font-weight-bolder" href="#informacionAlumno" role="tab"
                  data-toggle="tab">Información</a>
              </li>
              <li class="nav-item">
                <a class="nav-link font-weight-bolder active" href="#documentosAlumno" role="tab"
                  data-toggle="tab">Documentos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link font-weight-bolder" href="#solicitudAlumno" role="tab"
                  data-toggle="tab">Solicitud</a>
              </li>
              <li class="nav-item">
                <a class="nav-link font-weight-bolder" href="#constanciaAlumno" role="tab"
                  data-toggle="tab">Constancia</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade" id="informacionAlumno">
                <!-- Header Status de Datos -->
                <div class="card">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center px-2">
                      <div class="col pr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Información del alumno
                        </div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 pr-3 font-weight-bold text-gray-800">Ultima actualización: </div>
                          </div>
                          <div class="col">
                            <?= $row['ultActualizacion'] ?>
                          </div>
                        </div>
                      </div>
                      <?php if ($rol == 0) { ?>
                      <div class="col-auto">
                        <a href="page-student-edit-datos.php" data-toggle="tooltip" data-placement="top"
                          title="Editar información">
                          <i class="fas fa-user-edit fa-2x text-gray-300"></i>
                        </a>
                      </div>
                      <?php }; ?>
                      <?php if ($rol >= 1) { ?>
                      <div class="col-auto">
                        <a href="<?= 'page-admin-student-edit-datos.php?idd=' . $idd . '&ida=' . $ida . '&ci=' . $row['ci'] ?>"
                          data-toggle="tooltip" data-placement="top" title="Editar información">
                          <i class="fas fa-user-edit fa-2x text-gray-300"></i>
                        </a>
                      </div>
                      <?php }; ?>
                    </div>
                  </div>
                </div>
                <!-- /Header Status de Datos -->

                <!-- Tabla de Status de Datos -->
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="px-3">

                      <div class="form-group row">

                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">

                          <label class="pl-2 pt-1"><small>Nombres</small></label>
                          <input type="text" value="<?= $row['nombres'] ?>" class="form-control informacion" disabled>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                          <label class="pl-2 pt-1"><small>Apellidos</small></label><br>
                          <input type="text" value="<?= $row['apellidos'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                          <label class="pl-2 pt-1"><small>Cédula</small></label><br>
                          <input type="text" value="<?= $row['ci'] ?>" class="form-control informacion" disabled>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-3 col-xl-3">
                          <label class="pl-2 pt-1"><small>Correo</small></label><br>
                          <input type="text" value="<?= $row['correo'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Nombre de usuario</small></label><br>
                          <input type="text" value="<?= $row['username'] ?>" class="form-control informacion" disabled>
                        </div>

                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Estado civil</small></label><br>
                          <input type="text" value="<?= $estado_civil ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Fecha de nacimiento</small></label><br>
                          <input type="text" value="<?= $row['fecha_nacimiento'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Discapacidad</small></label><br>
                          <input type="text" value="<?= $row['discapacidad'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                          <label class="pl-2 pt-1"><small>Teléfono habitación</small></label><br>
                          <input type="text" value="<?= ($row['num_habitacion']==0) ? '': $row['num_habitacion'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                          <label class="pl-2 pt-1"><small>Teléfono móvil</small></label><br>
                          <input type="text" value="<?= ($row['num_movil']==0) ? '': $row['num_movil'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                          <label class="pl-2 pt-1"><small>Teléfono trabajo</small></label><br>
                          <input type="text" value="<?= ($row['num_trabajo']==0) ? '': $row['num_trabajo'] ?>" class="form-control informacion" disabled>
                        </div>

                      </div>


                      
                      <div class="text-center">
                        <h5 class="text-gray-900 mt-2">Lugar de nacimiento</h5>
                      </div>
                      <hr class="sidebar-divider">

                      <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>País</small></label><br>
                          <input type="text" value="<?= $row['pais_nac'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Estado</small></label><br>
                          <input type="text" value="<?= $row['estado_nac'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Ciudad</small></label><br>
                          <input type="text" value="<?= $row['ciudad_nac'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Municipio</small></label><br>
                          <input type="text" value="<?= $row['municipio_nac'] ?>" class="form-control informacion" disabled>
                        </div>
                      </div>


                      
                      <div class="text-center">
                        <h5 class="text-gray-900 mt-2">Dirección de habitación</h5>
                      </div>
                      <hr class="sidebar-divider">

                      <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Estado</small></label><br>
                          <input type="text" value="<?= $row['estado'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Ciudad</small></label><br>
                          <input type="text" value="<?= $row['ciudad'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Municipio</small></label><br>
                          <input type="text" value="<?= $row['municipio'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Zona postal</small></label><br>
                          <input type="text" value="<?= $row['postal'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                          <label class="pl-2 pt-1"><small>Urbanización</small></label><br>
                          <input type="text" value="<?= $row['urbanizacion'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-4">
                          <label class="pl-2 pt-1"><small>Apartamento o casa</small></label><br>
                          <input type="text" value="<?= $row['aptcasa'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-4">
                          <label class="pl-2 pt-1"><small>Calle</small></label><br>
                          <input type="text" value="<?= $row['calle'] ?>" class="form-control informacion" disabled>
                        </div>
                      </div>


                      
                      <div class="text-center">
                        <h5 class="text-gray-900 mt-2">Dirección de trabajo</h5>
                      </div>
                      <hr class="sidebar-divider">

                      <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Estado</small></label><br>
                          <input type="text" value="<?= $row['estado_trabajo'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Ciudad</small></label><br>
                          <input type="text" value="<?= $row['ciudad_trabajo'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Municipio</small></label><br>
                          <input type="text" value="<?= $row['municipio_trabajo'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Zona postal</small></label><br>
                          <input type="text" value="<?= $row['postal_trabajo'] ?>" class="form-control informacion" disabled>
                        </div>
                      </div>

                      
                      <div class="text-center">
                        <h5 class="text-gray-900 mt-2">Contacto en caso de emergencia</h5>
                      </div>
                      <hr class="sidebar-divider">

                      <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Nombre y apellido</small></label><br>
                          <input type="text" value="<?= $row['parientename'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Parentesco</small></label><br>
                          <input type="text" value="<?= $row['parentesco'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Teléfono local</small></label><br>
                          <input type="text" value="<?= ($row['num_habitacion_pariente']==0) ? '': $row['num_habitacion_pariente'] ?>" class="form-control"
                            disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-xl-3">
                          <label class="pl-2 pt-1"><small>Teléfono móvil</small></label><br>
                          <input type="text" value="<?= ($row['num_movil_pariente']==0) ? '': $row['num_movil_pariente'] ?>" class="form-control informacion" disabled>
                        </div>
                      </div>

                      
                      <div class="text-center">
                        <h5 class="text-gray-900 mt-2">Datos título de bachiller</h5>
                      </div>
                      <hr class="sidebar-divider">

                      <div class="form-group row">
                        <div class="col-sm-12 col-md-12 col-lg-8">
                          <label class="pl-2 pt-1"><small>Nombre de la institución (no abreviar)</small></label><br>
                          <input type="text" value="<?= $row['nombreInst'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                          <label class="pl-2 pt-1"><small>Año de egreso</small></label><br>
                          <input type="text" value="<?= ($row['anoEgreso']==0) ? '': $row['anoEgreso'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                          <label class="pl-2 pt-1"><small>Código de la institución</small></label><br>
                          <input type="text" value="<?= $row['codigoInst'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                          <label class="pl-2 pt-1"><small>Estado</small></label><br>
                          <input type="text" value="<?= $row['estadoInst'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                          <label class="pl-2 pt-1"><small>Tipo de institución</small></label><br>
                          <input type="text" value="<?= $tipoInst ?>" class="form-control informacion" disabled>
                        </div>
                      </div>

                      
                      <div class="text-center">
                        <h5 class="text-gray-900 mt-2">Carrera</h5>
                      </div>
                      <hr class="sidebar-divider">

                      <div class="form-group row">
                        <div class="col-sm-12 col-md-6 col-lg-4">
                          <label class="pl-2 pt-1"><small>Carrera</small></label><br>
                          <input type="text" value="<?= $row['carrera'] ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                          <label class="pl-2 pt-1"><small>Turno</small></label><br>
                          <input type="text" value="<?= $turno ?>" class="form-control informacion" disabled>
                        </div>
                        <div class="col-sm-12 col-lg-4">
                          <label class="pl-2 pt-1"><small>Método de ingreso</small></label><br>
                          <input type="text" value="<?= $row['nombre_solicitud'] ?>" class="form-control informacion" disabled>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <!-- /Tabla de Status de Datos -->

              </div>
              <div role="tabpanel" class="tab-pane fade show active" id="documentosAlumno">
                <!-- Header Status de Documentos -->

                <div class="card">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center px-2">
                      <div class="col pr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Estatus de Documentos</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                            <div class="h5 mb-0 pr-3 font-weight-bold text-gray-800"><?= $porcentaje ?>%</div>
                          </div>
                          <div class="col">
                            <div class="progress progress-sm mr-2">
                              <div class="progress-bar bg-primary" role="progressbar" style="width: <?= $porcentaje ?>%"
                                aria-valuenow="<?= $porcentaje ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <?php if ($rol == 0) { ?>
                      <div class="col-auto">
                        <a href="page-student-edit-docs.php" data-toggle="tooltip" data-placement="top"
                          title="Editar documentos">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </a>
                      </div>
                      <?php }; ?>
                      <?php if ($rol >= 2) { ?>
                      <div class="col-auto">
                        <a href="<?= 'page-student-edit-docs.php?idd=' . $idd . '&ida=' . $ida . '&ci=' . $row['ci'] . '&mi=' . $row['metodo_ingreso'] ?>"
                          data-toggle="tooltip" data-placement="top" title="Editar documentos">
                          <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </a>
                      </div>
                      <?php }; ?>
                    </div>
                  </div>
                </div>
                <!-- /Header Status de Documentos -->

                <!-- Tabla de Status de Documentos -->
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="px-3 py-2">
                      <!-- Foto -->
                      <div class="form-group row">

                        <div class="col-md-12 text-md-center col-lg-4 text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-2"><i
                                class="fas fa-<?php echo ($row['check_foto'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?> pr-3"></i>
                            </div>
                            <div class="col-10 text-justify">Foto reciente tipo carnet</div>
                          </h5>
                        </div>

                        <div class="text-sm-left col-md-12 text-md-center col-lg-8 text-lg-left my-auto">
                          <div id="preview-images-foto" class="preview-images">

                            <?php
                        if ($row['foto'] != '') {
                          ?>
                            <div class="thumbnail" style="background-image: url('<?= $path_image . $row['foto'] ?>')">
                              <div class="close-button-db">
                                <a href="<?= $path_image . $row['foto'] ?>" data-lightbox="galleryFoto"
                                  data-title="foto">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= $path_image . $row['foto'] ?>"
                                  download="<?php echo ('foto' . $row['ci']) ?>">
                                  <i class="fas fa-download"></i>
                                </a>
                              </div>
                            </div>
                            <?php
                      };
                      ?>

                          </div>
                        </div>

                      </div>
                      <!-- End Foto -->

                      <hr class="sidebar-divider">
                      <br>

                      <!-- Cedula -->
                      <div class="form-group row">

                        <div class="col-md-12 text-md-center col-lg-4 text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-2"><i
                                class="fas fa-<?php echo ($row['check_cedula'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?> pr-3"></i>
                            </div>
                            <div class="col-10 text-justify">Cédula</div>
                          </h5>
                        </div>

                        <div class="text-sm-left col-md-12 text-md-center col-lg-8 text-lg-left my-auto">
                          <div id="preview-images-cedula" class="preview-images">

                            <?php
                        if ($row['cedula'] != '') {
                          ?>
                            <div class="thumbnail" style="background-image: url('<?= $path_image . $row['cedula'] ?>')">
                              <div class="close-button-db">
                                <a href="<?= $path_image . $row['cedula'] ?>" data-lightbox="galleryCedula"
                                  data-title="Cedula">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= $path_image . $row['cedula'] ?>"
                                  download="<?php echo ('cedula' . $row['ci']) ?>">
                                  <i class="fas fa-download"></i>
                                </a>
                              </div>
                            </div>
                            <?php
                      };
                      ?>

                          </div>
                        </div>

                      </div>
                      <!-- End Cedula -->

                      <hr class="sidebar-divider">
                      <br>


                      <!-- Notas -->
                      <div class="form-group row">

                        <div class="col-md-12 text-md-center col-lg-4 text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-2"><i
                                class="fas fa-<?php echo ($row['check_nota'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?> pr-3"></i>
                            </div>
                            <div class="col-10 text-justify">Notas certificadas de bachillerato (1er a 5to)</div>
                          </h5>
                        </div>

                        <div class="text-sm-left col-md-12 text-md-center col-lg-8 text-lg-left my-auto">
                          <div id="preview-images-Notas" class="preview-images">

                            <?php

                        $sql_notas = "SELECT * FROM notas
                                      WHERE documento = '$idd';";

                        $result_notas = mysqli_query($conexion, $sql_notas);

                        if ($result_notas->num_rows > 0) {
                          while ($row_notas = mysqli_fetch_assoc($result_notas)) {
                            ?>
                            <!-- Esto se repite por cada imagen de Notas -->
                            <div class="thumbnail"
                              style="background-image: url('<?= $path_image . $row_notas['nota'] ?>')">
                              <div class="close-button-db">
                                <a href="<?= $path_image . $row_notas['nota'] ?>" data-lightbox="galleryNotas"
                                  data-title="Notas">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= $path_image . $row_notas['nota'] ?>"
                                  download="<?php echo ('notas' . $row['ci']) ?>">
                                  <i class="fas fa-download"></i>
                                </a>
                              </div>
                            </div>
                            <!--  /Esto se repite por cada imagen de Notas -->
                            <?php
                        };
                      };
                      ?>

                          </div>
                        </div>

                      </div>
                      <!-- End Notas -->

                      <hr class="sidebar-divider">
                      <br>

                      <!-- Fondo -->
                      <div class="form-group row">

                        <div class="col-md-12 text-md-center col-lg-4 text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-2"><i
                                class="fas fa-<?php echo ($row['check_fondo'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?> pr-3"></i>
                            </div>
                            <div class="col-10 text-justify">Título de bachillerato autenticado</div>
                          </h5>
                        </div>

                        <div class="text-sm-left col-md-12 text-md-center col-lg-8 text-lg-left my-auto">
                          <div id="preview-images-fondo" class="preview-images">
                            <?php
                        if ($row['fondo'] != '') {
                          ?>
                            <div class="thumbnail" style="background-image: url('<?= $path_image . $row['fondo'] ?>')">
                              <div class="close-button-db">
                                <a href="<?= $path_image . $row['fondo'] ?>" data-lightbox="galleryFondo"
                                  data-title="Fondo">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= $path_image . $row['fondo'] ?>"
                                  download="<?php echo ('fondo' . $row['ci']) ?>">
                                  <i class="fas fa-download"></i>
                                </a>
                              </div>
                            </div>
                            <?php
                      };
                      ?>
                          </div>
                        </div>

                      </div>
                      <!-- End Fondo -->

                      <hr class="sidebar-divider">
                      <br>

                      <!-- Rusnies -->
                      <div class="form-group row">

                        <div class="col-md-12 text-md-center col-lg-4 text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-2"><i
                                class="fas fa-<?php echo ($row['check_rusinies'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?> pr-3"></i>
                            </div>
                            <div class="col-10 text-justify">Resultado del RUSNIES</div>
                          </h5>
                        </div>

                        <div class="text-sm-left col-md-12 text-md-center col-lg-8 text-lg-left my-auto">
                          <div id="preview-images-rusnies" class="preview-images">

                            <?php
                        $sql_rusnies = "SELECT * FROM rusnies
                                        WHERE documento = '$idd';";

                        $result_rusnies = mysqli_query($conexion, $sql_rusnies);
                        if ($result_rusnies->num_rows > 0) {
                          while ($row_rusnies = mysqli_fetch_assoc($result_rusnies)) {
                            ?>
                            <!-- Esto se repite por cada imagen de Rusnies -->
                            <div class="thumbnail"
                              style="background-image: url('<?= $path_image . $row_rusnies['rusnies'] ?>')">
                              <div class="close-button-db">
                                <a href="<?= $path_image . $row_rusnies['rusnies'] ?>" data-lightbox="galleryRusnies"
                                  data-title="Rusnies">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= $path_image . $row_rusnies['rusnies'] ?>"
                                  download="<?php echo ('rusnies' . $row['ci']) ?>">
                                  <i class="fas fa-download"></i>
                                </a>
                              </div>
                            </div>
                            <!--  /Esto se repite por cada imagen de Rusnies -->
                            <?php
                        };
                      };
                      ?>

                          </div>
                        </div>

                      </div>
                      <!-- End rusnies -->

                      <hr class="sidebar-divider">
                      <br>

                      <!-- Partida -->
                      <div class="form-group row">

                        <div class="col-md-12 text-md-center col-lg-4 text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-2"><i
                                class="fas fa-<?php echo ($row['check_partida'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?> pr-3"></i>
                            </div>
                            <div class="col-10 text-justify">Partida de nacimiento</div>
                          </h5>
                        </div>
                        <div class="text-sm-left col-md-12 text-md-center col-lg-8 text-lg-left my-auto">
                          <div id="preview-images-partida" class="preview-images">
                            <?php
                        if ($row['partida'] != '') {
                          ?>
                            <div class="thumbnail"
                              style="background-image: url('<?= $path_image . $row['partida'] ?>')">
                              <div class="close-button-db">
                                <a href="<?= $path_image . $row['partida'] ?>" data-lightbox="galleryPartida"
                                  data-title="Partida">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= $path_image . $row['partida'] ?>"
                                  download="<?php echo ('partida' . $row['ci']) ?>">
                                  <i class="fas fa-download"></i>
                                </a>
                              </div>
                            </div>
                            <?php
                      };
                      ?>
                          </div>
                        </div>

                      </div>
                      <!-- End Partida -->

                      <hr class="sidebar-divider">
                      <br>

                      <!-- Metodo -->
                      <div class="form-group row">

                        <div class="col-md-12 text-md-center col-lg-4 text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-2"><i
                                class="fas fa-<?php echo ($row['check_metodo'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?> pr-3"></i>
                            </div>
                            <div class="col-10 text-justify">Método de ingreso:
                              <small><?= $row['nombre_solicitud'] ?></small>
                            </div>
                          </h5>
                        </div>

                        <div class="text-sm-left col-md-12 text-md-center col-lg-8 text-lg-left my-auto">
                          <div id="preview-images-metodo" class="preview-images">

                            <?php
                        $sql_metodoing = "SELECT * FROM metodoing
                                          WHERE documento = '$idd';";

                        $result_metodoing = mysqli_query($conexion, $sql_metodoing);
                        if ($result_metodoing->num_rows > 0) {
                          while ($row_metodoing = mysqli_fetch_assoc($result_metodoing)) {
                            ?>
                            <!-- Esto se repite por cada imagen de Metodo -->
                            <div class="thumbnail"
                              style="background-image: url('<?= $path_image . $row_metodoing['metodo'] ?>')">
                              <div class="close-button-db">
                                <a href="<?= $path_image . $row_metodoing['metodo'] ?>" data-lightbox="galleryMetodo"
                                  data-title="Metodo">
                                  <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= $path_image . $row_metodoing['metodo'] ?>"
                                  download="<?php echo ('metodo' . $row['ci']) ?>">
                                  <i class="fas fa-download"></i>
                                </a>
                              </div>
                            </div>
                            <!--  /Esto se repite por cada imagen de Metodo -->
                            <?php
                        };
                      };
                      ?>

                          </div>
                        </div>

                      </div>
                      <!-- End Metodo -->

                    </div>
                  </div>
                </div>
                <!-- /Tabla de Status de Documentos -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="solicitudAlumno">
                <!-- Header Status de Solicitudes -->

                <div class="card">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center px-2">
                      <div class="col pr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Solicitudes</div>
                      </div>
                      <?php if ($rol == 0) { ?>
                      <div class="col-auto">
                        <a href="page-student-edit-solicitud.php" data-toggle="tooltip" data-placement="top"
                          title="Editar Solicitud mas reciente">
                          <i class="fas fa-vote-yea fa-2x text-gray-300"></i>
                        </a>
                      </div>
                      <?php }; ?>
                      <?php if ($rol >= 2) { ?>
                      <div class="col-auto">
                        <a href="<?= 'page-admin-student-edit-solicitud.php?idd=' . $idd . '&ida=' . $ida . '&ci=' . $row['ci'] . '&mi=' . $row['metodo_ingreso'] ?>"
                          data-toggle="tooltip" data-placement="top" title="Editar Solicitud mas reciente">
                          <i class="fas fa-vote-yea fa-2x text-gray-300"></i>
                        </a>
                      </div>
                      <?php }; ?>
                    </div>
                  </div>
                </div>
                <!-- /Header Status de Solicitudes -->


                <!-- Tabla de Status de Solicitudes -->
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="px-3 py-2">
                      <!-- Solicitud -->
                      <?php
                  $sql_sol = "SELECT * FROM solicitudes
                  LEFT JOIN tipo_solicitud ON solicitudes.tipo = tipo_solicitud.tipo
                  LEFT JOIN carreras ON solicitudes.carrera = carreras.codigo
                  WHERE alumno = $ida";

                  $result_sol = mysqli_query($conexion, $sql_sol);
                  if ($result_sol->num_rows > 0) {
                    while ($row_sol = mysqli_fetch_assoc($result_sol)) {
                      switch ($row_sol['turno']) {
                        case 1:
                          $turno_sol = 'Mañana';
                          break;
                        case 2:
                          $turno_sol = 'Tarde';
                          break;
                        case 3:
                          $turno_sol = 'Noche';
                          break;
                        default:
                          $turno_sol = '';
                          break;
                      };
                      ?>

                      <div class="form-group d-flex row">

                        <div class="flex-fill text-lg-left my-auto">
                          <h5 class="text-gray-900 row">
                            <div class="col-1 py-1">
                              <i
                                class="fas fa-<?php echo ($row_sol['estadoSolicitud'] == 0) ? 'minus-circle text-secondary' : 'check-circle text-success' ?>">
                              </i>
                            </div>
                            <div class="col-11 py-1"> <?= $row_sol['nombre_solicitud'] ?> </div>
                          </h5>
                        </div>

                        <div class="flex-fill my-auto pl-3 py-1">

                          <div class="text-gray-900">
                            <h6 class="font-weight-bolder">Carrera</h6>
                            <?= $row_sol['nombre'] ?>
                            <br>
                            <b><small>Turno:</small></b> <?= $turno_sol ?>
                          </div>
                        </div>
                        <div class="flex-fill my-auto pl-3 py-1">
                          <div class="text-gray-900">
                            <h6 class="font-weight-bolder">Fechas</h6>
                            <b><small>Creación:</small></b>
                            <?= ($row_sol['fechaCreacion'] == '0000-00-00') ? 'Sin fecha' : $row_sol['fechaCreacion'] ?>
                            <br>
                            <b><small>Aprobación:</small></b>
                            <?= ($row_sol['fechaAtencion'] == '0000-00-00') ? 'Sin fecha' : $row_sol['fechaAtencion'] ?>
                          </div>

                        </div>

                      </div>


                      <hr class="sidebar-divider">
                      <?php
                  };
                };
                ?>
                      <!-- End Solicitud -->

                    </div>
                  </div>
                </div>
                <!-- /Tabla de Status de Solicitudes -->

              </div>
              <div role="tabpanel" class="tab-pane fade" id="constanciaAlumno">
                <!-- Header Status de Constancia -->

                <div class="card">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center px-2">
                      <div class="col pr-2">
                        <div class="text-sm font-weight-bold text-primary text-uppercase mb-1">Constancia del alumno</div>
                      </div>
                      <div class="col-auto">
                        <a id="btnImprimirConstancia" href="#" data-toggle="tooltip" data-placement="top" title="Imprimir constancia">
                          <i class="fas fa-download fa-2x text-gray-300"></i>
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /Header Status de Constancia -->


                <!-- Tabla de Status de Constancia -->
                <div class="card shadow mb-4">
                  <div class="card-body">
                    <div class="px-3 py-5">
                      <!-- Constancia -->
                     <div id="imprimirConstanciaHeader">
                       <div class="row align-items-center">


                       <div class="col-4 text-right">
                        <img src="img/varias/logo_ujap.png" class="img-responsive" height="100px" width="90px" alt="img/varias/logo_ujap.png">
                        
                       </div>


                       <div class="col-8 text-dark font-weight-bolder pl-2">
                            REPÚBLICA BOLIVARIANA DE VENEZUELA<br>
                            UNIVERSIDAD JOSÉ ANTONIO PÁEZ<br>
                            DEPARTAMENTO DE CONTROL DE ESTUDIOS<br>
                       </div>


                     </div>
                      </div>

                     <div id="imprimirConstanciaTitle">
                       <div class="row align-items-center justify-content-center">
                      <div class="text-center text-dark font-weight-bolder p-5 my-5">
                        CONSTANCIA DE ARCHIVO DIGITAL
                      </div>                       
                     </div>
                     </div>

                     <div id="imprimirConstanciaBody">
                       <div class="row align-items-center justify-content-center">
                       <div class="col-9 px-2 pt-2 pb-5 pl-2 ml-5">
                         <div class="flex-fill my-auto">
                           <div class="text-gray-900">
                             <h6 class="text-left">
                               <b>Alumno:</b> <?= $row['p_nombre'].' '.$row['s_nombre'].' '.$row['p_apellido'].' '.$row['s_apellido'].'' ?>
                             </h6>

                           </div>
                         </div>
                         <div class="flex-fill my-auto">
                           <div class="text-gray-900">
                             <h6 class="text-left">
                               <b>Cédula:</b> <?= $row['ci'] ?>
                             </h6>
                           </div>
                         </div>
                         <div class="flex-fill my-auto">
                           <div class="text-gray-900">
                             <h6 class="text-left">
                               <b>Correo:</b> <?= $row['correo'] ?>
                              </h6>
                           </div>
                         </div>
                         <div class="flex-fill my-auto">
                           <div class="text-gray-900">
                             <h6 class="text-left">
                               <b>Dirección:</b> <?= $row['estado'].' '.$row['ciudad'].' '.$row['municipio'].' '.$row['urbanizacion'].' '.$row['aptcasa'].' '.$row['calle'] ?>
                             </h6>
                           </div>
                         </div>

                       </div>

                     <div class="col-9 px-2 pt-2 pb-5 pl-2 ml-5">
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3 font-weight-bolder">
                                  Estado
                                </div>
                                <div class="col-9 text-justify font-weight-bolder">Nombre</div>
                              </h6>
                            </div>
                            <hr class="sidebar-divider">
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_datos'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Datos del alumno</div>
                              </h6>
                            </div>
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                    <?php echo ($row['check_foto'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Foto reciente tipo carnet</div>
                              </h6>
                            </div>
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_cedula'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Cédula</div>
                              </h6>
                            </div>
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_nota'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Notas certificadas de bachillerato (1er a 5to)</div>
                              </h6>
                            </div>
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_fondo'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Título de bachillerato autenticado</div>
                              </h6>
                            </div>
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_rusinies'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Resultado del RUSNIES</div>
                              </h6>
                            </div>
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_partida'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Partida de nacimiento</div>
                              </h6>
                            </div>
                           
                            <?php if($row['codigo']==10){?>

                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_certificado_s'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Certificado de salud
                                </div>
                              </h6>
                            </div>

                            <?php }?>

                            <?php
                            if($row['metodo_ingreso']==4 or $row['metodo_ingreso']==5 ){?>
                            <div class="col-md-12 my-auto">
                              <h6 class="text-gray-900 row">
                                <div class="col-3">
                                  <?php echo ($row['check_metodo'] == 0) ? '<i class="fas fa-minus text-secondary pr-3"></i> Pendiente' : '<i class="fas fa-check text-success pr-3"></i> Validado' ?>
                                </div>
                                <div class="col-9 text-justify">Método de ingreso: <br>
                                  <small> <?= '<b>'.$row['nombre_solicitud'].'</b> | carrera: <b>'.$row['nombre'].'</b> | turno: <b>'.$turno.'</b>' ?></small>
                                </div>
                              </h6>
                            </div>
                            <?php } ?>

                            

                     </div>

                      

                     </div>
                     </div>

                     <div id="imprimirConstanciaFooter">
                       <div class="row align-items-end pb-4 mt-4" style="height: 200px;">
                       <div class="col-4 text-center text-dark pt-5">
                        <div class="pb-4">
                          <div class="text-sm font-weight-bold text-uppercase mb-1">Firma</div>
                        </div>                                                
                        </div>

                        <div class="col-4 text-center text-dark pt-5">
                        <div class="pb-4">
                          <div class="text-sm font-weight-bold text-uppercase mb-1">Sello</div>
                        </div>
                        </div>

                        <div class="col-4 text-center text-dark pt-5">
                        <div class="pb-4">
                          <div class="text-sm font-weight-bold text-uppercase mb-1"><?=date("d-m-Y")?></div>
                          <div class="text-sm font-weight-bold text-uppercase mb-1">Fecha</div>
                        </div>
                       </div>
                     </div>
                     </div>

                      <!-- End Constancia -->

                    </div>
                  </div>
                </div>
                <!-- /Tabla de Status de Constancia -->


              </div>

            </div>
          <!-- /.Perfil alumno -->

          </div>
        

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
  
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../js/lightbox-plus-jquery.js"></script> 
  <?php if($rol>0){ ?>
  <script src="../scripts/editAdminPassSelf.js"></script>
  <script>
    // ---------------------- Sin conflictos con lightbox
    $(window).on("load", function () {
          $("#btnEditarSelf").on("click", function (e) {
            e.preventDefault();
            jQuery.noConflict();
            $("#editarAdminSelfModal").modal("toggle");
          });
          });
  </script>
  <?php }; ?>
  <?php if($rol == 0){ ?>
  <script src="../scripts/editAlumnoPassSelf.js"></script>
  <?php }; ?>

  <script>
// ---------------------- Evitando conflictos con lightbox
$(window).on("load", function () {
    $("#btnEditarBoth").on("click", function (e) {
        e.preventDefault();
        jQuery.noConflict();
        $("#editarAlumnoBothModal").modal("toggle");
    });
    $("#btnEditarBoth2").on("click", function (e) {
        e.preventDefault();
        jQuery.noConflict();
        $("#editarAlumnoBothModal").modal("toggle");
    });
    $("#btnEditarBoth3").on("click", function (e) {
        e.preventDefault();
        jQuery.noConflict();
        $("#editarAlumnoBothModal").modal("toggle");
    });
});
// ---------------------- /.Evitando conflictos con lightbox
</script>

  <script>
  var arrayDataPendientes= <?=json_encode($array_pendientes)?>;
  </script>

  <script src="../js/demo/chart-pie-docs.js"></script>
  
  


  <!-- Imprimir Areas Especeficas -->
 
<?php if ($rol == 0) {?>
<script>
    document.querySelector("#btnImprimirConstancia2").addEventListener("click", function () {
    var divHeader = document.querySelector("#imprimirConstanciaHeader");
    var divTitle = document.querySelector("#imprimirConstanciaTitle");
    var divBody = document.querySelector("#imprimirConstanciaBody");
    var divFooter = document.querySelector("#imprimirConstanciaFooter");
    imprimirElemento(divHeader, divTitle, divBody, divFooter);
    });
</script>
<?php };?>
<script>
  document.querySelector("#btnImprimirConstancia").addEventListener("click", function () {
  var divHeader = document.querySelector("#imprimirConstanciaHeader");
  var divTitle = document.querySelector("#imprimirConstanciaTitle");
  var divBody = document.querySelector("#imprimirConstanciaBody");
  var divFooter = document.querySelector("#imprimirConstanciaFooter");
  imprimirElemento(divHeader, divTitle, divBody, divFooter);
  });
    function imprimirElemento(divHeader, divTitle, divBody, divFooter) {
      var ventana = window.open('', 'PRINT', 'height=700,width=600');
      ventana.document.write('<html><head><title>' + 'Constancia de archivo digital de la Universidad José Antonio Páez' + '</title>');
      ventana.document.write('<link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">'); //Aquí agregué la hoja de estilos
      ventana.document.write('<link rel="stylesheet" href="css/sb-admin-2.css">');
      ventana.document.write('<link rel="stylesheet" href="css/style.css">');
      ventana.document.write('<link rel="stylesheet" href="css/check.css">');

      ventana.document.write('</head><body >');
      ventana.document.write('<br><br><br><br><br>');

      ventana.document.write('<div class="mb-4">');
      ventana.document.write('<div class="px-3 py-2">');

      ventana.document.write(divHeader.innerHTML);
      ventana.document.write('<br><br><br>');

      ventana.document.write(divTitle.innerHTML);
      ventana.document.write(divBody.innerHTML);

      ventana.document.write('<br><br><br>');
      ventana.document.write(divFooter.innerHTML);
      
      ventana.document.write('</div>');
      ventana.document.write('</div>');
      ventana.document.write('</body></html>');
      ventana.document.close();
      ventana.focus();
      ventana.onload = function () {
        ventana.print();
        ventana.close();
      };
      return true;
    };
  </script>
  <!-- /.Imprimir Areas Especeficas -->

</body>

</html>