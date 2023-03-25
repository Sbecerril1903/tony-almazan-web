<div class="modal fade" id="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h3 id="label_login">Ingresar al curso</h3>
            <h3 id="label_register" style="display: none;">Registrarse al curso</h3>
            <h3 id="label_recover" style="display: none;">Recuperar contraseña</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="form_login" method="post"  style="display: none;">
                <p>
                    <label>Usuario o Correo:</label>
                    <input type="email" class="form-control" name="email" id="email_login" placeholder="Correo"><br>
                    <label>Password</label>
                    <input type="password" class="form-control" name="password_login" id="password_login" placeholder="Password"><br>
                </p>
                  <button type="button" class="btn" style="background-color: green;" id="login_button"> 
                    Ingresar
                </button>
                <hr>
                <a href="#" onclick="formulario_session(0)">¿Olvido su contraseña?</a>
                <br>
                <a href="#" onclick="formulario_session(2)">Registrarse</a><br><br>
              
            </form>
            <form id="form_repassword" method="post" action="index.php?o=$opcion" style="display: none;">
                <p>
                    <label>Usuario o Correo:</label>
                    <input type="email" class="form-control" name="email" id="correo" placeholder="Correo"><br>
                </p>
                <button type="button" class="btn " style="background-color: green;" id="asignar_asesor"  data-dismiss="modal"> 
                    Recuperar
                </button>
                <br><br>
                <a href="#" onclick="formulario_session(1)">Ya tengo una cuenta</a>
                <br>
                <a href="#" onclick="formulario_session(2)">Registrarse</a>
            </form>
            <form id="form_register" method="post" action="index.php?o=$opcion">
                <p>
                    <label>Nombre:</label>
                    <input type="text" class="form-control" name="name_register" id="name_register" placeholder="Nombre">
                    <label>Apellido:</label>
                    <input type="text" class="form-control" name="lastname_register" id="lastname_register" placeholder="Apellidos">
                    <label>Teléfono:</label>
                    <input type="number" class="form-control" name="phone_register" id="phone_register" placeholder="Teléfono">
                    <label>Correo:</label>
                    <input type="email" class="form-control" name="email_register" id="email_register" placeholder="Correo">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password_register" id="password_register">
                </p>
                <button 
                    type="button" 
                    class="btn " 
                    style="background-color: green;" 
                    id="register_button" > 
                    Registrar
                </button><br><br>
                <a href="#" onclick="formulario_session(0)">¿Olvido su contraseña?</a>
                <br>
                <a href="#" onclick="formulario_session(1)">Ya tengo una cuenta</a>
             </form>
             
        </div>
        <div class="modal-footer">
        </div>
    </div>
    </div>
</div>
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
    import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-analytics.js";
    import { getAuth, createUserWithEmailAndPassword,sendSignInLinkToEmail, signInWithEmailAndPassword,  signInWithPopup, GoogleAuthProvider,FacebookAuthProvider } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-auth.js";
    import { getFirestore, collection, addDoc, getDocs, getDoc, setDoc, deleteDoc, query, where, doc } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-firestore.js";

    const firebaseConfig = {
        apiKey: "AIzaSyDnJCQhidgPPEY7Uuyg2l1mgHciu8mZOnc",
        authDomain: "test-oauth-101d1.firebaseapp.com",
        projectId: "test-oauth-101d1",
        storageBucket: "test-oauth-101d1.appspot.com",
        messagingSenderId: "743769074748",
        appId: "1:743769074748:web:7ee14e9ae2656abd46e739",
        measurementId: "G-21G2QJZS48"
    }

    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);
    const auth = getAuth();
    const db = getFirestore(app);

    $("#register_button").click(function() {
    
        let name_register = $("#name_register").val()
        let lastname_register = $("#lastname_register").val()
        let phone_register = $("#phone_register").val()
        let email_register = $("#email_register").val()
        let password  = $("#password_register").val()       

        console.log(email_register)

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
            alerta("Lo sentimos","Por favor ingresa email valido","error")
            return
        }

        if(password == ""){
            alerta("Lo sentimos","Por favor ingresa tu password","error")
            return
        }
        xajax_createAcount(name_register,lastname_register,phone_register,email_register,password)
    });

    $( "#login_button" ).click(function() {
      
        let password  = $("#password_login").val()
        let email = $("#email_login").val()

        if(email == ""){
            alerta("Lo sentimos","Por favor ingresa tu email","error")
            return
        }

        let isEmail = validationEmail(email)
        if(isEmail == false){
            alerta("Lo sentimos","Por favor ingresa email valido","error")
            return
        }

        if(password == ""){
            alerta("Lo sentimos","Por favor ingresa tu password","error")
            return
        }
        
        
        let values ={
            email:email,
            password: password
        }


        $.ajax({
            url: "index.php?o=verificarSession",
            type: "post",
            data: values ,
            success: function (response) {
                
            
                    location.href="?o=mi-curso"
                
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });

    });

</script>