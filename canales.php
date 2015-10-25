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
<title>infantcable Editor de canales.</title>
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
        <?php
		  	if(isset($_POST["boton_crear"]))
			{
				if(!empty($_POST["nombre"]))
				{					
					$clase=new mysql();
					if(!$clase->conectar())
						die("no se logro conectar con la base de datos");
			
					$sql="select * from canales where nombre='".$_POST["nombre"]."'";
					$res=$clase->query($sql);
					if($fila=mysql_fetch_array($res))
						echo "Canal ya existe.";
					else
					{	
						//no existe creamos el canal...
						$sql="insert into canales values('".$_POST["nombre"]."','********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-********-')";
						if($res=$clase->query($sql))						
							echo "Canal ".$_POST["nombre"]." creado con exito.";		
						else
							echo "ha ocurrido un error al ingresar...".mysql_error();
					}
				}
				else
					echo "Nombre del canal no puede ser vacio.";	
			}
			
			if(isset($_POST["boton_borrar"]))
			{	
				if(isset($_POST["select"]))
				{			
					$clase=new mysql();
					if(!$clase->conectar())
					die("no se logro conectar con la base de datos");						 
					$sql="DELETE FROM canales WHERE nombre='".$_POST["select"]."'";
					$res=$clase->query($sql);					
					echo "Canal ".$_POST["select"]." eliminado";						
				}
				else
					echo "Debe seleccionar el canal a borrar.";
			}
			
			if(isset($_POST["boton_renombrar"]))
			{
				if(isset($_POST["select"]))
				{			
					$clase=new mysql();
					if(!$clase->conectar())
					die("no se logro conectar con la base de datos");
			
					$sql="select * from canales where nombre='".$_POST["select"]."'";
					$res=$clase->query($sql);
					if($fila=mysql_fetch_array($res))
					{	//actualizamos o modificamos
						$sql="update canales set nombre='".$_POST["renombre"]."' where nombre='".$_POST["select"]."'";
						if($res=$clase->query($sql))
							echo "Canal renombrado";
						else
							echo "ha ocurrido un error al renombrar...".mysql_error();
					}						
				}
				else
					echo "Debe seleccionar el canal a renombrar.";
			}
		  ?>
        <form id="form4" method="post" action="">
          <h3><strong>Editor de canales.</strong> </h3>
          <h3>Crear canal:
            <input name="nombre" type="text" id="nombre" maxlength="30" />
            <input type="submit" name="boton_crear" id="boton_crear" value="Crear" />
          </h3>
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
          </h3>
          <h3>Eliminar selecionado
            <input type="submit" name="boton_borrar" id="boton_borrar" value="Eliminar" />
          </h3>
          <h3>Renombrar seleccionado
            <input name="renombre" type="text" id="renombre" maxlength="30"/>
            <input type="submit" name="boton_renombrar" id="boton_renombrar" value="Renombrar" />
          </h3>
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
