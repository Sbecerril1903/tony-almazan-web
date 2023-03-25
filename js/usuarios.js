function editarUsuario(){
    let user_id  = $("#user_id").val()
    let email_register  = $("#email_profile").val()
    let last_name_register = $("#lastname_profile").val()
    let name_register = $("#name_profile").val()
    let phone_register =$("#phone_profile").val()
   
    if(name_register == ""){
        alerta("Lo sentimos","Por favor ingresa tu nombre","error")
        return
    }

    if(lastname_register == ""){
        alerta("Lo sentimos","Por favor ingresa tu Apellido","error")
        return
    }

    if(phone_register == ""){
        alerta("Lo sentimos","Por favor ingresa tu teléfono","error")
        return
    }

    if(email_register == ""){
        alerta("Lo sentimos","Por favor ingresa tu email","error")
        return
    }

    let isEmail = validationEmail(email_register)

    if(isEmail == false){
        alerta("Lo sentimos","Por favor ingresa email valido 1","error")
        return
    }


    	let values = {
    		user_id: user_id,
    		name_register: name_register,
    		last_name_register: last_name_register,
    		email_register:email_register,
    		phone_register:phone_register
    	}


   	$.ajax({
        url: "index.php?o=editClient",
        type: "post",
        data: values ,
        success: function (response) {
            
            


        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
   alerta("Excelente","Los cambios efectuados realizados con exito","success")
};


function formulario_session(tipo){

	switch(tipo){
		case 0:
			$("#label_register").hide()
			$("#label_login").hide()
			$("#label_recover").show()

			$("#form_register").hide()
			$("#form_login").hide()
			$("#form_repassword").show()
		break;
		case 1:
			$("#label_register").hide()
			$("#label_login").show()
			$("#label_recover").hide()

			$("#form_register").hide()
			$("#form_login").show()
			$("#form_repassword").hide()
		break;
		case 2:
			$("#label_register").show()
			$("#label_login").hide()
			$("#label_recover").hide()

			$("#form_register").show()
			$("#form_login").hide()
			$("#form_repassword").hide()
		break;
	}
}

function alerta(module, message, type_message){
	Swal.fire(
	  module,
	  message,
	  type_message
	)
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}

function pasarvideo(id,video,portada){
	let old_id = $("#video_id").val()
	$("#video_"+old_id).hide()
	$("#video_id").val(id)
	id = Number(id)+1
	$("#video_id").val(id)
	$("#video_"+id).show()
	$("#first-video").html(`<video name='video_${id}'  id='video_${id}'  controls onseeking='catchTime(this.currentTime,${id}),tester()' onplay='catchTime(this.currentTime,${id})' onpause='catchTime(this.currentTime,${id})' width='100%'  poster='assets/portadas/${portada}' data-setup='{}' src='https://tonyalmazan.s3.amazonaws.com/${video}'></video>`)
}