<!doctype html>
<html>
<head>
<meta http-equiv="refresh" content="30" />
<meta charset="utf-8">
<title>Llamadas programadas </title>
<link type="text/css" href="bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
<style>
table {
    border-collapse: collapse;
    width: 100%;
}
th, td {
    text-align: left;
    padding: 4px;
}
tr:nth-child(even){background-color: #f2f2f2}
th {
    background-color: #4CAF50;
    color: white;
}
.main-wrapper{
    width:60%;
    
    background:#E0E4E5;
    border:1px solid #292929;
    padding:25px;
    margin:auto;
}
hr {
    margin-top: 5px;
    margin-bottom: 5px;
    border: 0;
    border-top: 1px solid #eee;
}
h1{
    font-size:24px;
    }
</style>
</head>
 
<body>



<script>
function confirmar(url)
{
	if(confirm('¿Desea confirmar el cancelado?'))
	{
		window.location=url;
	}
	else
	{
		return false;
	}	
}
</script>




<div class="main-wrapper">
<h1 align="center">Llamadas programadas</h1>

<a href="index.html" style="float: right;">Regresar</a>
<a href="Exportar.php">
<img border="0" alt="W3Schools" src="excel.png" width="70" height="70">
 Exportar a Excel </a>


<?php
    include("function.php");
    if(isset($_POST['submit'])){
        $field = array("name"=>$_POST['name']);
        $tbl = "datos_nick";
        insert($tbl,$field);
        
    }
?>
<table border="1" width="100%">
    <tr>
        <th width="5%">ID</th>
        <th width="10%">Extension</th>
        <th width="15%">Audio</th>
        <th width="10%">Idioma</th>
        <th width="25%">Fecha</th>
        <th width="22%">Archivo</th>
        <th width="8%">Status</th>
        <th width="5%">Cancelar</th>
    </tr>
<?php 
    //$sql = "select * from datos_nick";

    $sql = "SELECT id,extension,audio,idioma,fecha,ruta,IF(estado=0,'Programada', IF(estado=1,'Realizada',IF(estado=2,'Cancelada', 'LESS'))) AS estado FROM datos_nick";
    $result = db_query($sql);
    while($row = mysqli_fetch_object($result)){
    ?>
    <tr>
        <td><?php echo $row->id;?></td>
        <td><?php echo $row->extension;?></td>
        <td><?php echo $row->audio;?></td>
        <td><?php echo $row->idioma;?></td>
        <td><?php echo $row->fecha;?></td>
        <td><?php echo $row->ruta;?></td>
        <td><?php echo $row->estado;?></td>           
<td>
 
<a  href="borrar.php?id=<?php echo $row->id;?>&ruta=<?php echo $row->ruta;?>&estado=<?php echo $row->estado;?>" onclick="return confirmar('accion.html')">
<img border="0" alt="W3Schools" src="delete.png" width="20" height="20">
 </a> </body>



</td>
    </tr>
    <?php } ?>
</table>
</div>


</body>
</html>
