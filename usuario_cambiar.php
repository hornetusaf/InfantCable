<?php
include("conectar.php");
	session_start();
	if(!$_SESSION["usuario"])
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
<title>infantcable Cambiar planes o paquetes.</title>
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
          <p>
            <?php			
			if(isset($_POST["boton_cambiar_television"]))
			{
				$clase=new mysql();
  				if(!$clase->conectar())
  			  		die("no se logro conectar con la base de datos");								  	
				$sql="update usuario set cambio_television='".$_POST["select_television"]."' where usuario='".$_SESSION["nombre_usuario"]."'";
				if($res=$clase->query($sql))
					echo "Solicitud de cambio del plan de television actual al plan #ID: ".$_POST["select_television"]." enviada.";
				else
					echo "ha ocurrido un error en la solicitud...".mysql_error();				
			}
			
			if(isset($_POST["boton_cambiar_internet"]))
			{
				$clase=new mysql();
  				if(!$clase->conectar())
  			  		die("no se logro conectar con la base de datos");								  	
				$sql="update usuario set cambio_internet='".$_POST["select_internet"]."' where usuario='".$_SESSION["nombre_usuario"]."'";
				if($res=$clase->query($sql))
					echo "Solicitud de cambio del plan de internet actual al plan #ID: ".$_POST["select_internet"]." enviada.";
				else
					echo "ha ocurrido un error en la solicitud...".mysql_error();
			}
			
			if(isset($_POST["boton_cambiar_telefonia"]))
			{
				$clase=new mysql();
  				if(!$clase->conectar())
  			  		die("no se logro conectar con la base de datos");								  	
				$sql="update usuario set cambio_telefonia='".$_POST["select_telefonia"]."' where usuario='".$_SESSION["nombre_usuario"]."'";
				if($res=$clase->query($sql))
					echo "Solicitud de cambio del plan de telefonia actual al plan #ID: ".$_POST["select_telefonia"]." enviada.";
				else
					echo "ha ocurrido un error en la solicitud...".mysql_error();
			}
			
			if(isset($_POST["boton_cambiar_paquetes"]))
			{
				$clase=new mysql();
  				if(!$clase->conectar())
  			  		die("no se logro conectar con la base de datos");								  	
				$sql="update usuario set cambio_paquetes='".$_POST["select_paquetes"]."' where usuario='".$_SESSION["nombre_usuario"]."'";
				if($res=$clase->query($sql))
					echo "Solicitud de cambio del paquete actual al paquete #ID: ".$_POST["select_paquetes"]." enviada.";
				else
					echo "ha ocurrido un error en la solicitud...".mysql_error();
			}
			
			$television=false;
			$internet=false;
			$telefonia=false;
			$paquetes=false;
				
			$clase=new mysql();
  			if(!$clase->conectar())
  			  	die("no se logro conectar con la base de datos");
			  	
			$sql="select * from usuario where usuario='".$_SESSION["nombre_usuario"]."'";
			$res=$clase->query($sql);
			if($fila1=mysql_fetch_array($res))
			{
				if($fila1["television"]>-1)
					$television=true;
				if($fila1["internet"]>-1)
					$internet=true;
				if($fila1["telefonia"]>-1)
					$telefonia=true;
				if($fila1["paquetes"]>-1)
					$paquetes=true;
			}						
			?>
          </p>
          <table border="0">
            <tr>
              <td><h3><strong>Cambiar planes o paquetes.</strong></h3>
                <p>&nbsp;</p>
                <p>Refierase a la pagina correspondiente para obtener el #ID del nuevo plan o paquete al que desea cambiar.</p></td>
            </tr>
            <tr>
              <td><h3>
                  <?php
                    if($television)
					{
						echo '<a href="television.php">Television</a>&nbsp; #ID:';
						echo '<select name="select_television" size="1" id="select_television">';              			
             			$clase=new mysql();
  			  			if(!$clase->conectar())
  			  				die("no se logro conectar con la base de datos");
			 			$sql="select * from television order by id";
			  			$res=$clase->query($sql);
			  			while($fila=mysql_fetch_array($res))
			  			{  			  			
							echo "<option>".$fila["id"]."</option>";
  			  			}  			  
	          			echo '</select>';
						echo '&nbsp;<input type="submit" name="boton_cambiar_television" id="boton_cambiar_television" value="Cambiar" />';
						if($fila1["cambio_television"]>-1)
							echo "&nbsp; Esperando autorizacion...";						
					}
                  ?>
                </h3></td>
            </tr>
            <tr>
              <td><h3>
                  <?php
                    if($internet)
                    {
						echo '<a href="internet.php">Internet</a>&nbsp; #ID:';
						echo '<select name="select_internet" size="1" id="select_internet">';              			
             			$clase=new mysql();
  			  			if(!$clase->conectar())
  			  				die("no se logro conectar con la base de datos");
			 			$sql="select * from internet order by id";
			  			$res=$clase->query($sql);
			  			while($fila=mysql_fetch_array($res))
			  			{  			  			
							echo "<option>".$fila["id"]."</option>";
  			  			}  			  
	          			echo '</select>';
						echo '&nbsp;<input type="submit" name="boton_cambiar_internet" id="boton_cambiar_internet" value="Cambiar" />';
						if($fila1["cambio_internet"]>-1)
							echo "&nbsp; Esperando autorizacion...";						
					}
                  ?>
                </h3></td>
            </tr>
            <tr>
              <td><h3>
                  <?php
                    if($telefonia)
                    {
						echo '<a href="telefonia.php">Telefonia</a>&nbsp; #ID:';
						echo '<select name="select_telefonia" size="1" id="select_telefonia">';              			
             			$clase=new mysql();
  			  			if(!$clase->conectar())
  			  				die("no se logro conectar con la base de datos");
			 			$sql="select * from telefonia order by id";
			  			$res=$clase->query($sql);
			  			while($fila=mysql_fetch_array($res))
			  			{  			  			
							echo "<option>".$fila["id"]."</option>";
  			  			}  			  
	          			echo '</select>';
						echo '&nbsp;<input type="submit" name="boton_cambiar_telefonia" id="boton_cambiar_telefonia" value="Cambiar" />';
						if($fila1["cambio_telefonia"]>-1)
							echo "&nbsp; Esperando autorizacion...";						
					}
                  ?>
                </h3></td>
            </tr>
            <tr>
              <td><h3>
                  <?php
                    if($paquetes)
                    {
						echo '<a href="paquetes.php">Paquetes</a>&nbsp; #ID:';
						echo '<select name="select_paquetes" size="1" id="select_paquetes">';              			
             			$clase=new mysql();
  			  			if(!$clase->conectar())
  			  				die("no se logro conectar con la base de datos");
			 			$sql="select * from paquetes order by id";
			  			$res=$clase->query($sql);
			  			while($fila=mysql_fetch_array($res))
			  			{  			  			
							echo "<option>".$fila["id"]."</option>";
  			  			}  			  
	          			echo '</select>';
						echo '&nbsp;<input type="submit" name="boton_cambiar_paquetes" id="boton_cambiar_paquetes" value="Cambiar" />';
						if($fila1["cambio_paquetes"]>-1)
							echo "&nbsp; Esperando autorizacion...";						
					}
                  ?>
                </h3></td>
            </tr>
          </table>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
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
