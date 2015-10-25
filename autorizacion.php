<?php
include("conectar.php");
	session_start();
	if(!$_SESSION["administrador"])
		header("location:index.php");
	
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
<title>infantcable Autorizaciones.</title>
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
      <li><a href="#" accesskey="3" title="">telefonia</a></li>
      <li><a href="#" accesskey="4" title="">internet</a></li>
      <a href="#">paquetes</a> <a href="programacion.php">programación</a>
    </ul>
  </div>
</div>
<hr />
<div id="page">
  <div id="bg">
    <div id="content">
      <div class="post">
        <?php		  	
		  	if(isset($_POST["boton_cancelar"]))
			{
				$clase=new mysql();
  			  	if(!$clase->conectar())
  			  		die("no se logro conectar con la base de datos");
					
				$checkbox_cancelar_television=$_POST["CheckboxGroup_cancelar_television"];
				$checkbox_cancelar_internet=$_POST["CheckboxGroup_cancelar_internet"];
				$checkbox_cancelar_telefonia=$_POST["CheckboxGroup_cancelar_telefonia"];
				$checkbox_cancelar_paquetes=$_POST["CheckboxGroup_cancelar_paquetes"];
				
				if(!empty($checkbox_cancelar_television))
				{
					for($i=0;$i<count($checkbox_cancelar_television);$i++)
					{	
						$sql="update usuario set cambio_television='-1' where usuario='".$checkbox_cancelar_television[$i]."'";
						if($res=$clase->query($sql))
							echo "Cancelacion del plan de television para el usuario ".$checkbox_cancelar_television[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set television='-1' where usuario='".$checkbox_cancelar_television[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
				
				if(!empty($checkbox_cancelar_internet))
				{
					for($i=0;$i<count($checkbox_cancelar_internet);$i++)
					{	
						$sql="update usuario set cambio_internet='-1' where usuario='".$checkbox_cancelar_internet[$i]."'";
						if($res=$clase->query($sql))
							echo "Cancelacion del plan de internet para el usuario ".$checkbox_cancelar_internet[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set internet='-1' where usuario='".$checkbox_cancelar_internet[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
				
				if(!empty($checkbox_cancelar_telefonia))
				{
					for($i=0;$i<count($checkbox_cancelar_telefonia);$i++)
					{	
						$sql="update usuario set cambio_telefonia='-1' where usuario='".$checkbox_cancelar_telefonia[$i]."'";
						if($res=$clase->query($sql))
							echo "Cancelacion del plan de telefonia para el usuario ".$checkbox_cancelar_telefonia[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set telefonia='-1' where usuario='".$checkbox_cancelar_telefonia[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
				
				if(!empty($checkbox_cancelar_paquetes))
				{
					for($i=0;$i<count($checkbox_cancelar_paquetes);$i++)
					{	
						$sql="update usuario set cambio_paquetes='-1' where usuario='".$checkbox_cancelar_paquetes[$i]."'";
						if($res=$clase->query($sql))
							echo "Cancelacion del paquete para el usuario ".$checkbox_cancelar_paquetes[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set paquetes='-1' where usuario='".$checkbox_cancelar_paquetes[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
			}
			
			if(isset($_POST["boton_cambiar"]))
			{
				$clase=new mysql();
  			  	if(!$clase->conectar())
  			  		die("no se logro conectar con la base de datos");
					
				$checkbox_cambio_television=$_POST["CheckboxGroup_cambio_television"];
				$checkbox_cambio_internet=$_POST["CheckboxGroup_cambio_internet"];
				$checkbox_cambio_telefonia=$_POST["CheckboxGroup_cambio_telefonia"];
				$checkbox_cambio_paquetes=$_POST["CheckboxGroup_cambio_paquetes"];
				
				if(!empty($checkbox_cambio_television))
				{
					for($i=0;$i<count($checkbox_cambio_television);$i++)
					{	
						$nuevo_plan=0;
						$sql="select * from usuario where usuario='".$checkbox_cambio_television[$i]."'";
						$res=$clase->query($sql);
			  			if($fila=mysql_fetch_array($res))
							$nuevo_plan=$fila["cambio_television"];
						
						$sql="update usuario set cambio_television='-1' where usuario='".$checkbox_cambio_television[$i]."'";	
						if($res=$clase->query($sql))
							echo "Cambio del plan de television para el usuario ".$checkbox_cambio_television[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set television='".$nuevo_plan."' where usuario='".$checkbox_cambio_television[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
				
				if(!empty($checkbox_cambio_internet))
				{
					for($i=0;$i<count($checkbox_cambio_internet);$i++)
					{	
						$nuevo_plan=0;
						$sql="select * from usuario where usuario='".$checkbox_cambio_internet[$i]."'";
						$res=$clase->query($sql);
			  			if($fila=mysql_fetch_array($res))
							$nuevo_plan=$fila["cambio_internet"];
						
						$sql="update usuario set cambio_internet='-1' where usuario='".$checkbox_cambio_internet[$i]."'";	
						if($res=$clase->query($sql))
							echo "Cambio del plan de internet para el usuario ".$checkbox_cambio_internet[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set internet='".$nuevo_plan."' where usuario='".$checkbox_cambio_internet[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
				
				if(!empty($checkbox_cambio_telefonia))
				{
					for($i=0;$i<count($checkbox_cambio_telefonia);$i++)
					{	
						$nuevo_plan=0;
						$sql="select * from usuario where usuario='".$checkbox_cambio_telefonia[$i]."'";
						$res=$clase->query($sql);
			  			if($fila=mysql_fetch_array($res))
							$nuevo_plan=$fila["cambio_telefonia"];
						
						$sql="update usuario set cambio_telefonia='-1' where usuario='".$checkbox_cambio_telefonia[$i]."'";	
						if($res=$clase->query($sql))
							echo "Cambio del plan de telefonia para el usuario ".$checkbox_cambio_telefonia[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set telefonia='".$nuevo_plan."' where usuario='".$checkbox_cambio_telefonia[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
				
				if(!empty($checkbox_cambio_paquetes))
				{
					for($i=0;$i<count($checkbox_cambio_paquetes);$i++)
					{	
						$nuevo_plan=0;
						$sql="select * from usuario where usuario='".$checkbox_cambio_paquetes[$i]."'";
						$res=$clase->query($sql);
			  			if($fila=mysql_fetch_array($res))
							$nuevo_plan=$fila["cambio_paquetes"];
						
						$sql="update usuario set cambio_paquetes='-1' where usuario='".$checkbox_cambio_paquetes[$i]."'";	
						if($res=$clase->query($sql))
							echo "Cambio de paquete para el usuario ".$checkbox_cambio_paquetes[$i];
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
						
						$sql="update usuario set paquetes='".$nuevo_plan."' where usuario='".$checkbox_cambio_paquetes[$i]."'";
						if($res=$clase->query($sql))
							echo " aprobada.<br>";
						else
							echo "ha ocurrido un error en la aprobacion...".mysql_error();
					}
				}
			}
		  ?>
        <form id="form4" method="post" action="">
          <h3><strong>Autorizacion de cambio/cancelacion de planes o paquetes.</strong></h3>
          <p>&nbsp;</p>
          <table width="100%" border="0">
            <tr>
              <td><h3><strong>Cancelacion de plan o paquete.</strong></h3></td>
              <td><h3><strong>Cambio de plan o paquete.</strong></h3></td>
            </tr>
            <tr>
              <td><?php
			  $cancelar=false;
              $clase=new mysql();
  			  if(!$clase->conectar())
  			  	die("no se logro conectar con la base de datos");
			  $sql="select * from usuario order by usuario";
			  $res=$clase->query($sql);
			  $i=0;
			  echo "<br />";
			  while($fila=mysql_fetch_array($res))
			  {
				if($fila["cambio_television"]==-2)
				{
					$cancelar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cancelar_television[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cancelar_television_'.$i.'" />';
                	echo "Plan de television. Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				
				if($fila["cambio_internet"]==-2)
				{
					$cancelar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cancelar_internet[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cancelar_internet_'.$i.'" />';
                	echo "Plan de internet. Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				
				if($fila["cambio_telefonia"]==-2)
				{
					$cancelar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cancelar_telefonia[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cancelar_telefonia_'.$i.'" />';
                	echo "Plan de telefonia. Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				
				if($fila["cambio_paquetes"]==-2)
				{
					$cancelar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cancelar_paquetes[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cancelar_paquetes_'.$i.'" />';
                	echo "Paquete. Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				$i++;	
  			  }
			  if($cancelar)
			  	echo '<input type="submit" name="boton_cancelar" id="boton_cancelar" value="Autorizar" />';
			  else
			  	echo "No existen cancelaciones por autorizar.";  
  			  ?></td>
              <td><?php
			  $cambiar=false;
              $clase=new mysql();
  			  if(!$clase->conectar())
  			  	die("no se logro conectar con la base de datos");
				
			  $sql="select * from usuario order by usuario";
			  $res=$clase->query($sql);
			  $i=0;
			  echo "<br />";
			  while($fila=mysql_fetch_array($res))
			  {
				if($fila["cambio_television"]>-1)
				{
					$cambiar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cambio_television[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cambio_television_'.$i.'" />';
                	echo "Cambio al plan #ID:".$fila["cambio_television"]." Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				
				if($fila["cambio_internet"]>-1)
				{
					$cambiar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cambio_internet[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cambio_internet_'.$i.'" />';
                	echo "Cambio al plan #ID:".$fila["cambio_internet"]." Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				
				if($fila["cambio_telefonia"]>-1)
				{
					$cambiar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cambio_telefonia[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cambio_telefonia_'.$i.'" />';
                	echo "Cambio al plan #ID:".$fila["cambio_telefonia"]." Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				
				if($fila["cambio_paquetes"]>-1)
				{
					$cambiar=true;
  			  	  	echo "<label>";
                  	echo '<input type="checkbox" name="CheckboxGroup_cambio_paquetes[]" value="'.$fila["usuario"].'" id="CheckboxGroup_cambio_paquetes_'.$i.'" />';
                	echo "Cambio al paquete #ID:".$fila["cambio_paquetes"]." Usuario ".$fila["usuario"].".</label>";
                	echo "<br />";
				}
				$i++;	
  			  }
			  if($cambiar)
			  	 echo '<input type="submit" name="boton_cambiar" id="boton_cambiar" value="Autorizar" />';
			  else
			  	 echo "No existen cambios de planes o paquetes por autorizar.";	  
  			  ?></td>
            </tr>
          </table>
          <p>&nbsp;</p>
        </form>
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
			{
		  ?>
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
					echo "Usuario no registrado o contraseña incorrecta";
			?>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp; </p>
      </form>
      <?php
			}
			else
			{
				if($_SESSION["administrador"]==true)
				{
			?>
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
      <?php
				}
				if($_SESSION["usuario"]==true)
				{	
		?>
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
      <?php
				}
			}
		?>
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
