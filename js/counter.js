var centesimas = 0;
var segundos = 0;
var minutos = 0;
var horas = 0;


function catchTime(time, modulo_id) {
    let counter =  $("#tiempo").val(time)
    let video_estatus = $("#video_estatus").val()

    let video = $("#video_id").val()
    $("#boton").click()

    if(video_estatus == 0){
        $("#video_estatus").val(1)
        

        
        //saveTimeVideo(video)
    }
    else if(video_estatus == 1){

         $("#video_estatus").val(0)
         //saveTimeVideo(video)
    }
}



function inicio () {
//  playVideo()
  control = setInterval(cronometro,10)
}

function parar () {
  clearInterval(control)
}

function reinicio () {
  clearInterval(control);
  console.log(cronometro)
  centesimas = 0;
  segundos = 0;
  minutos = 0;
  horas = 0;
  Centesimas.innerHTML = ":00";
  Segundos.innerHTML = ":00";
  Minutos.innerHTML = ":00";
  Horas.innerHTML = "00";
  document.getElementById("inicio").disabled = false;
  document.getElementById("parar").disabled = true;
  document.getElementById("continuar").disabled = true;
  document.getElementById("reinicio").disabled = true;
}

function cronometro () {
  if (centesimas < 99) {
    centesimas++;
    if (centesimas < 10) { centesimas = "0"+centesimas }
   // Centesimas.innerHTML = ":"+centesimas;
  }
  if (centesimas == 99) {
    centesimas = -1;
  }
  if (centesimas == 0) {
    segundos ++;
    if (segundos < 10) { segundos = "0"+segundos }
 //   Segundos.innerHTML = ":"+segundos;
  }
  if (segundos == 59) {
    segundos = -1;
  }
  if ( (centesimas == 0)&&(segundos == 0) ) {
    minutos++;
    if (minutos < 10) { minutos = "0"+minutos }
   // Minutos.innerHTML = ":"+minutos;
  }
  if (minutos == 59) {
    minutos = -1;
  }
  if ( (centesimas == 0)&&(segundos == 0)&&(minutos == 0) ) {
    horas ++;
    if (horas < 10) { horas = "0"+horas }
   // Horas.innerHTML = horas;
  }

  $("#tiempo").val(minutos+":"+segundos)
}