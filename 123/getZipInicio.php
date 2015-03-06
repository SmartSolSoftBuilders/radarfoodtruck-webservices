<?php

$fechaBusqueda=$_GET['d'];

$conex = mysql_connect("db545232790.db.1and1.com", "dbo545232790", "RadarFood+1")
		or die("No se pudo realizar la conexion");
	mysql_select_db("db545232790",$conex)
		or die("ERROR con la base de datos");



//Consultar si los datos son están guardados en la base de datos

$query = sprintf("select * from aplicacion where fecha_actualizacion_imagen >= '".$fechaBusqueda."'");
    $result = mysql_query($query, $conex);
	$numImg=0;
	$files= array();	
    if ($result) {
      while($row = mysql_fetch_array($result)) {
        // do something with the $row
		//$arrayTmp= array('idTruck'=>$row['id'],'nombre'=>$row['name'],'info' =>$row['info'],'twitter' =>$row['twitter'],'facebook'=>$row['facebook'],'tipo'=>$row['tipo']);
		$files[$numImg++]="http://s544443713.onlinehome.mx/truckAdmin/web/admin/imagenes/principal.png";

      }

    }
    else {
      echo mysql_error();
    }
# define file array
# create new zip opbject
$zip = new ZipArchive();

# create a temp file & open it
$tmp_file = tempnam('.','');
$zip->open($tmp_file, ZipArchive::CREATE);

# loop through each file
foreach($files as $file){

    # download file
    $download_file = file_get_contents($file);

    #add it to the zip
    $zip->addFromString(basename($file),$download_file);

}

# close zip
$zip->close();

# send the file to the browser as a download
/*
print $numTrucks;
var_dump($files);
*/
header('Content-disposition: attachment; filename=imagenInicio.zip');
header('Content-type: application/zip');
readfile($tmp_file);
unlink($tmp_file);
?>
