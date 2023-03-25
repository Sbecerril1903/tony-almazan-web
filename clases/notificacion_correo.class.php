<?php
//print_r($_SERVER["DOCUMENT_ROOT"]);
require_once('/home4/tonyalma/public_html/plugins/phpmailer/class.phpmailer.php');
include_once ("conecta.class.php");
include_once ("api.class.php");

class Correo {
	var $usuario = array();
	var $root_dir;
	var $mensaje;


	function sendMail($correo,$user_id, $action) {
		$asunto    = "Tony Almazan";
		$cabeceras = 'MIME-Version: 1.0'."\r\n";
		$cabeceras .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
		// Cabeceras adicionales
		$message = $this->messageAction($action,$correo,$user_id);
		$plantilla = $this->plantilla($message);
		$cabeceras .= 'To: Tony Almazan <no-replay@tonyalmazan.com>'."\r\n";
		$this->enviarMail($correo, $asunto, $plantilla	, $cabeceras);
		return $mensaje;
	}

	function plantilla($message) {

		$plantilla = "<!DOCTYPE html PUBLIC '-//W3C//DTD HTML 4.01 Transitional//EN' 'http://www.w3.org/TR/html4/loose.dtd'>
						<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>
						<head>
						<meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
						<meta name='viewport' content='width=device-width, initial-scale=1'> <!-- So that mobile will display zoomed in -->
						<meta http-equiv='X-UA-Compatible' content='IE=edge'> <!-- enable media queries for windows phone 8 -->
						<meta name='format-detection' content='telephone=no'> <!-- disable auto telephone linking in iOS -->
						<meta name='format-detection' content='date=no'> <!-- disable auto date linking in iOS -->
						<meta name='format-detection' content='address=no'> <!-- disable auto address linking in iOS -->
						<meta name='format-detection' content='email=no'> <!-- disable auto email linking in iOS -->
						<title></title>
						<link href='https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,700,700i' rel='stylesheet'>

						<style type='text/css'>
						body {margin:0px !important; padding:0px !important; display:block !important; min-width:100% !important; width:100% !important; -webkit-text-size-adjust:none;}
						table {border-spacing:0; mso-table-lspace:0pt; mso-table-rspace:0pt;}
						table td {border-collapse: collapse;}
						strong {font-weight: bold !important;}
						td img {-ms-interpolation-mode:bicubic; display:block; width:auto; max-width:auto; height:auto; margin:auto;display:block!important;border:0px!important;}
						td p {margin:0 !important; padding:0 !important; display:inline-block !important; font-family:inherit !important;}
						td a {text-decoration:none !important;}
						/*Outlook*/
						.ExternalClass {width: 100%;}
						.ExternalClass,.ExternalClass p,.ExternalClass span,.ExternalClass font,.ExternalClass td,.ExternalClass div {line-height:inherit;}
						.ReadMsgBody {width:100%; background-color: #ffffff;}
						/* iOS BLUE LINKS */
						a[x-apple-data-detectors] {color:inherit !important; text-decoration:none !important; font-size:inherit !important; font-family:inherit !important; font-weight:inherit !important; line-height:inherit !important;} 
						/*Gmail blue links*/
						u + #body a {color:inherit;text-decoration:none;font-size:inherit;font-family:inherit;font-weight:inherit;line-height:inherit;}
						/*Buttons fix*/
						.undoreset a, .undoreset a:hover {text-decoration:none !important;}
						.yshortcuts a {border-bottom:none !important;}
						.ios-footer a {color:#aaaaaa !important;text-decoration:none;}
						/*Responsive*/
						@media screen and (max-width: 800px) {
						  td.img-responsive img {width:100%!important;max-width: 100%!important;height: auto!important;margin: auto;}
						  table.row {width: 100%!important;max-width: 100%!important;}
						  table.center-float, td.center-float {float: none!important;}
						  td.center-text{text-align: center!important;}
						  td.container-padding {width: 100%!important;padding-left: 15px!important;padding-right: 15px!important;}
						  table.hide-mobile, tr.hide-mobile, td.hide-mobile, br.hide-mobile {display: none!important;}
						  td.menu-container {text-align: center !important;}
						  td.autoheight {height: auto!important;}
						  table.mobile-padding {margin: 15px 0!important;}
						}
						</style>
						</head>
						<body id='body' style='margin-top: 0; margin-bottom: 0; padding-top: 0; padding-bottom: 0; width: 100%; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%;' bgcolor='#F4F4F4'>

						<table width='600' border='0' cellpadding='0' cellspacing='0' align='center' class='row' style='width:600px;max-width:600px;'>
						  <tr>
						    <td align='center' valign='top'>

						<table   border='0' width='100%' cellpadding='0' cellspacing='0' align='center' style='width:100%; max-width:100%; background-color:#1E3923;'>
						  <tr> 
						    <td class='title center-text'      valign='middle' align='center' style='font-family:'Poppins',Arial,Helvetica,sans-serif; font-size:32px; line-height:42px; font-weight:lighter;font-style:normal; text-decoration:none;letter-spacing: 0px;'>
						       	   <table border='0' cellpadding='0' cellspacing='0' align='left' class='center-float'>
							        <tr>
							          <td valign='middle' align='center' class='img180'>
							          &nbsp;&nbsp;&nbsp;&nbsp;
							          <img style='display:block;width:100%;max-width:180px;border:0px;' src='https://tonyalmazan.com/assets/tony-almazan.png' width='180'  border='0'   alt='logo'></td>
							        </tr>
							      </table>
						    </td>
						  </tr>
						</table>
						<table border='0' width='100%' align='center' cellpadding='0' cellspacing='0' style='width:100%;max-width:100%;'>
						  <tr>
						    <td valign='middle' align='center' height='40'>&nbsp;</td>
						  </tr>
						</table>

						<table width='600' border='0' cellpadding='0' cellspacing='0' align='center' class='row' style='width:600px;max-width:600px;'>
						  <tr>
						    <td align='center' valign='top' class='container-padding'>
							<table  border='0' cellpadding='0' cellspacing='0' align='center' class='row' >
							  <tr>
							    <td align='center' valign='top' class='container-padding'>
							        $message
							    </td>
							  </tr>
							</table>
						    </td>
						  </tr>
						</table>
						    </td>
						  </tr>
						</table>
						    </td>
						  </tr>
						</table>
						</body>
						</html>";
		return $plantilla;
	}


function messageAction($action,$correo,$user_id){

	$user_id = base64_encode($user_id); 
	switch($action){

		case "register":
			$msg = "Bienvenido a Tony Almazan. Tu cuenta ha sido creada y ya puedes ingresar al sitio para disfrutar de todos los beneficios exclusivos que tenemos para ti. 
				para activar tu cuenta es necesario darle clic <a href='http://localhost/ta/?o=email-validation&id=$user_id'>aquí</a>";
		break;

		default:
			$msg = "Bienvenido a Tony Almazan. Tu cuenta ha sido creada y ya puedes ingresar al sitio para disfrutar de todos los beneficios exclusivos que tenemos para ti.";
		break;
	}
	return $msg;
}

function enviarMail($para, $titulo, $mensaje, $cabeceras) {
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Host     = "mail.monocilindrero.com";
		$mail->Port     = 587;
		$mail->Username = "no-reply@monocilindrero.com";
		$mail->Password = "M0no2022@";
		$mail->From     = "no-reply@monocilindrero.com";
		$mail->FromName = "Tony Almazán - Notificación";
		$mail->AddAddress($para);
		$mail->IsHTML(true);
		$mail->Subject = $titulo;
		$mail->Body    = $mensaje;
		$mail->Send();
	}

}
?>