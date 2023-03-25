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

let user_id = getParameterByName("user");
const docRef = doc(db, "users", user_id)    
let coockie_id = localStorage.getItem("user_id")
 
let result_user = checkDatabaseData(docRef)
    async function checkDatabaseData(docRef) {
            let user_id = localStorage.getItem("user_id")
            console.log(user_id)
            let docSnap = await getDoc(docRef)
            let user_data = {"active_pay":"on"}            
            let result = addDocumentPreference(user_id,user_data)

        async function addDocumentPreference(user_id,user_data){
            let query_client = doc(db, 'users', user_id)        
            setDoc(query_client, user_data, { merge: true })
        }
}
</script>