<?php
include_once ("../config.inc.php");
include_once ("conecta.class.php");

class Usuarios {
	var $usuario = array();
	var $root_dir;
	var $mensaje;

	function verificarCorreo($correo) {
		$oConecta = new Conecta();
	  	$query = "SELECT 
					*
				FROM usuario u 
				WHERE Usuario ='$correo'";
				$datos = $oConecta->query($query)->fetchAll();
		return $datos[0];
	}


	function verificarSession($datos) {
		$correo = $datos["email"];
		$pass     = md5($datos["password"]);
		$oConecta = new Conecta();
 	   	$query = "SELECT 
					*
				FROM usuario u 
				WHERE Usuario ='$correo' 
				AND Contrasena = '$pass'";
				$datos = $oConecta->query($query)->fetchAll();
		return $datos[0];
	}
	
	function iniciarSession($datos){

		$user_id = $datos["IdUsuario"];
		
 		if($user_id != "") {
 		 	session_start();
 			$_SESSION["sessionIdUsuario"] = $user_id;
 			$_SESSION["Curso"] = $datos["Curso"];
 			$_SESSION["Certificado"] = $$datos["Certificado"];
			$_SESSION["user_data"] = $datos;
			return $datos["Curso"];
		}
		else{
			return false;
 		}

	}

	function actualizarCurso($id) {
		$correo = $datos["email"];
		$pass     = md5($datos["password"]);
		$oConecta = new Conecta();
		$fecha = date("Y-m-d  H:i:s");
 	   	$query = "UPDATE usuario u 
 	   			SET Curso = 1,
 	   			Fecha_pago = '$fecha'
				WHERE IdUsuario ='$id'";
				$datos = $oConecta->query($query);
		return true;
	}

	function datosUsuario($id) {
		$oConecta = new Conecta();
		$query    = "SELECT * FROM usuario WHERE IdUsuario=$id";
		$datos = $oConecta->query($query)->fetchAll();
		return $datos[0];
	}

	function activa() {
		session_start();
		$sessionIdUsuario = $_SESSION["sessionIdUsuario"];
		$datos = $_SESSION["user_data"];
		$datos["Curso"];

		if ($sessionIdUsuario == "") {
			header("Location: /");
			die;
		} 

		

	}


	function crearUsuario($name_register,$lastname_register,$phone_register,$email_register,$password){
		$oConecta = new Conecta();
		$fecha = date("Y-m-d H:i:s");
		$password = md5($password);
	 	$query    = "INSERT INTO usuario
							(Usuario,
							 Contrasena,
							 Nombre,
							 Correo,
							 idTipoUsuario,
							 Status,
							 Apellido,
							 Telefono,
							 Registro) 
					  VALUES('$email_register',
					  		 '$password',
					  		 '$name_register',
					  		 '$email_register',
					  		 '4',
					  		 '1',
					  		 '$lastname_register',
					  		 '$phone_register',
					  		 '$fecha'
					  		 )";
	    $oConecta->query($query);


		$last_id = $oConecta->lastInsertID();
		$_SESSION["sessionIdUsuario"] = $last_id;
		$_SESSION["Curso"] = 0;
		$_SESSION["Certificado"] = 0;
		$_SESSION["user_data"] = $datos;
		sleep(1);
		return $last_id ;
	}

	function editarUsuario($datos){
		$oConecta = new Conecta();
		$name_register = $datos["name_register"];
		$lastname_register = $datos["last_name_register"];
		$phone_register = $datos["phone_register"];
		$email_register = $datos["email_register"];
		$user_id = $datos["user_id"];

	 	$query    = "UPDATE usuario
							SET Usuario = '$email_register',
							 Nombre = '$name_register',
							 Correo = '$lastname_register',
							 Apellido = '$phone_register',
							 Telefono = '$phone_register'
					 WHERE IdUsuario = '$user_id'";
		$datos = $oConecta->query($query);
		return $user_id;
	}

	function killerSession() {
		session_destroy();

		unset($_SESSION);
		session_destroy();

	//	header("Location: ?o=cerrarSession");
	}

 }
?>