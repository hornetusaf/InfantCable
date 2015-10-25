<?php
include("conectar.php");
$clase=new mysql();
if(!$clase->conectar())
	die("no se logro conectar con la base de datos");
				
$sql="select * from facturas where factura='".$_GET["id"]."'";
$res=$clase->query($sql);
if($fila=mysql_fetch_array($res))
{
	echo '<table border="0">';
	echo '<tr>';
    echo '<td>Factura #: '.$fila["factura"].'</td>';
  
  	echo '</tr>';
  	echo '<tr>';
    echo '<td>Usuario: '.$fila["usuario"].'</td>';
    
 	echo '</tr>';
 	echo '<tr>';
    echo '<td>Saldo: '.$fila["saldo"].'</td>';
    
  	echo '</tr>';
  	echo '<tr>';
    echo '<td>Fecha: '.$fila["fecha"].'</td>';
   
 	echo '</tr>';
  	echo '<tr>';
    echo '<td>Descripcion: '.$fila["descripcion"].'</td>';
   
 	echo '</tr>';
	echo '</table>';
}
?>
