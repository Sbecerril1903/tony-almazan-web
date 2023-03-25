<section class="cta-bg pt-120 pb-120" >
    <div class="container">
        <div class="row justify-content-center text-LEFT">
            <div class="col-md-3">
                <nav>
                    <ul style="font-size: 18px;">
                        <li><a href ="#" id="section_profile"  style="color: black;"><i class="fa fa-user"></i>&nbsp;&nbsp; Mi Perfíl</a></li>
                        <li><a href ="#" id="section_password"  style="color: black;"><i class="fas fa-key"></i>&nbsp;&nbsp; Cambiar Contraseña</a></li>
                        <li><a href ="?o=checkout" id="section_compras" style="color: black;"><i class="fa fa-cart-arrow-down"></i>&nbsp;&nbsp; Mi curso</a></li>
                        <li><a href ="#" id="button_logout" style="color: black;"><i class="fas fa-power-off"></i>&nbsp;&nbsp;Salir</a></li>
                    </ul>
                </nav>
            </div>
            <div class="col-md-6"  style="height: 500px;">
                <div class="row" style="height: 500px;">
                    <div class="col-12" id="content_password" style="display: none;">
                        <h3>Cambiar Contraseña</h3>
                         <a href="#" class="btn" style="background-color: #AA7B32;" id="save_newpassword">Guardar</a>
                    </div>
                    <div class="col-12" id="content_profile" style="display: none;">
                        <h3>Mi Perfil</h3>
                        <p> 
                            <label>Nombre</label>
                            <input type="text" id="name_profile" class="form-control">
                            <label>Apellidos</label>
                            <input type="text" id="lastname_profile" class="form-control">
                            <label>Teléfono</label>
                            <input type="text" id="phone_profile" class="form-control">
                            <label>Email</label>
                            <input type="text" id="email_profile" class="form-control"  >
                           <!--  <label>Contraseña</label>
                            <input type="text" name="name" class="form-control"> -->
                        </p>
                        <a href="#" class="btn" style="background-color: #AA7B32;" id="save_profile">Guardar</a>
                    </div>

                    <div class="col-12" id="content_dashboard" >
                        <h3>DASHBOARD</h3>
                        <p>¡Bienvenido a <span id="name_msg"></span>tu cuenta! Desde aquí puedes verificar y ver fácilmente tus compras recientes, tus eventos y videocurso. En la opción de DETALLES DE CUENTA puedes cambiar tu contraseña cuando lo desees</p>
                    </div>
                    <div class="col-12" style="display: none;" id="content_compras">

                        <div class="row">
                            <div class="col-8">
                                <span id="first-video"></span>
                            </div>
                            <div class="col-4">
                                <ul>
                                    <li>Bienvenido</li>
                                </ul>
                            </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>
</section>
<script type="module">
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
import { getAnalytics } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-analytics.js";
import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword,  signInWithPopup, GoogleAuthProvider,FacebookAuthProvider } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-auth.js";
import { getFirestore, collection, addDoc, getDocs, getDoc, setDoc, deleteDoc, query, where, doc } from "https://www.gstatic.com/firebasejs/9.14.0/firebase-firestore.js";

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

let user_id  = localStorage.getItem('user_id')
let user_data = {
    user_id : user_id,
    email_register : email_register,
    active: true,
    date: Date.now()
}

$("#section_profile").click(function(){
    $("#content_profile").show()
    $("#content_dashboard").hide()
    $("#content_compras").hide()
    $("#content_password").hide()
})

$("#section_compras").click(function(){
    $("#content_profile").hide()
    $("#content_dashboard").hide()
    $("#content_compras").show()
    $("#content_password").hide()
})

$("#section_password").click(function(){
    $("#content_profile").hide()
    $("#content_dashboard").hide()
    $("#content_compras").hide()
    $("#content_password").show()
})

const docRef = doc(db, "users", user_id)
let result_user = checkDatabaseData(docRef)
   
async function checkDatabaseData(docRef) {

    let docSnap = await getDoc(docRef)
    let user_data = docSnap.data()
    console.log(user_data)


    if(user_data == undefined){
      //  location.href="?o=logout"
    }
    else{
        $("#email_profile").val(user_data.email_register)
        $("#lastname_profile").val(user_data.last_name_register)
        $("#name_profile").val(user_data.name_register)
        $("#phone_profile").val(user_data.phone_register)
        if(user_data.active_pay == "on"){
            $("#section_compras").attr("href","?o=mi-curso")
        }
    }
}

$( "#save_profile" ).click(function() {
    let email_register  = $("#email_profile").val()
    let last_name_register = $("#lastname_profile").val()
    let name_register = $("#name_profile").val()
    let phone_register =$("#phone_profile").val()
    let user_id  = localStorage.getItem('user_id')

    let user_data = {
        user_id : user_id,
        email_register : email_register,
        name_register : name_register,
        last_name_register : last_name_register,
        phone_register : phone_register,
        date: Date.now()
    }
    
    let result = addUserVideo(user_id,user_data)
    async function addUserVideo(user_id,user_data){
    const docRef = doc(db, "users", user_id)
        setDoc(docRef, user_data, { merge: true })
    }
    alerta("Excelente","Los cambios efectuados realizados con exito","success")
});

document.getElementById("first-video").addEventListener("click", function(){

let video_estatus = $("#video_estatus").val()
let video = 1

if(video_estatus == 0){
    $("#video_estatus").val(1)
    
    saveTimeVideo(video)
}
else if(video_estatus == 1){

     $("#video_estatus").val(0)
     saveTimeVideo(video)
}


function saveTimeVideo(video){
    let tiempo = $("#tiempo").val() 
  
    let user_id  = localStorage.getItem('user_id')  

    let user_data ={
        user_id : user_id,
        time: tiempo,
        video: video
    }
    console.log(user_data)

    const docRef = doc(db, "users_video", user_id)
    let result = addDocumentVideo(user_id,user_data)
    async function addDocumentVideo(user_id,user_data){
        setDoc(docRef, user_data, { merge: true })
    }
 }
});
</script>