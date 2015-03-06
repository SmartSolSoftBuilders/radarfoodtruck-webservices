<?php 
//Proceso de conexión con la base de datos
$conex = mysql_connect("db545232790.db.1and1.com", "dbo545232790", "RadarFood+1")
        or die("No se pudo realizar la conexion");
    mysql_select_db("db545232790",$conex)
        or die("ERROR con la base de datos");

//Iniciar Sesión
session_start();

//Validar si se está ingresando con sesión correctamente
if (!$_SESSION){
echo '<script language = javascript>
alert("usuario no autenticado")
self.location = "index.php"
</script>';
}


$consulta= "SELECT imagen_inicio FROM aplicacion WHERE id='1'"; 
$resultado= mysql_query($consulta,$conex) or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$imagen=$fila['imagen_inicio'];
?>
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
                        <h1 class="page-header">Cambiar imagen de inicio</h1>
                    </div>
                </div>
                
                                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i><strong> Algo salio mal, intenta nuevamente.!</strong>
                        </div>
                    </div>
                </div>
                 <!-- /.row -->   
                <div class="row">
                    <div class="col-lg-6">
                           <?php
                          echo "<table width='100%' border='0' align='center'>
        <tr>
            <th>Imagen</th>

            <th>Cambiar</th>
        
        </tr>
";
    
    echo "<tr>
            
            <td><img src='$imagen' width='150' height='100'></td>

            
            <td><a href='appcambiarImagen.php?idImagen=$idImagen&imagen=$imagen'>Cambiar</a></td>
        </tr>"  ;   

echo "</table>


";

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
