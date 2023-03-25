function validationEmail(data) {
  var validEmail =  /^\w+([.-_+]?\w+)*@\w+([.-]?\w+)*(\.\w{2,10})+$/;
  if( validEmail.test(data) ){
    return true;
  }else{
    return false;
  }
}

function validationPhone(phone){
  var phoneRe = /^[2-9]\d{2}[2-9]\d{2}\d{4}$/;
  var digits = phone.replace(/\D/g, "");
  return phoneRe.test(digits);
}