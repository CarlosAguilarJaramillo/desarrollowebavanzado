<html>
<head>
	<meta charset="utf-8">
	<link href="http://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css">
	<link href="estilo.css" rel="stylesheet" type="text/css">

	<title>Datos de usuario</title>
</head>

<body>

	<?php 

//Abre el archivo y si no existe lo crea
fopen("usuarios.txt", "a");
//Abre el archivo en modo lectura, para consultar los registros
$file = fopen("usuarios.txt", "r");
//Lee los registros linea por linea
while(!feof($file)) {
//Otiene los datos de la linea actual
$fila= fgetss($file);
	if(strlen ($fila)!=0){
	//Separo los datos de la linea en Pipes |
$datos = explode('|', $fila);
	
	//Agrego los datos de la fila en un arreglo bidimensional
	$usuarios[]= array("nombreCompleto" => $datos[0],"email"=> $datos[1],"direccion"=> $datos[2], "telefono"=>$datos[3], "contras"=>$datos[4]);
		
	}
}
	
	if (empty($usuarios)){
		echo "<script type='text/javascript'>alert('Datos incorrectos');window.location.href = 'index.html';</script>";
	}

	echo "<div class='form-style-10'>";
	echo "<h1>Datos del usuario</h1>";
	echo "<table align='center' width='80%' >";
	echo "<tbody>";
foreach($usuarios as $usuario){
	//Busca si existe el email ingresado desde el formulario
	$clave = array_search(trim($_POST['email']), $usuario); 
	
	if (!empty($clave)){
		
		//Valido que la contraseña ingresada desde el formulario sea igual a la del archivo de texto, si es igual muestro los datos del registro previamente encontrado
		if (trim($usuario['contras'])==trim(sha1($_POST['contras']))){
			echo "<tr>";
			echo "<td width='20%' class='header'>Nombre Completo</td>";
			echo "<td width='80%'>".$usuario['nombreCompleto']."</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td width='20%' class='header'>Correo Electrónico</td>";
			echo "<td width='80%'>".$usuario['email']."</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td width='20%' class='header'>Dirección</td>";
			echo "<td width='80%'>".$usuario['direccion']."</td>";
			echo "</tr>";
			
			echo "<tr>";
			echo "<td width='20%' class='header'>Teléfono</td>";
			echo "<td width='80%'>".$usuario['telefono']."</td>";
			echo "</tr>";
			
			
			
			
		}else{
						echo "<script type='text/javascript'>alert('Datos incorrectos');window.location.href = 'index.html';</script>";
		}
		
		
	}
}
	echo " </tbody>";
	echo "</table>";
	echo "<br/><center><a href='index.html' target='_parent'><input name='Cerrar Sesión' type='submit'  formtarget='_parent' value='Cerrar Sesión' /></a></center>";
	echo "</div>";

//cierra el archivo abierto.
fclose($file);
?>
</body>
</html>