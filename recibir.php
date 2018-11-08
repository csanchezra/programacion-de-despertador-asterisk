<html>
<head>
<script Language="JavaScript">
if(history.forward(1)){
history.replace(history.forward(1));
}

<title>Example</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- Latest compiled and minified CSS -->
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
 <!-- jQuery library -->
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <!-- Latest compiled JavaScript -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



</script>
</head>
<body>

<?php

$exten = $_POST['extensiones'];
$fechaf = $_POST['fecha'];
$horaf = $_POST['hora'];
$idioma= $_POST['idioma'];
$perso= $_POST['personaje'];

////if de idioma//////////////


if($idioma==1)
$idio="es";
else if ($idioma==2)
$idio="en";

if($idioma==1)
$idio2="Espanol";
else if ($idioma==2)
$idio2="Ingles";


///////switch case del personaje que se reproducirá /////////

switch ($perso) {
    case 1:
        $persona="personaje1";
        break;
    case 2:
        $persona="personaje2";
        break;
    case 3:
        $persona="personaje3";
        break;
}

$personadato=$persona;

$persona=$idio."".$persona;

$anio=substr("$fechaf",0,4);
$mes=substr("$fechaf",5,2);
$dia=substr("$fechaf",8,2);
$hora2=substr("$horaf",0,2);
$minuto=substr("$horaf",3,2);

$intanio=(int)$anio;
$intmes=(int)$mes;
$intdia=(int)$dia;
$inthora2=(int)$hora2;
$intminuto=(int)$minuto;



$exten = preg_split( '/( |,|\r\n)/', $exten);

$b=count($exten);

for ($a=0;$a<$b;$a++)
{

if ($exten[$a]!=0){
$archivo=$intanio.$intmes.$intdia.$inthora2.$intminuto.".".$exten[$a].".call";

$fecha=$intanio."-".$intmes."-".$intdia." ".$inthora2.":".$intminuto;

$ruta=$archivo;


$file = fopen($archivo, "w");

fwrite($file,"Channel: Local/".$exten[$a]."@closed". PHP_EOL);

fwrite($file, 'CallerID: "Nickelodeon"<0000>' . PHP_EOL);

fwrite($file, "MaxRetries: 3" . PHP_EOL);

fwrite($file, "WaitTime: 30" . PHP_EOL);

fwrite($file, "RetryTime: 120" . PHP_EOL);

fwrite($file, "Context: call-file-test" . PHP_EOL);

fwrite($file, "Extension: ".$persona . PHP_EOL);


fclose($file);


$hora=mktime($inthora2,$intminuto,$intsegundosf,$intmes,$intdia,$intanio);

touch($archivo,$hora);

$link = mysql_connect("localhost","usuariomysql","contrasena");
mysql_select_db("base_despertador", $link);
$result = mysql_query("INSERT INTO base_despertador (extension,audio,idioma,fecha,ruta) VALUE ('$exten[$a]','$personadato','$idio2','$fecha','$ruta');", $link);

exec('sh /var/www/html/cm/mover.sh');
}

}


header ("Location: listar.php");

?>
</body>
</html>
