<section class="breadcrumb-area d-flex align-items-center" style="background-image:url(img/yt_bg.jpg)">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="breadcrumb-wrap text-center">
                    <div class="breadcrumb-title">
                        <h2>Carrito de compras</h2>                                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="services" class=" pt-20 pb-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-30">
                <div class="s-single-services wow fadeInUp  animated" data-animation="fadeInDown animated" data-delay=".2s" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="second-services-content2" style="min-height: 220px;">
                      <img src="img/cursos/TA_Portada%20v2%20A.jpg" alt="tony almazan" width="100%" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-30">
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
                               $boton
                            </div>
                        </div>
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

let user_id = localStorage.getItem("user_id")

    if(user_id != null){
        const docRef = doc(db, "users", user_id)
        let result_user = checkDatabaseData(docRef)
    }
     else{
        // $("#pay_button").show()
        // $("#pay_button").attr("data-toggle","modal")
        // $("#pay_button").attr("data-target","#modal")
        $("#pay_button").attr("href","?o=pay&id="+user_id)
     }
         
    async function checkDatabaseData(docRef) {
 
        let docSnap = await getDoc(docRef)
        let user_data = docSnap.data()

        if(user_data == undefined){
            return null
        }
        else{

            let active_pay = user_data.active_pay
            let name_register = user_data.name_register
            let last_name_register = user_data.last_name_register
            let phone_register = user_data.phone_register

            if(active_pay == "off"  || active_pay == undefined ){

                $("#pay_button").attr("href","?o=pay&id="+user_id)
                $("#pay_button").show()
            
            }
            else{
                                        
                if(name_register =="" || last_name_register == "" || phone_register == ""){
            
                    $("#view_button").hide()
                    $("#my_data").show()
                    $("#pay_button").hide()
            
                }
                else{
                    $("#my_data").hide()
                    
                    if(active_pay == "on"){
            
                        $("#view_button").show()
            
                    }
                    else{
            
                        $("#pay_button").attr("href","?o=pay&id="+user_id)
                        $("#pay_button").show()
            
                    }   
                }   
            }         
        }          
    }

</script>
