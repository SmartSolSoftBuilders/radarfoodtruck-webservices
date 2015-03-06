<!DOCTYPE html>
<html lang="en">

<head>

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<link rel="icon" href="favicon.ico" type="image/x-icon">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Radar FoodTruck Admin</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Radar Foodtruck</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
              <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $name;?> <b class="caret"></b></a>
                  <ul class="dropdown-menu">                  
                        <a href="desconectar_usuario.php"><i class="fa fa-fw fa-power-off"></i> Cerrar sesión</a>
                      </li>
                  </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li class="active">
                        <a href="lista_trucks.php"><i class="fa fa-fw fa-edit"></i> Datos generales</a>
                    </li>
                    <li>
                        <a href="agregar_trucks.php"><i class="fa fa-fw fa-edit"></i> Agregar trucks</a>
                    </li>
                    <li>
                        <a href="cuenta.php"><i class="fa fa-fw fa-wrench"></i> Mi cuenta</a>
                    </li>
                    <li>
                        <a href="app.php"><i class="fa fa-fw fa-wrench"></i> Aplicación</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Cambiar imagen principal</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
<?php

$imagen=$_GET['imagen'];
$idImagen=$_GET['idImagen'];

echo " 
               <form method='POST' action='appactualizarimagen.php' enctype='multipart/form-data'>
				<label>¿Quieres cambiar esta imagen?</label>
				<br><br>
				<img src='$imagen' width='150' height='100'>
				<br><br>
				
				<input type='hidden' name='idImagen' value='$idImagen'>
				<br><br>
				<input type='file' name='nuevaImagen'>
				<br><br>
				<input  type='submit' value='Actualizar'>
			
			</form>";


?>

		

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
