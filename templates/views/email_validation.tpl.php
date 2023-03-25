<section class="align-items-center" style="min-height:120px;background-image:url(img/yt_bg.jpg)">
    <div class="container">
        <div class="row">
            
        </div>
    </div>
</section>
<section id="services" class=" pt-20 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 mb-30">
                <div class="s-single-services wow fadeInUp  animated" data-animation="fadeInDown animated" data-delay=".2s" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="second-services-content2" style="min-height: 220px;">
                        <input type="hidden" id="register_id" value="$id">
                      <h2>Gracias</h2>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script type="module">
// Import the functions you need from the SDKs you need
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

let register_id = $("#register_id").val()
let user_data = {"active_user":"on"}

if(register_id != ""|| register_id != null){
    saveRegister(register_id,user_data)
}

function saveRegister(register_id,user_data){
        setDoc(doc(db, "users", register_id), user_data, { merge: true }).then(function(result) {
    })
} 

//////////Register
  $("#register_button").click(function() {
    
    let email_register = $("#email_register").val()
    let name_register  = $("#name_register").val()
    let last_name_register  = $("#last_name_register").val()
    let phone_register  = $("#phone_register").val()
    let password  = $("#password_register").val()       
    const insert = collection(db, "clientes")
    
    if(name_register == ""){
        alerta("Lo sentimos","Por favor ingresa tu Nombre","error")
        return
    }

    if(last_name_register == ""){
        alerta("Lo sentimos","Por favor ingresa tu Apellido","error")
        return
    }

    if(phone_register == ""){
        alerta("Lo sentimos","Por favor ingresa tu teléfono","error")
        return
    }

    let isPhone = validationPhone(phone_register)

    if(isPhone == false){
        alerta("Lo sentimos","Por favor ingresa un teléfono valido","error")
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

       createUserWithEmailAndPassword(auth, email_register, password)
      .then((userCredential) => {
        let user_id = userCredential.user.uid;
        localStorage.setItem('user_id',user_id);

        localStorage.setItem('email_register', email_register);
        localStorage.setItem('name_register', name_register);
        localStorage.setItem('last_name_register', last_name_register);
        localStorage.setItem('phone_register', phone_register);

        alerta("Excelente","La cuenta ha sido registrada verifica tu correo electronico","success")
        $('#modal').modal('hide');
        xajax_email("register",user_id)
        
      })
      .catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;

        if(errorCode == "auth/email-already-in-use"){
            alerta("Lo sentimos","La cuenta ya está registrada","error")
        }
      });
});

////////Login_google
$( "#google_button" ).click(function() {
  
  const provider = new GoogleAuthProvider()
  signInWithPopup(provider)

    signInWithPopup(auth, provider)
      .then((result) => {
        
        const credential = GoogleAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;
        const user = result.user;
        document.getElementById("menu_login").style.display ="none"
        document.getElementById("menu_logout").style.display =""
        $('#modal').modal('hide');

        location.href="?o=dashboard"
        // ...
      }).catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        const email = error.customData.email;
        const credential = GoogleAuthProvider.credentialFromError(error);
        alerta("Lo sentimos","Hubo un problema, estamos solucionandolo","error")
        // ...
      });
    
});

////////Login_facebook
$( "#facebook_button" ).click(function() {
  const provider_fb = new FacebookAuthProvider()
 
    signInWithPopup(auth, provider_fb)
      .then((result) => {
        const credential = FacebookAuthProvider.credentialFromResult(result);
        const token = credential.accessToken;
        const user = result.user;
        document.getElementById("menu_login").style.display ="none"
        document.getElementById("menu_logout").style.display =""
        $('#modal').modal('hide');

        location.href="?o=dashboard"
        // ...
      }).catch((error) => {
        const errorCode = error.code;
        const errorMessage = error.message;
        const email = error.customData.email;
        const credential = FacebookAuthProvider.credentialFromError(error);
        alerta("Lo sentimos","Hubo un problema, estamos solucionandolo","error")
        // ...
      });
    
});

////////Login
$( "#login_button" ).click(function() {
  
    console.log("aca")
    
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

  signInWithEmailAndPassword(auth, email, password)
  .then((userCredential) => {
    // Signed in 
    const user = userCredential.user;
    const displayName = userCredential.user.displayName;
    const uid = userCredential.user.uid;
    const emailVerified = userCredential.user.emailVerified;
    const email_login = userCredential.user.email;

    document.getElementById("menu_login").style.display ="none"
    document.getElementById("menu_logout").style.display =""
    $('#modal').modal('hide');
    location.href="?o=dashboard"
    // ...
  })
  .catch((error) => {
    const errorCode = error.code;
    const errorMessage = error.message;

    alerta("Lo sentimos","Datos de la cuenta invalidos","error")
  });
    
});
//////Logout
$( "#button_logout" ).click(function() {
    auth.signOut()
    document.getElementById("menu_login").style.display  = ""
    $("#menu_login").hide()
    document.getElementById("menu_logout").style.display = "none"
    location.href="?o=logout"
});
////////Listener Change Session 
auth.onAuthStateChanged(user =>{
        if(user){
           // console.log(user)
            document.getElementById("menu_login").style.display = "none"
            document.getElementById("menu_logout").style.display = ""  

        }
        else{ 
            document.getElementById("menu_logout").style.display ="none"
            document.getElementById("menu_login").style.display = ""
        }

    })

</script>
