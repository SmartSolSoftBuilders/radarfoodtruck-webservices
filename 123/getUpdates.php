<?php

// Prevent caching.
header('Cache-Control: no-cache, must-revalidate');
header('Expires: Mon, 01 Jan 1996 00:00:00 GMT');

// The JSON standard MIME header.
header('Content-type: application/json');

$fechaBusqueda=$_GET['d'];

$conex = mysql_connect("db545232790.db.1and1.com", "dbo545232790", "RadarFood+1")
		or die("No se pudo realizar la conexion");
	mysql_select_db("db545232790",$conex)
		or die("ERROR con la base de datos");



//Consultar si los datos son están guardados en la base de datos

//$query = sprintf("select * from trucks where fecha_actualizacion_perfil > '".$fechaBusqueda."'");
//Sustituir esto por un count
	$query = sprintf("select * from trucks where fecha_actualizacion_perfil >= '".$fechaBusqueda."'");
    $result = mysql_query($query, $conex);
	$numTrucks=0;
	if ($result) {
      while($row = mysql_fetch_array($result)) {
        // do something with the $row
		//$arrayTmp= array('idTruck'=>$row['id'],'nombre'=>$row['name'],'info' =>$row['info'],'twitter' =>$row['twitter'],'facebook'=>$row['facebook'],'tipo'=>$row['tipo'],'latitud' =>$row['latitud'],'longitude'=>$row['longitud']);
		//$trucksPorActualizar[$numTrucks]=$arrayTmp;
		$numTrucks++;
      }

    }
    else {
      echo mysql_error();
    }
	
	$query = sprintf("select * from trucks");
    $result = mysql_query($query, $conex);
	//$numTrucks=0;
	$trucksPorActualizar= array();	
    if ($result) {
      $numTrucks2=0;
	  while($row = mysql_fetch_array($result)) {
        // do something with the $row		
		$arrayTmp= array('idTruck'=>$row['id'],'nombre'=>$row['name'],'info' =>$row['info'],'twitter' =>$row['twitter'],'facebook'=>$row['facebook'],'tipo'=>$row['tipo'],'latitud' =>$row['latitud'],'longitude'=>$row['longitud'],'direccion'=>$row['direccion'],'lugar'=>$row['lugar']);
		$trucksPorActualizar[$numTrucks2]=$arrayTmp;
		$numTrucks2++;
      }

    }
    else {
      echo mysql_error();
    }
	
	$query = sprintf("select * from aplicacion where fecha_actualizacion_imagen >= '".$fechaBusqueda."'");
    $result = mysql_query($query, $conex);
	$nueva=0;
	if ($result) {
      
		$nueva++;
      

    }
    else {
      echo mysql_error();
    }
	
	$data = array(
			'version'=> date('Y-m-d H:i:s'),
			'numTrucks' =>$numTrucks,
			'trucks' => $trucksPorActualizar,
			'nuevaImagen' =>$nueva,
			);

// This ID parameter is sent by our javascript client.

// Send the data.
echo json_encode($data);

?>
