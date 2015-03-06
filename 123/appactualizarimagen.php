<?php

$idImagen=$_POST['idImagen'];
$ruta="imagenes";
$archivo=$_FILES['nuevaImagen']['tmp_name'];
//$nombreArchivo=$_FILES['nuevaImagen']['name'];
$nombreArchivo =  "principal";
move_uploaded_file($archivo,$ruta."/".$nombreArchivo . ".jpg");
$ruta=$ruta."/".$nombreArchivo . ".jpg";
$horaperfil = date("Y-m-d H:i:s");

include "conexion.php";

$actualizar=mysql_query("UPDATE aplicacion SET imagen_inicio='".$ruta."',fecha_actualizacion_imagen='".$horaperfil."' WHERE id='".$idImagen."'",$conexion);

if ($actualizar)
{
	echo "
	<script language = javascript>
	self.location = 'app_mostrarimagenes_actualizada.php'
	</script>
	
	";
	
}
else
{
	
	echo "
	<script language = javascript>
	self.location = 'app_mostrarimagenes_error.php'
	</script>
	
	";
}



?>
