<?php 

// The JSON standard MIME header.
header('Content-type: application/json');

$conex = mysql_connect("db545232790.db.1and1.com", "dbo545232790", "RadarFood+1")
		or die("No se pudo realizar la conexion");
	mysql_select_db("db545232790",$conex)
		or die("ERROR con la base de datos");
		
$consulta=mysql_query( "SELECT latitud,longitud,name FROM trucks WHERE status > 0");


$data_back = json_decode(file_get_contents('php://input'));
$lat1 = $data_back->{"lat"};
$lon1 = $data_back->{"lon"};

//$lat1 = "19.4439237";
//$lon1 = "-99.166017";



	
function Distancia($lat1, $lon1, $lat2, $lon2, $kilometros) { 
  
  $radio = 6378.137; 
  $coord = $lon1 - $lon2; 
  $distancia = acos( sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($coord))) * $radio; 


  
  if ($kilometros == "K") {
  		return ($distancia); 
  } else {
    	return 0;
  }
}
  while($acceso=mysql_fetch_array($consulta))
{
    $lat2=$acceso['latitud'];
    $lon2=$acceso['longitud'];  
	$truck=$acceso['name'];
	
$resultadod[] = Distancia($lat1, $lon1, $lat2, $lon2, "K");
}
 
sort($resultadod); 
foreach ($resultadod as $key => $val){}

$dcercana = $resultadod[0]; 
$rango = 0;

if ($dcercana < 3){ 

    $rango = "0.05";
}
if ($dcercana < 10 &&$dcercana > 3){ 

    $rango = "0.2";
}
if ($dcercana < 20 &&$dcercana > 10){ 

    $rango = "0.1";
}
if ($dcercana < 50 &&$dcercana > 20){ 

    $rango = "1";
}
if ($dcercana < 100 &&$dcercana > 50 ){ 

    $rango = "5";
}
if ($dcercana > 100 ){ 

    $rango = "100";
}


echo json_encode($rango);

?>