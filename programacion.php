<?php
include("conectar.php");
	session_start();
		
	if(!isset($_SESSION["login"]))
	{
		$_SESSION["login"]=false;
		$_SESSION["administrador"]=false;
		$_SESSION["usuario"]=false;	
		$_SESSION["nombre"]="";
		$_SESSION["nombre_usuario"]="";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>infantcable Programacion de la semana.</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="header">
  <div id="logo">
    <h1><a href="index.php">infantcable</a></h1>
  </div>
  <div id="menu">
    <ul>
      <li class="active"><a href="index.php" accesskey="1" title="">inicio</a></li>
      <li><a href="television.php" accesskey="2" title="">televisión</a></li>
      <li><a href="telefonia.php" accesskey="3" title="">telefonia</a></li>
      <li><a href="internet.php" accesskey="4" title="">internet</a></li>
      <a href="paquetes.php">paquetes</a> <a href="programacion.php">programación</a>
    </ul>
  </div>
</div>
<hr />
<div id="page">
  <div id="bg">
    <div id="content">
      <div class="post">
        <form id="form4" method="post" action="">
          <h3><strong>Programacion de la semana.</strong></h3>
          <h3>Seleccione canal:
            <select name="select" size="1" id="select">
              <?php
              $clase=new mysql();
  			  if(!$clase->conectar())
  			  	die("no se logro conectar con la base de datos");
			  
			  $sql="select * from canales order by nombre";
			  $res=$clase->query($sql);
			  while($fila=mysql_fetch_array($res))
			  {
				  if(isset($_POST["select"]) && $_POST["select"]==$fila["nombre"])
      			  	echo "<option selected='selected'>".$fila["nombre"]."</option>";
				  else
					echo "<option>".$fila["nombre"]."</option>";  			 
  			  }
  			  ?>
            </select>
            <input type="submit" name="boton_ver" id="boton_ver" value="Ver programacion" />
          </h3>
          <h3>Buscar programa:
            <input name="programa" type="text" id="programa" maxlength="12" />
            <input type="submit" name="boton_buscar" id="boton_buscar" value="Buscar" />
          </h3>
          <?php
			  if(isset($_POST["boton_buscar"]))
			  {
				if(!empty($_POST["programa"]))
				{
					$enc=false;
					$clase=new mysql();
  			  		if(!$clase->conectar())
  			  			die("no se logro conectar con la base de datos");
			 		
					$sql="select * from canales order by nombre";
			  		$res=$clase->query($sql);
			  		while($fila=mysql_fetch_array($res))
					{
						$cadena=$fila["programacion"];
						$tok = strtok($cadena,"-");
						while($tok && !$enc)
						{
							if(strcasecmp($tok, $_POST["programa"]) == 0)
							{
								$enc=true;
								break;	
							}							
							$tok = strtok("-");
						}
						if($enc)
							break;
					}
					if($enc)
					{
						echo "Programa encontrado en <b>".$fila["nombre"]."</b>.";	
						$cadena=$fila["programacion"];
						$tok = strtok($cadena,"-");
			  			echo '<table width="400" border="5" cellpadding="11" cellspacing="0" align="center" bordercolor="#31B1F0">';
						echo '<tr>
						<td><center><b>Hora</b></center></td>
		        		<td><center><b>Lunes</b></center></td>
		        		<td><center><b>Martes</b></center></td>
						<td><center><b>Miercoles</b></center></td>
		        		<td><center><b>Jueves</b></center></td>
						<td><center><b>Viernes</b></center></td>
		        		<td><center><b>Sabado</b></center></td>
						<td><center><b>Domingo</b></center></td>
	          			</tr>';
			  
    					for($i=0;$i<24;$i++)
	   					{
							echo "<tr>";
							if($i<10)
								echo "<td><center><b>0".$i.":00</b></center></td>";
							else
								echo "<td><center><b>".$i.":00</b></center></td>";
	   						for($j=0;$j<7;$j++)
							{	
								if(strcasecmp($tok, $_POST["programa"]) == 0)						   				
	      							echo '<td bgcolor="#00FFFF"><center>'.$tok.'</center></td>';
								else
									echo "<td><center>".$tok."</center></td>";	
								$tok = strtok("-");
							}
							echo "</tr>";		
    					}
						echo "</table>";
					}
					else
						echo "Programa no encontrado.";					
				}
				else
					echo "Nombre del programa requerido.";
			  }
			  				
              if(isset($_POST["boton_ver"]))
			  {
				if(isset($_POST["select"]))
				{			
					$clase=new mysql();
  			  		if(!$clase->conectar())
  			  			die("no se logro conectar con la base de datos");
			 		
					$sql="select * from canales where nombre='".$_POST["select"]."'";
			  		$res=$clase->query($sql);
			  		if($fila=mysql_fetch_array($res))
						$cadena=$fila["programacion"];					
				}
				else
					echo "Debe seleccionar el canal a ver programacion.";	
				
				$tok = strtok($cadena,"-");
			  	echo '<table width="400" border="5" cellpadding="11" cellspacing="0" align="center" bordercolor="#31B1F0">';
				echo '<tr>
				<td><center><b>Hora</b></center></td>
		        <td><center><b>Lunes</b></center></td>
		        <td><center><b>Martes</b></center></td>
				<td><center><b>Miercoles</b></center></td>
		        <td><center><b>Jueves</b></center></td>
				<td><center><b>Viernes</b></center></td>
		        <td><center><b>Sabado</b></center></td>
				<td><center><b>Domingo</b></center></td>
	          	</tr>';
			  
    			for($i=0;$i<24;$i++)
	   			{
					echo "<tr>";
					if($i<10)
						echo "<td><center><b>0".$i.":00</b></center></td>";
					else
						echo "<td><center><b>".$i.":00</b></center></td>";
	   				for($j=0;$j<7;$j++)
					{							   				
	      				echo "<td><center>".$tok."</center></td>";
						$tok = strtok("-");
					}
					echo "</tr>";		
    			}
				echo "</table>";				
			  }			  
			  ?>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div>
    </div>
    <!-- end contentn -->
    <div id="sidebar">
      <h2>&nbsp;</h2>
      <?php	
		  	if(isset($_POST["boton_cerrar1"]) || isset($_POST["boton_cerrar2"]))
			{
				$_SESSION["login"]=false;
				$_SESSION["administrador"]=false;
				$_SESSION["usuario"]=false;
				$_SESSION["nombre"]="";
				$_SESSION["nombre_usuario"]="";
				header("location:index.php");
			}
		  
			if(isset($_POST["boton_iniciar"]))
			{	
				$admin=false;
				$user=false;				
				$clase=new mysql();
  				if(!$clase->conectar())
  					die("no se logro conectar con la base de datos");
				$sql="select * from administrador where usuario='".$_POST["usuario"]."' and clave='".$_POST["clave"]."'";
				$res=$clase->query($sql);
						
				if($fila=mysql_fetch_array($res))
				{
					$admin=true;
					$_SESSION["login"]=true;
					$_SESSION["administrador"]=true;
					$_SESSION["nombre"]=$fila["nombre"];
					$_SESSION["nombre_usuario"]=$fila["usuario"];
					header("location:index.php");										
				}
				else
				{
					$sql="select * from usuario where usuario='".$_POST["usuario"]."' and clave='".$_POST["clave"]."'";
					$res=$clase->query($sql);	
							
					if($fila=mysql_fetch_array($res))
					{
						$user=true;	
						$_SESSION["login"]=true;
						$_SESSION["usuario"]=true;
						$_SESSION["nombre"]=$fila["nombre"];
						$_SESSION["nombre_usuario"]=$fila["usuario"];
						header("location:index.php");
					}
				}								
			}
		  
		  	if($_SESSION["login"]==false)
			{?>
      <form id="form1" method="post" action="">
        <h3><strong>Inicio de sesion</strong></h3>
        <table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td><h3><strong>Usuario:</strong></h3></td>
            <td><input name="usuario" type="text" id="textfield" maxlength="15" /></td>
          </tr>
          <tr>
            <td><h3><strong>Contraseña:</strong></h3></td>
            <td><input name="clave" type="password" id="textfield2" maxlength="15" /></td>
          </tr>
          <tr>
            <td><a href="registro.php">Registrarse</a></td>
            <td><input type="submit" name="boton_iniciar" id="boton_iniciar" value="Iniciar Sesion" /></td>
          </tr>
        </table>
        <?php
				if(isset($_POST["boton_iniciar"]) && !$admin && !$user)
					echo "Usuario no registrado o contraseña incorrecta";?>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp; </p>
      </form>
      <?php }
			else
			{
				if($_SESSION["administrador"]==true)
				{?>
      <h2>&nbsp; &nbsp; Hola <?php echo $_SESSION["nombre"]; ?></h2>
      <ul>
        <li>
          <form id="form2" method="post" action="">
            <input type="submit" name="boton_cerrar1" id="boton_cerrar1" value="Cerrar Sesion" />
          </form>
          <h2>Menu de Administrador</h2>
          <ul>
            <ul>
              <li>
                <h3><strong>Planes</strong></h3>
              </li>
              <li class="first"><a href="planes_crear.php">Crear</a></li>
              <li><a href="planes_eliminar.php">Eliminar</a></li>
              <h3><strong>Television</strong></h3>
              <li><a href="canales.php">Canales</a></li>
              <li><a href="programacion_admin.php">Programacion</a></li>
              <h3><strong>Usuarios</strong></h3>
              <li><a href="autorizacion.php">Autorizaciones</a></li>
              <li><a href="facturas_admin.php">Facturacion</a></li>
              <li><a href="registro_admin.php">Crear Administrador</a></li>
            </ul>
            <p>&nbsp;</p>
          </ul>
        </li>
      </ul>
      <?php }
				if($_SESSION["usuario"]==true)
				{?>
      <h2>&nbsp; &nbsp; Hola <?php echo $_SESSION["nombre"]; ?></h2>
      <ul>
        <li>
          <form id="form3" method="post" action="">
            <input type="submit" name="boton_cerrar2" id="boton_cerrar2" value="Cerrar Sesion" />
          </form>
          <h2>Menu de Usuario</h2>
          <ul>
            <ul>
              <li>
                <h3><strong>Planes</strong></h3>
              </li>
              <li class="first"><a href="usuario_actual.php">Actual</a></li>
              <li><a href="usuario_cambiar.php">Cambiar</a></li>
              <li><a href="usuario_cancelar.php">Cancelar</a></li>
              <h3><strong>Facturacion</strong></h3>
              <li><a href="usuario_facturas.php">Facturas</a></li>
            </ul>
            <p>&nbsp;</p>
          </ul>
        </li>
      </ul>
      <?php }
			}?>
    </div>
    <!-- end sidebar -->
    <div style="clear: both;">&nbsp;</div>
  </div>
</div>
<!-- end page -->
<hr />
<div id="footer">
  <p>(c) 2012 infantcable.com</p>
</div>
</body>
</html>
