<?php session_start();
include ("config.php");
require_once('seg.php');
$errores["login"] = "";
$Ingresar=isset($_POST['Ingresar'])?$_POST['Ingresar']:NULL;
$cedula=(isset($_POST['cedula']))?$_POST['cedula']:"";
$klave=(isset($_POST['klave']))?$_POST['klave']:"";
$cedula=formatear($cedula);
if (isset($Ingresar))
 {if($cedula!="" && $klave!="")
    {include ("config.php");
	 
     $result=mysqli_query($link,"SELECT * FROM responsables WHERE cedula='".$cedula."'");
	 if($row=mysqli_fetch_array($result))
	   {if($row["clave"] == md5($klave)){
        $_SESSION['usuario']=$cedula;
		    $_SESSION['tipo']=$row["tipo"];
        $_SESSION['nombres']=$row["nombres"];
        header('Location:inicio.php');
      }else{
        $errores["login"] = "<font color='ff00000'>Clave incorrecta</font>";
      }
    }
    else
     {$errores["login"] = "<font color='ff00000'>Usuario no registrado</font>";}
}else{$errores["login"] = "<font color='ff00000'>Debe introducir el usuario y la clave</font>";}}?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Planta de Desposte | Login</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo-mercamio.png" alt="">
                  <span class="d-none d-lg-block">Planta de Desposte</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login </h5>
                    <p class="text-center small">Ingrese Usuario y Clave</p>
                  </div>

                  <form class="row g-3 needs-validation" novalidate method="post" action="index.php">

                    <div class="col-12">
                      <label for="cedula" class="form-label">Cedula</label>
                      <div class="input-group has-validation">
                        <input type="text" id="cedula" name="cedula" class="form-control" autocomplete="off"
                          placeholder="Ingresar Cedula" value="<?php echo $cedula;?>" required>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="klave" class="form-label">Clave</label>
                      <input type="password" class="form-control" id="klave" name="klave" autocomplete="off"
                 placeholder="Ingresar Clave" required>
                    </div>

                    <div class="col-12">
                      <?php if($errores["login"]!=""){?>
                        <div class="alert alert-danger" role="alert">
                      <?php echo $errores["login"];?>
                        </div>
                      <?php }?>  
                  </div>
                    
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="Ingresar" value="Ingresar">Ingresar</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>