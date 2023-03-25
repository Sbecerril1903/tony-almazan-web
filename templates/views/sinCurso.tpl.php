<section class="cta-bg pt-30 pb-30" >
    <div class="container" style="padding-bottom: 20px;">
        <div class="row">
            <div class="col-4"></div>
            <div class="col-2"><a href="#" id="button_profile" style="font-size: 18px; color: black; text-decoration: underline;">Mi perfíl <i class="fa fa-user"></i></a></div>
            <div class="col-2"><a href="#" id="button_compras" style="font-size: 18px; color: black; text-decoration: underline;">Mi curso <i class="fas fa-key"></i></a></div>
            <div class="col-3"><a href="#" id="button_password" style="font-size: 18px; color: black; text-decoration: underline;">Cambiar contraseña <i class="fa fa-cart-arrow-down"></i> </a></div>
            <div class="col-1"><a href="?o=cerrarSession"  style="font-size: 18px; color: red; ">Salir <i class="fas fa-power-off"></i></a></div>
        </div>
    </div>
    <hr>
    <div class="container" style="padding-bottom: 30px; display: none;">
        <h4 style="color:">Felicidades $nombre por dar el primer paso a tu Libertad Financiera y gracias por usar nuestro sistema para lograrlo.
         <b>Mi Riqueza Fácil</b>
        </h4>
    </div>
    <div class="container" id="section_compras">
        <div class="row">
            <div class="col-8">
                <input type="hidden" id="video_id" value="1">
                <input type="hidden" id="video_estatus" value="0">
                <span id="carrusel_videos">
                    <span id="first-video">
                        <img src="assets/portadas/introducccion.JPG" width="100%">
                    </span>
                </span>
                <input type="hidden" id="tiempo" value="0">
                <input type="button" id="boton"  style="display: none;">
            </div>
            <div class="col-4" style="overflow: scroll; max-height: 450px;">
                <div class="s-single-services wow fadeInUp  animated" data-animation="fadeInDown animated" data-delay=".2s" style="visibility: visible; animation-name: fadeInUp;">
              
                    <div class="second-services-content2" style="min-height: 220px;">
                        <h5>Mi Riqueza Fácil</h5>
                        <div class="row">
                            <div class="col-6" style="padding: 10px;">DESCRIPCIÓN</div>
                            <div class="col-6" style="padding: 10px;">...</div>
                            <div class="col-6" style="padding: 10px;">TIPO DE VENTA</div>
                            <div class="col-6" style="padding: 10px;">Curso en línea</div>
                            <div class="col-6" style="padding: 10px;">PRECIO</div>
                            <div class="col-6" style="padding: 10px;">$299.00 USD</div>
                            <div class="col-6" style="padding: 10px;">TOTAL</div>
                            <div class="col-6" style="padding: 10px;">$299.00 USD</div>
                            <div class="col-6"></div>
                            <div class="col-6">
                                <a href="?o=pay" id="pay_butto" class="btn" data-toggle=''  data-target='' style="background-color: #061535; color: #fff;">PAGAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>               
    </div>
    <div class="container" id="section_profile" style="display: none;">

        <div class="row">
            <div class="col-5">
             <h3>Mi Perfil </h3>
                <p> 
                <label>Nombre</label>
                <input type="hidden" id="user_id" value="$id_usuario">
                <input type="text" id="name_profile" class="form-control" value="$nombre_cliente">
                <label>Apellidos</label>
                <input type="text" id="lastname_profile" class="form-control" value="$apellidos">
                <label>Teléfono</label>
                <input type="text" id="phone_profile" class="form-control" value="$telefono">
                <label>Email</label>
                <input type="text" id="email_profile" class="form-control"  value="$correo">
               <!--  <label>Contraseña</label>
                <input type="text" name="name" class="form-control"> -->
            </p>
            <a href="#" class="btn" style="background-color: #AA7B32;" id="save_profile" onclick="editarUsuario()">Guardar</a>   
        </div>       
    </div>
    </div>
    <div class="container" id="section_password" style="display: none;">
        <div class="row">
             <div class="col-5" >
                <label>Cambiar Contraseña</label>
                <input type="password" id="password_change" class="form-control" ><br><br>
                 <a href="#" class="btn" style="background-color: #AA7B32;" id="save_newpassword">Guardar</a>
            </div> 
        </div>       
    </div>
</section>
<script type="module">
// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-analytics.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword,  signInWithPopup, GoogleAuthProvider,FacebookAuthProvider } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-auth.js";
import { getFirestore, collection, addDoc, getDocs, getDoc, setDoc, deleteDoc, query, where, doc, orderBy, limit } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-firestore.js";

const firebaseConfig = {
    apiKey: "AIzaSyDnJCQhidgPPEY7Uuyg2l1mgHciu8mZOnc",
    authDomain: "test-oauth-101d1.firebaseapp.com",
    projectId: "test-oauth-101d1",
    storageBucket: "test-oauth-101d1.appspot.com",
    messagingSenderId: "743769074748",
    appId: "1:743769074748:web:7ee14e9ae2656abd46e739",
    measurementId: "G-21G2QJZS48"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
let analytics = getAnalytics(app);
const db = getFirestore(app);
const auth = getAuth();

$("#button_profile").click(function(){
    $("#section_profile").show()
    $("#section_compras").hide()
    $("#section_password").hide()
})

$("#button_compras").click(function(){
    $("#section_profile").hide()
    $("#section_compras").show()
    $("#section_password").hide()
})

$("#button_password").click(function(){
    $("#section_profile").hide()
    $("#section_compras").hide()
    $("#section_password").show()
})


function saveTimeVideo(video){
    let tiempo = $("#tiempo").val() 
  
    let user_id  = localStorage.getItem('user_id')  

    let user_data ={
        user_id : user_id,   
    }
    user_data["time_" + video] = tiempo;
    user_data["video_" + video] = video;

    const docRef = doc(db, "users_video", user_id)
    let result = addDocumentVideo(user_id,user_data)
    async function addDocumentVideo(user_id,user_data){
        setDoc(docRef, user_data, { merge: true })
    }
}

document.getElementById("boton").addEventListener("click", function(){
    let video = $("#video_id").val()
     saveTimeVideo(video)
})
</script>