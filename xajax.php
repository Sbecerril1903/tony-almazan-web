<?php
include_once("config.inc.php");
include_once("xajax_js/xajax.inc.php");
require_once("clases/conecta.class.php");
require_once("clases/usuarios.class.php");
require_once("clases/api.class.php");
require_once("clases/notificacion_correo.class.php");

function email($action,$user_id,$email){
   $oResponse = new xajaxResponse();
   $oCorreo = new Correo();
   $oCorreo->sendMail($email,$user_id,$action);
   $oResponse->addAssign("Llego","innerHTML",$email);
   return $oResponse;
}


function createAcount($name_register,$lastname_register,$phone_register,$email_register,$password){
   $oResponse = new xajaxResponse();
   $oUsuario = new Usuarios();
  echo $email_validacion = $oUsuario->verificarCorreo($email_register);
   if($email_validacion == ""){
      $datos = array($email_register,$password);
      $last_id = $oUsuario->crearUsuario($name_register,$lastname_register,$phone_register,$email_register,$password);
      $id = array("IdUsuario"=>$last_id);
      $oUsuario->iniciarSession($id);
      $oResponse->addScript("alerta('Excelente','Tu cuenta ha sido registrada','success')");
      $oResponse->addScript("location.href='?o=mi-curso'");

   }
   else{
      $oResponse->addScript("alerta('Error','Lo sentimos este correo ya esta registrado','error')");
   }
   return $oResponse;
}


function editAccount($name_register,$lastname_register,$phone_register,$email_register,$user_id){
   $oResponse = new xajaxResponse();
   $oUsuario = new Usuarios();

   echo $user_id;
 
   // if($user_id == ""){
   //    $oUsuario->editarUsuario($name_register,$lastname_register,$phone_register,$email_register,$user_id);
   //    $oResponse->addScript("alerta('Excelente','Tu cuenta ha sido editado','success')");
   // }
   // else{
   //    $oResponse->addScript("alerta('Error','Lo sentimos este correo ya esta registrado','error')");
   // }
   return $oResponse;
}

function login($email_register,$password){
   $oResponse = new xajaxResponse();
   $oUsuario = new Usuarios();
   $array = $oUsuario->verificarSession($email_register,$password);

 // print_r($array["IdUsuario"]);

   if($array["IdUsuario"] != ""){
     $oUsuario->iniciarSession($array["IdUsuario"]);
   }
   else{
      $oResponse->addScript("alerta('Error','Lo sentimos datos incorrectos','error')");
   }

   $oResponse->addAssign("llego","innerHTML",$array);
   return $oResponse;
}

########################################3
$xajax = new xajax();
$xajax->registerFunction("editAccount");
$xajax->registerFunction("createAcount");
$xajax->registerFunction("login");
$xajax->registerFunction("email");
$xajax->processRequests();
?>