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

$id = $_SESSION['id'];

$consulta= "SELECT email,twitter,facebook,name,info,tipo,horaa,horac FROM trucks WHERE id='".$id."'"; 
$resultado= mysql_query($consulta,$conex) or die (mysql_error());
$fila=mysql_fetch_array($resultado);
$twitter = $fila['twitter'];
$email = $fila['email'];
$facebook = $fila['facebook'];
$name = $fila['name'];
$info = $fila['info'];
$tipo = $fila['tipo'];
$horaa = $fila['horaa'];
$horac = $fila['horac'];
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


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>
<script>
var map;

function initialize() {
  var mapOptions = {
    zoom: 18
  };
  map = new google.maps.Map(document.getElementById('map-canvas'),
      mapOptions);

  // Try HTML5 geolocation
  if(navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = new google.maps.LatLng(position.coords.latitude,
                                       position.coords.longitude);

      var infowindow = new google.maps.InfoWindow({
        map: map,
        position: pos,
        content: 'Mi ubicación.'
      });

      map.setCenter(pos);
    }, function() {
      handleNoGeolocation(true);
    });
  } else {
    // Browser doesn't support Geolocation
    handleNoGeolocation(false);
  }
}

function handleNoGeolocation(errorFlag) {
  if (errorFlag) {
    var content = 'Error: Fallo el servicio de localización.';
  } else {
    var content = 'Error: Tu explorador de internet no es compatible con geolocalización.';
  }

  var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
  };

  var infowindow = new google.maps.InfoWindow(options);
  map.setCenter(options.position);
}

google.maps.event.addDomListener(window, 'load', initialize);

//////////////////////callback variables///////////////////////////////////////////////

  function requestCurrentPosition(){
        if (navigator.geolocation)
        {
        navigator.geolocation.getCurrentPosition(useGeoData);
        }
            else{
            console.log("not avaliable");
            }
    }
            
            function useGeoData(position){
            var longitude = position.coords.longitude;
            var latitude = position.coords.latitude;
            /*do stuff with long and lat here.*/
            $("#id_latitude").val(latitude);
             $("#id_longitude").val(longitude);
            }
                
                requestCurrentPosition();
///////////////////////////////////////////////////////////////////////////////////////

    </script>
<style>
      #map-canvas {
        height: 222px;
        margin: 0px;
        padding: 0px
      }
    </style>
</head>

<body onLoad="showlocation()">

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
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['name'];?> <b class="caret"></b></a>
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
                        <a href="datos_generales.php"><i class="fa fa-fw fa-edit"></i> Datos generales</a>
                    </li>
                    <li>
                        <a href="mostrarimagenes.php"><i class="fa fa-fw fa-desktop"></i> Imágenes</a>
                    </li>
                    <li>
                        <a href="cuenta.php"><i class="fa fa-fw fa-wrench"></i> Mi cuenta</a>
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
                        <h1 class="page-header">
                            Actualizar datos
                        </h1>
                    </div>
                </div>




              <div class="row">
                    <div class="col-lg-6">
                        <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i><strong> Los datos mostrados son los existentes actualmente!</strong>
                        </div>
                            <h1>Mis datos</h1>
  


                                <form  action="actualiza_datos.php" method="post" name="actualiza" id="actualiza" role="form">

                            
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input name="name" id="name" class="form-control" value="<?php echo $name?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Tipo de Comida:</label>
                                <input name="tipo" id="tipo" class="form-control" value="<?php echo $tipo?>">
                            </div>
                             <div class="form-group">
                                <label>Hora de apertura:</label>
                                <input name="horaa" id="horaa" class="form-control" value="<?php echo $horaa?>">
                            </div>
                             <div class="form-group">
                                <label>Hora de cierre:</label>
                                <input name="horac" id="horac" class="form-control" value="<?php echo $horac?>">
                            </div>
                            <div class="form-group">
                                <label>Descripción:</label>
                                <textarea name="desc" id="desc" class="form-control" rows="3" ><?php echo $info?></textarea>
                            </div>
                                <label>Twitter:</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input name="twitter" id="twitter" type="text" class="form-control" value="<?php echo $twitter?>">
                            </div>
                                <label>Facebook:</label>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input name="facebook" id="facebook" type="text" class="form-control" value="<?php echo $facebook?>">
                            </div>

                            <button type="submit" name="Submit" class="btn btn-default">Enviar</button>
                            <button type="reset" class="btn btn-default">Regresar campos</button>

                        </form>

                    </div>
                    

                    
           
                    <div class="col-lg-6">
                      <div class="alert alert-info alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <i class="fa fa-info-circle"></i><strong> En el mapa se muestra la ubicación que se enviaria para actualizar</strong>
                      </div>


                      <h1>Mi ubicación</h1>
                      <br>
                 
                       
                            
                      <form  action="actualiza_ubicacion.php" method="post" name="actualiza" id="actualiza" role="form">

                            
                            <div class="form-group">
                                <label>Nombre del lugar:</label>
                                <input name="nlugar" class="form-control" >
                            </div>
                            
                            <div class="form-group">
                                <label>Dirección:</label>
                                 <input name="direccion" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Latitud:</label>
                                 <input name="latitud" class="form-control" id="id_latitude" OnFocus="this.blur()">
                            </div>
                            
                            <div class="form-group">
                                <label>Longitud:</label>
                                 <input name="longitud" class="form-control" id="id_longitude" OnFocus="this.blur()">
                            </div>
                             

                            <button type="submit" name="Submit" class="btn btn-default">Enviar</button>
                           
                      </form>

                     <br>
                     <div id="map-canvas"></div>
                          
				
					 
				
                   
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
