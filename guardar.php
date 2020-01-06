<?php

//Abre el archivo y si no eciste lo crea
fopen( "usuarios.txt", "a" );
//Abre el archivo en modo lectura, para consultar los registros
$file = fopen( "usuarios.txt", "r" );
//Lee los registros linea por linea
while ( !feof( $file ) ) {
	//Otiene los datos de la linea actial
	$fila = fgetss( $file );
	//Separo los datos de la linea en Pipes |
	$datos = explode( '|', $fila );
	// Verifica si la posición uno (email) existe en el archivo, si ya existe sale del script y muestra una alerta, si no existe continua con el registro
	if ( $datos[ 1 ] == $_POST[ "email" ] ) {
		echo "<script type='text/javascript'>alert('El usuario ingresado ya existe');window.location.href = 'registro.html';</script>";
		exit();
	}

}
//cierra el archivo abierto.
fclose( $file );






/**
 *LA siguiente variable permite crear un archivo de texto llamado usuario.txt,
 *el parametro a: Abre el archivo para sólo escritura. La escritura comenzará al final del archivo sin eliminar el contenido previo existente. Si el fichero no existe se intenta crear. Si por alguna razón
 *no se puede guardar mostrara una leyenda de error**/
$archivo = fopen( "usuarios.txt", "a" );

//Declaración de la variable nombreCompleto, que contiene el nombre con apellidos del usuario
$nombreCompleto = $_POST[ "nombreCompleto" ];

//Declaración de la variable email, que contiene el correo electrónico del usuario
$email = $_POST[ "email" ];
//Declaración de la variable direccion, que contiene la dirección del usuario
$direccion = $_POST[ "direccion" ];
//Declaración de la variable teléfono, que contiene el teléfono del usuario
$tel = $_POST[ "tel" ];
//Declaración de la variable contras, que contiene la primer contraseña escrita por el usuario
$contras = $_POST[ "contras" ];
//Declaración de la variable contrasdos, que contiene la segunda contraseña escrita por el usuario, que nos permitira validar que sea igual que la primera
$contrasdos = $_POST[ "contrasdos" ];

if ( $contras != $contrasdos ) {
	echo "<script type='text/javascript'>alert('Las contraseñas no coinciden, favor de verificarlas');window.location.href = 'registro.html';</script>";


} else {


	//Permite crear el archivo si no existe y escribir los datos del usuario escritos en el formulario

	fwrite( $archivo, $nombreCompleto );
	fwrite( $archivo, "|" );
	fwrite( $archivo, $email );
	fwrite( $archivo, "|" );
	fwrite( $archivo, $direccion );
	fwrite( $archivo, "|" );
	fwrite( $archivo, $tel );
	fwrite( $archivo, "|" );
	fwrite( $archivo, sha1(trim($contrasdos ))); 
	fwrite( $archivo, "\n" );

		fclose( $archivo );
		//Muestra una alerta donde nos indica que el usuario se ha regisrado de forma correcta
		echo "<script type='text/javascript'>alert('Usuario creado exitosamente, ahora puede iniciar sesión');window.location.href = 'index.html';</script>";
	}
	?>