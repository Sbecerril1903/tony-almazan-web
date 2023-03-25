<?php
include_once ("../config.inc.php");
include_once ("conecta.class.php");

class Cursos {
	
	function modulos() {
		$oConecta = new Conecta();
	  	$query = "SELECT 
					*
				FROM modulos m 
				ORDER BY m.id ASC";
		$datos = $oConecta->query($query)->fetchAll();

		foreach ($datos as $data) {
			$titulo = $data["title"];
			$modulo_id = $data["id"];
			$pdf_file = $data["pdf_file"];

			$enlaces_videos = $this->moduloVideos($modulo_id);
			$video_url = "https://tonyalmazan.s3.amazonaws.com/";

			if($pdf_file != ""){

				$complemento = "<li>
									<div class='row'>
										<div class='col-12 text-right' style='font-size: 12px; padding-top: 10px; padding-bottom: 10px;'>
											Complemento de clase
										</div>
									</div>
									<div class='row'>
										<div class='col-12 text-right' style='font-size: 14px;'>
											<a href='assets/videos/cursos/$pdf_file' style='color:red;' target ='_blank'>
												<i class='fas fa-file-pdf' style='font-size: 16px;'></i> Descargar
											</a>
										</div>
									</div>
								</li>";
			}else{
				$complemento = "";
			}

			$modulos .= "<li style='padding-top:5px; padding-bottom:5px'>
							<div class='card'>
							<div class='card-body'>
								<b>$titulo</b><br>
									<ul>
										<li>
											$enlaces_videos
										</li>
											$complemento
									</ul>
								</div>
							</div>
						</li>";
		}
		return $modulos;
	}

	function moduloVideos($modulo_id){
		$oConecta = new Conecta();
	 	$query = "SELECT 
					*
				FROM modulo_video m 
				WHERE modulo_id = $modulo_id
				ORDER BY m.id ASC";
		$datos = $oConecta->query($query)->fetchAll();

		foreach ($datos as $data) {
			$title = $data["title"];
			$time = $data["time"];
			$modulo_id = $data["modulo_id"];
			$video_file = $data["video_file"];
			$portada = $data["portada"];
			$video .= "<div class='row' style='padding-bottom:5px; padding-top:5px'>
						<div class='col-8' style='font-size: 13px; color:black'><a href='#' onclick=\"pasarvideo('$modulo_id','$video_file','$portada')\" 	style='font-size: 14px; color:black'><i class='far fa-play'></i> $title</a></div>
						<div class='col-4' style='font-size: 13px;color:grey'><i class='fas fa-clock'></i> $time</div>
					</div>";
		}

		return $video;
	}

	function videos() {
		$oConecta = new Conecta();
	  	$query = "SELECT 
					*
				FROM modulo_video m 
				ORDER BY m.id ASC";
		$datos = $oConecta->query($query)->fetchAll();

		foreach ($datos as $data) {
			$video_file = $data["video_file"];
			$modulo_id = $data["id"];
			$portada = $data["portada"];
			$video_url = "https://tonyalmazan.s3.amazonaws.com/$video_file";
			if($modulo_id == 1){
				$display =" style=''";
			}
			else{
				$display =" style='display:none;'";
			}
			$videos .= "<video
							$display
		                    id='video_$modulo_id'
		                    name='video_$modulo_id'
		                    class='video-js'
		                    controls
		                    onseeking='catchTime(this.currentTime,$modulo_id)'
		                    onplay='catchTime(this.currentTime,$modulo_id)'
		                    onpause='catchTime(this.currentTime,$modulo_id)'
		                    width='780'
		                    poster='assets/portadas/$portada'
		                    data-setup='{}'
		                    src='$video_url'
		                  >
		                </video>";
		}
		return $videos;
	}


	function datosUsuario($id) {
			$oConecta = new Conecta();
			$query    = "SELECT * FROM usuarios WHERE id_usuario=$id";
			$datos = $oConecta->query($query)->fetchAll();
			return $datos[0];
		}
	}
?>