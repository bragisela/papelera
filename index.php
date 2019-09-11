<?php
include("sql/conexion.php");

if(isset($_POST['login'])) {
		$errMsg = '';

		// Get data from FORM
		$usuario = $_POST['usuario'];
		$contrasenia = $_POST['contrasenia'];

		if($usuario == '')
			$errMsg = 'Ingresar Usuario';
		if($contrasenia == '')
			$errMsg = 'Ingresar Contraseña';

		if($errMsg == '') {
			try {
				$stmt = $conexiones->prepare('SELECT u.usuario, u.contrasenia, u.codrol, ro.nombreRol from usuarios as u
					inner join roles as ro on u.codRol=ro.codrol
					where u.usuario=:usuario');
				$stmt->execute(array(
					':usuario' => $usuario
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "El usuario $usuario no existe.";
				}
				else {
					if($contrasenia == $data['contrasenia']) {
						session_start();
						$_SESSION['usuario'] =  $data['usuario'];
						$_SESSION['contrasenia'] = $data['contrasenia'];
            $_SESSION['codRol'] = $data['codrol'];
						$codRol=$_SESSION['codRol'];
						if ($codRol==1) {
							header('Location: inicioSuperAdmin.php');
						}
						if ($codRol==2) {
							header('Location: inicioAdmin.php');
						}
						exit;
					}
					else
						$errMsg = 'Contraseña incorrecta.';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php
		include('encabezado.php');
		?>

    <style>

        .intro-2 {
            background: url("0extras/asd.jpg")no-repeat center center;
            background-size: cover;
        }
        .top-nav-collapse {
            background-color: #3f51b5 !important;
        }
        .navbar:not(.top-nav-collapse) {
            background: transparent !important;
        }
        @media (max-width: 768px) {
            .navbar:not(.top-nav-collapse) {
                background: #3f51b5 !important;
            }
        }

        .card {
            background-color: rgba(229, 228, 255, 0.2);
        }
        .md-form label {
            color: #ffffff;
        }
        h6 {
            line-height: 1.7;
        }

        html,
        body,
        header,
        .view {
          height: 100%;
        }

        @media (min-width: 560px) and (max-width: 740px) {
          html,
          body,
          header,
          .view {
            height: 650px;
          }
        }

        @media (min-width: 800px) and (max-width: 850px) {
          html,
          body,
          header,
          .view  {
            height: 650px;
          }
        }

        .card {
            margin-top: 30px;
            /*margin-bottom: -45px;*/

        }

        .md-form input[type=text]:focus:not([readonly]),
        .md-form input[type=password]:focus:not([readonly]) {
            border-bottom: 1px solid #8EDEF8;
            box-shadow: 0 1px 0 0 #8EDEF8;
        }
        .md-form input[type=text]:focus:not([readonly])+label,
        .md-form input[type=password]:focus:not([readonly])+label {
            color: #8EDEF8;
        }

        .md-form .form-control {
            color: #fff;
        }

        .navbar.navbar-dark form .md-form input:focus:not([readonly]) {
            border-color: #8EDEF8;
        }

        @media (min-width: 800px) and (max-width: 850px) {
            .navbar:not(.top-nav-collapse) {
                background: #3f51b5!important;
            }
        }

    </style>

</head>

<body>


    <!--Main Navigation-->
    <header>
      <!--Intro Section-->
        <section class="view intro-2">
          <div class="mask rgba-stylish-strong h-100 d-flex justify-content-center align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-5 col-lg-6 col-md-10 col-sm-12 mx-auto mt-5">
                        <!--Form with header-->
                        <div class="card wow fadeIn" data-wow-delay="0.3s">
                          <div class="card-body">
                              <!--Header-->
                            <div class="form-header" style="background-color: #71E6C0;">
                              <h3><i class="fas fa-user mt-2 mb-2"></i> Papelera</h3>
                            </div>

														<form method="post">
		                            <?php
														    if(isset($errMsg)){
														    echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
														    }
														    ?>

		                            <!--Body-->
		                            <div class="md-form">
		                              <i class="fas fa-user prefix white-text"></i>
		                                <input type="text" id="orangeForm-name"  autocomplete="off" name="usuario" class="form-control" value="<?php if(isset($_POST['usuario'])) echo $_POST['usuario'] ?>">
		                                <label for="orangeForm-name">Usuario  user:admin</label>
		                            </div>

		                            <div class="md-form">
		                              <i class="fas fa-lock prefix white-text"></i>
		                                <input type="password" id="orangeForm-pass" name="contrasenia" class="form-control" value="<?php if(isset($_POST['contrasenia'])) echo $_POST['contrasenia'] ?>">
		                                <label for="orangeForm-pass">Contraseña pw:admin</label>
		                            </div>

		                            <div class="text-center">
		                              <input class="btn btn-lg btn-success"  type="submit" name="login" value="Iniciar Sesion"></input>
		                                <hr>
		                                <div class="inline-ul text-center d-flex justify-content-center">
		                                  <a class="p-2 m-2 fa-lg tw-ic"><i class="fab fa-facebook white-text"></i></a>
		                                </div>
		                            </div>

                              </form>

                          </div>
                        </div>
                        <!--/Form with header-->
                    </div>
                </div>
            </div>
          </div>
        </section>

    </header>
    <!--Main Navigation-->


    <!--  SCRIPTS  -->
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.js"></script>
    <script>
        new WOW().init();
    </script>
</body>
</html>
