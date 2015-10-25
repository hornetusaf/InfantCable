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
<title>infantcable Crear planes o paquetes</title>
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
        <p> <strong>Crear planes o paquetes.</strong>
        <form id="form4" method="post" action="">
          <p>Tipo de plan a crear:
            <select name="select" size="1" id="select">
              <?php      
  			  	if(isset($_POST["select"]) && $_POST["select"]=="Telefonia")
      		  		echo "<option selected='selected'>Telefonia</option>";
				else
					echo "<option>Telefonia</option>";
					
				if(isset($_POST["select"]) && $_POST["select"]=="Internet")
      		  		echo "<option selected='selected'>Internet</option>";
				else
					echo "<option>Internet</option>";
					
				if(isset($_POST["select"]) && $_POST["select"]=="Television")
      		  		echo "<option selected='selected'>Television</option>";
				else
					echo "<option>Television</option>";
					
				if(isset($_POST["select"]) && $_POST["select"]=="Paquetes")
      		  		echo "<option selected='selected'>Paquetes</option>";
				else
					echo "<option>Paquetes</option>";  			  
  			  ?>
            </select>
            <input type="submit" name="boton_aceptar" id="boton_aceptar" value="Aceptar" />
          </p>
          <?php
		if(isset($_POST["boton_aceptar"]) || isset($_POST["boton_telefonia"]) || isset($_POST["boton_internet"]) || isset($_POST["boton_television"]) || isset($_POST["boton_paquetes"]))
		{
			if($_POST["select"]=="Telefonia" || isset($_POST["boton_telefonia"]))
			{
				if(isset($_POST["boton_telefonia"]))
				{
					if(!empty($_POST["id_telefonia"]) && !empty($_POST["nombre_telefonia"]) && !empty($_POST["descripcion_telefonia"]) && !empty($_POST["minutos_telefonia"]) && !empty($_POST["precio_telefonia"]) && is_numeric($_POST["precio_telefonia"]) && is_numeric($_POST["id_telefonia"]))
					{					
						$clase=new mysql();
						if(!$clase->conectar())
							die("no se logro conectar con la base de datos");
			
						$sql="select * from telefonia where id='".$_POST["id_telefonia"]."'";
						$res=$clase->query($sql);
						if($fila=mysql_fetch_array($res))
							echo "Plan ya existe.";
						else
						{	
							//no existe creamos el plan...
							$sql="insert into telefonia values('".$_POST["id_telefonia"]."','".$_POST["nombre_telefonia"]."','".$_POST["descripcion_telefonia"]."','".$_POST["minutos_telefonia"]."','".$_POST["precio_telefonia"]."')";
							if($res=$clase->query($sql))
							{
								echo "Plan ".$_POST["nombre_telefonia"]." creado con exito.";																
							}																
							else
								echo "ha ocurrido un error al ingresar...".mysql_error();
						}
					}
					else
						echo "Todos los campos son requeridos. #ID y Precio son numericos.";		
				}
				?>
          <h3>Telefonia.</h3>
          <table border="0">
            <tr>
              <td><h3>#ID</h3></td>
              <td><input name="id_telefonia" type="text" id="id_telefonia" size="70" maxlength="5" /></td>
            </tr>
            <tr>
              <td><h3>Nombre:</h3></td>
              <td><input name="nombre_telefonia" type="text" id="nombre_telefonia" size="70" maxlength="30" /></td>
            </tr>
            <tr>
              <td><h3>Descripcion:</h3></td>
              <td><input name="descripcion_telefonia" type="text" id="descripcion_telefonia" size="70" maxlength="255" /></td>
            </tr>
            <tr>
              <td><h3>minutos:</h3></td>
              <td><input name="minutos_telefonia" type="text" id="minutos_telefonia" size="70" maxlength="10" /></td>
            </tr>
            <tr>
              <td><h3>Precio:</h3></td>
              <td><input name="precio_telefonia" type="text" id="precio_telefonia" size="70" maxlength="10" /></td>
            </tr>
            <tr>
              <td colspan="2"><h3>
                  <input type="submit" name="boton_telefonia" id="boton_telefonia" value="Crear" />
                </h3></td>
            </tr>
          </table>
          <?php
			}			
			if($_POST["select"]=="Television" || isset($_POST["boton_television"]))
			{
				if(isset($_POST["boton_television"]))
				{
					$checkbox=$_POST["CheckboxGroup1"];
					if(!empty($_POST["id_television"]) && !empty($_POST["nombre_television"]) && !empty($_POST["descripcion_television"]) && !empty($_POST["precio_television"]) && !empty($checkbox) && is_numeric($_POST["precio_television"]) && is_numeric($_POST["id_television"]))
					{						
						$array="";
						for($i=0;$i<count($checkbox);$i++)
						{	
							$array=$array.$checkbox[$i]."-";													
						}
										
						$clase=new mysql();
						if(!$clase->conectar())
							die("no se logro conectar con la base de datos");
			
						$sql="select * from television where id='".$_POST["id_television"]."'";
						$res=$clase->query($sql);
						if($fila=mysql_fetch_array($res))
							echo "Plan ya existe.";
						else
						{	
							//no existe creamos el plan...
							$sql="insert into television values('".$_POST["id_television"]."','".$_POST["nombre_television"]."','".$_POST["descripcion_television"]."','".$array."','".$_POST["precio_television"]."')";
							if($res=$clase->query($sql))
							{
								echo "Plan ".$_POST["nombre_television"]." creado con exito.";																
							}																
							else
								echo "ha ocurrido un error al ingresar...".mysql_error();
						}
					}
					else
						echo "Todos los campos son requeridos. #ID y Precio son numericos, debe seleccionar al menos un canal.";		
				}
				?>
          <h3>Television.</h3>
          <table border="0">
            <tr>
              <td><h3>#ID</h3></td>
              <td><input name="id_television" type="text" id="id_television" size="70" maxlength="5" /></td>
            </tr>
            <tr>
              <td><h3>Nombre:</h3></td>
              <td><input name="nombre_television" type="text" id="nombre_television" size="70" maxlength="30" /></td>
            </tr>
            <tr>
              <td><h3>Descripcion:</h3></td>
              <td><input name="descripcion_television" type="text" id="descripcion_television" size="70" maxlength="255" /></td>
            </tr>
            <tr>
              <td><h3>Canales:</h3></td>
              <td><?php
			  $clase=new mysql();
  			  if(!$clase->conectar())
  			  	die("no se logro conectar con la base de datos");
			  $sql="select * from canales order by nombre";
			  $res=$clase->query($sql);
			  $i=0;
			  echo "<br />";
			  while($fila=mysql_fetch_array($res))
			  {
  			  	echo "<label>";
                echo '<input type="checkbox" name="CheckboxGroup1[]" value="'.$fila["nombre"].'" id="CheckboxGroup1_'.$i.'" />';
                echo $fila["nombre"]."</label>";
                echo "<br />";
				$i++;	
  			  }  
			  ?></td>
            </tr>
            <tr>
              <td><h3>Precio:</h3></td>
              <td><input name="precio_television" type="text" id="precio_television" size="70" maxlength="10" /></td>
            </tr>
            <tr>
              <td colspan="2"><h3>
                  <input type="submit" name="boton_television" id="boton_television" value="Crear" />
                </h3></td>
            </tr>
          </table>
          <?php
			}			
			if($_POST["select"]=="Internet" || isset($_POST["boton_internet"]))
			{
				if(isset($_POST["boton_internet"]))
				{
					if(!empty($_POST["id_internet"]) && !empty($_POST["nombre_internet"]) && !empty($_POST["descripcion_internet"]) && !empty($_POST["velocidad_internet"]) && !empty($_POST["precio_internet"]) && is_numeric($_POST["precio_internet"]) && is_numeric($_POST["id_internet"]) && is_numeric($_POST["velocidad_internet"]))
					{					
						$clase=new mysql();
						if(!$clase->conectar())
							die("no se logro conectar con la base de datos");
			
						$sql="select * from internet where id='".$_POST["id_internet"]."'";
						$res=$clase->query($sql);
						if($fila=mysql_fetch_array($res))
							echo "Plan ya existe.";
						else
						{	
							//no existe creamos el plan...
							$sql="insert into internet values('".$_POST["id_internet"]."','".$_POST["nombre_internet"]."','".$_POST["descripcion_internet"]."','".$_POST["velocidad_internet"]."','".$_POST["precio_internet"]."')";
							if($res=$clase->query($sql))
							{
								echo "Plan ".$_POST["nombre_internet"]." creado con exito.";																
							}																
							else
								echo "ha ocurrido un error al ingresar...".mysql_error();
						}
					}
					else
						echo "Todos los campos son requeridos. #ID, Precio y Velocidad son numericos.";		
				}
				?>
          <h3>Internet.</h3>
          <table border="0">
            <tr>
              <td><h3>#ID</h3></td>
              <td><input name="id_internet" type="text" id="id_internet" size="70" maxlength="5" /></td>
            </tr>
            <tr>
              <td><h3>Nombre:</h3></td>
              <td><input name="nombre_internet" type="text" id="nombre_internet" size="70" maxlength="30" /></td>
            </tr>
            <tr>
              <td><h3>Descripcion:</h3></td>
              <td><input name="descripcion_internet" type="text" id="descripcion_internet" size="70" maxlength="255" /></td>
            </tr>
            <tr>
              <td><h3>Velocidad:</h3></td>
              <td><input name="velocidad_internet" type="text" id="velocidad_internet" size="70" maxlength="10" /></td>
            </tr>
            <tr>
              <td><h3>Precio:</h3></td>
              <td><input name="precio_internet" type="text" id="precio_internet" size="70" maxlength="10" /></td>
            </tr>
            <tr>
              <td colspan="2"><h3>
                  <input type="submit" name="boton_internet" id="boton_internet" value="Crear" />
                </h3></td>
            </tr>
          </table>
          <?php
			}			
			if($_POST["select"]=="Paquetes" || isset($_POST["boton_paquetes"]))
			{
				
				if(isset($_POST["boton_paquetes"]))
				{
					//$checkbox=$_POST["RadioGroup1"];
					if(!empty($_POST["id_paquetes"]) && !empty($_POST["nombre_paquetes"]) && !empty($_POST["descripcion_paquetes"]) && !empty($_POST["precio_paquetes"]) && (count($_POST["RadioGroup1"])+count($_POST["RadioGroup2"])+count($_POST["RadioGroup3"]))>1 &&  is_numeric($_POST["precio_paquetes"]) && is_numeric($_POST["id_paquetes"]))
					{	
						
						$array="";
						for($i=0;$i<(count($_POST["RadioGroup1"]));$i++)
						{	
							$array=$array.$_POST["RadioGroup1"][$i]."-";													
						}
						for($i=0;$i<(count($_POST["RadioGroup2"]));$i++)
						{	
							$array=$array.$_POST["RadioGroup2"][$i]."-";													
						}
						for($i=0;$i<(count($_POST["RadioGroup3"]));$i++)
						{	
							$array=$array.$_POST["RadioGroup3"][$i]."-";													
						}
										
						$clase=new mysql();
						if(!$clase->conectar())
							die("no se logro conectar con la base de datos");
			
						$sql="select * from paquetes where id='".$_POST["id_paquetes"]."'";
						$res=$clase->query($sql);
						if($fila=mysql_fetch_array($res))
							echo "Plan ya existe.";
						else
						{	
							//no existe creamos el plan...
							$sql="insert into paquetes values('".$_POST["id_paquetes"]."','".$_POST["nombre_paquetes"]."','".$_POST["descripcion_paquetes"]."','".$array."','".$_POST["precio_paquetes"]."','".count($_POST["RadioGroup1"])."','".count($_POST["RadioGroup2"])."','".count($_POST["RadioGroup3"])."')";
							if($res=$clase->query($sql))
							{
								echo "Paquete ".$_POST["nombre_paquetes"]." creado con exito.";																
							}																
							else
								echo "ha ocurrido un error al ingresar...".mysql_error();
						}
					}
					else
						echo "Todos los campos son requeridos. #ID y Precio son numericos. debe seleccionar al menos dos planes.";		
				}
				?>
          <h3>Paquetes.</h3>
          <table border="0">
            <tr>
              <td><h3>#ID</h3></td>
              <td><input name="id_paquetes" type="text" id="id_paquetes" size="70" maxlength="5" /></td>
            </tr>
            <tr>
              <td><h3>Nombre:</h3></td>
              <td><input name="nombre_paquetes" type="text" id="nombre_paquetes" size="70" maxlength="30" /></td>
            </tr>
            <tr>
              <td><h3>Descripcion:</h3></td>
              <td><input name="descripcion_paquetes" type="text" id="descripcion_paquetes" size="70" maxlength="255" /></td>
            </tr>
            <tr>
              <td><h3>Planes:</h3></td>
              <td><?php
			  $clase=new mysql();
  			  if(!$clase->conectar())
  			  	die("no se logro conectar con la base de datos");
			  $sql="select * from telefonia order by nombre";
			  $res=$clase->query($sql);
			  $i=0;
			  echo "Planes de Telefonia<br />";
			  while($fila=mysql_fetch_array($res))
			  {
  			  	echo "<label>";
                echo '<input type="radio" name="RadioGroup1[]" value="'.$fila["nombre"].'" id="RadioGroup1_'.$i.'" />';
                echo $fila["nombre"]."</label>";
                echo "<br />";
				$i++;	
  			  }
			  
			  $sql="select * from internet order by nombre";
			  $res=$clase->query($sql);
			  echo "Planes de Internet<br />";
			  while($fila=mysql_fetch_array($res))
			  {
  			  	echo "<label>";
                echo '<input type="radio" name="RadioGroup2[]" value="'.$fila["nombre"].'" id="RadioGroup1_'.$i.'" />';
                echo $fila["nombre"]."</label>";
                echo "<br />";
				$i++;	
  			  }
			  
			  $sql="select * from television order by nombre";
			  $res=$clase->query($sql);
			  echo "Planes de Television<br />";
			  while($fila=mysql_fetch_array($res))
			  {
  			  	echo "<label>";
                echo '<input type="radio" name="RadioGroup3[]" value="'.$fila["nombre"].'" id="RadioGroup1_'.$i.'" />';
                echo $fila["nombre"]."</label>";
                echo "<br />";
				$i++;	
  			  }			    
			  ?></td>
            </tr>
            <tr>
              <td><h3>Precio:</h3></td>
              <td><input name="precio_paquetes" type="text" id="precio_paquetes" size="70" maxlength="10" /></td>
            </tr>
            <tr>
              <td colspan="2"><h3>
                  <input type="submit" name="boton_paquetes" id="boton_paquetes" value="Crear" />
                </h3></td>
            </tr>
          </table>
          <?php
			}
		}	
	?>
        </form>
        <p>&nbsp;</p>
        <p>&nbsp; </p>
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
