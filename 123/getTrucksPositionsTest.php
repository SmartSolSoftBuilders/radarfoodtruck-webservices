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

$query = sprintf("select * from trucks where fecha > '".$fechaBusqueda."' and latitud<>''");
    $result = mysql_query($query, $conex);
	$numTrucks=0;
	$trucksPorActualizar= array();	
    if ($result) {
      while($row = mysql_fetch_array($result)) {
        // do something with the $row
		$arrayTmp= array('idTruck'=>$row['id'],'nombre'=>$row['name'],'latitud' =>$row['latitud'],'longitude'=>$row['longitud'],'latituddelta'=>'','longitudedelta'=>'','direccion'=>$row['direccion'],'lugar'=>$row['lugar']);
		$trucksPorActualizar[$numTrucks]=$arrayTmp;
		$numTrucks++;
      }

    }
    else {
      echo mysql_error();
    }

	$data = array(
			'version'=>  date('Y-m-d H:i:s'),
			'numtrucks'=> $numTrucks,				
			'trucks' => $trucksPorActualizar
			);
// Send the data.
echo json_encode($data);


/*
array('idTruck'=>'1','nombre' => 'AREPA','info'=>'ok'),19.427025,-99.167665
							array('idTruck'=>'2','nombre' => 'BONKREP','info'=>'ok'),
							array('idTruck'=>'3','nombre' => 'BURGUES','info'=>'ok'),
							array('idTruck'=>'4','nombre' => 'MEZQUITE','info'=>'ok'),
							array('idTruck'=>'5','nombre' => 'MOK','info'=>'ok'),
							array('idTruck'=>'6','nombre' => 'MOSTAZA','info'=>'ok'),
							array('idTruck'=>'7','nombre' => 'NOMADA','info'=>'ok'),
							array('idTruck'=>'8','nombre' => 'NOODLE','info'=>'ok'),
							array('idTruck'=>'9','nombre' => 'ROCKIN','info'=>'ok'),
							array('idTruck'=>'10','nombre' => 'SALCHICHA','info'=>'ok'),
							array('idTruck'=>'11','nombre' => 'SORDO','info'=>'ok')
		METRO NORMAL: 19.444706,-99.167377
		METRO SAN COSME: 19.441782, -99.161106
*/
?>
