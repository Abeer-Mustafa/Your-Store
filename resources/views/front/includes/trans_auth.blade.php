<script>
var nameRequired = "{{__('home.nameRequired')}}";
var nameString = "{{__('home.nameString')}}";
var nameCount = "{{__('home.nameCount')}}";
var emailRequired = "{{__('home.emailRequired')}}";
var emailCount = "{{__('home.emailCount')}}";
var phoneRequired = "{{__('home.phoneRequired')}}";
var phoneNumber = "{{__('home.phoneNumber')}}";
var passRequired = "{{__('home.passRequired')}}";
var passCount = "{{__('home.passCount')}}";
var passConfirm = "{{__('home.passConfirm')}}";
var countryRequired = "{{__('home.countryRequired')}}";
var stateRequired = "{{__('home.stateRequired')}}";
var cityRequired = "{{__('home.cityRequired')}}";

/* 
|--------------------------------------
|---------- Register Validate ---------
|--------------------------------------
*/
function RegisterValidate() {
  // Name Field
  var nameMessage = document.getElementById('nameMessage');
  var nameField = document.registerForm.name;
  var matchString = /^[A-Za-z\u0600-\u06FF\u0750-\u077F ]+$/;
  if( nameField.value == "" ) {
    nameMessage.innerHTML=nameRequired;
    nameField.focus() ;
    return false;
  }
  if( !nameField.value == "" ) {
    nameMessage.innerHTML="";
  }
  if( !nameField.value.match(matchString) ) {
    nameMessage.innerHTML=nameString;
    nameField.focus() ;
    return false;
  }
  if( nameField.value.match(matchString)  ) {
    nameMessage.innerHTML="";
  }
  if( nameField.value.length > 40) {
    nameMessage.innerHTML=nameCount;
    nameField.focus() ;
    return false;
  } 
  if( nameField.value.length <= 40) {
    nameMessage.innerHTML="";
  }

  // Email Field
  var emailMessage = document.getElementById('emailMessage');
  var emailField = document.registerForm.email;
  if( emailField.value == "" ) {
    emailMessage.innerHTML=emailRequired;
    emailField.focus() ;
    return false;
  } 
  if( !emailField.value == "" ) {
    emailMessage.innerHTML="";
  } 
  if( emailField.value.length > 40) {
    emailMessage.innerHTML=emailCount;
    emailField.focus() ;
    return false;
  } 
  if( emailField.value.length <= 40) {
    emailMessage.innerHTML="";
  }

  // Phone Field
  var phoneMessage = document.getElementById('phoneMessage');
  var phoneField = document.registerForm.phone;
  var matchNumber = /^[0-9]/;
  if( phoneField.value == "" ) {
    phoneMessage.innerHTML=phoneRequired;
    phoneField.focus() ;
    return false;
  } 
  if( !phoneField.value == "" ) {
    phoneMessage.innerHTML="";
  } 
  if( !phoneField.value.match(matchNumber) ) {
    phoneMessage.innerHTML=phoneNumber;
    phoneField.focus() ;
    return false;
  }
  if( phoneField.value.match(matchNumber)  ) {
    phoneMessage.innerHTML="";
  }

  // Password Field
  var passwordMessage = document.getElementById('passwordMessage');
  var passwordField = document.registerForm.password;
  var passwordConf = document.registerForm.password_confirmation;
  if( passwordField.value == "" ) {
    passwordMessage.innerHTML=passRequired ;
    passwordField.focus() ;
    return false;
  } 
  if( !passwordField.value == "" ) {
    passwordMessage.innerHTML="" ;
  } 
  if( passwordField.value.length < 8 ) {
    passwordMessage.innerHTML=passCount ;
    passwordField.focus() ;
    return false;
  } 
  if( passwordField.value.length >= 8 ) {
    passwordMessage.innerHTML="" ;
  } 
  if( passwordField.value !==  passwordConf.value) {
    passwordMessage.innerHTML=passConfirm ;
    passwordConf.focus() ;
    return false;
  } 
  if( passwordField.value ===  passwordConf.value ) {
    passwordMessage.innerHTML="" ;
  }

  // Country Field
  var countryMessage = document.getElementById('countryMessage');
  var countryField = document.registerForm.country;
  if( countryField.value == "" ) {
    countryMessage.innerHTML=countryRequired;
    countryField.focus() ;
    return false;
  } 
  if( !countryField.value == "" ) {
    countryMessage.innerHTML="";
  } 

  // State Field
  var stateMessage = document.getElementById('stateMessage');
  var stateField = document.registerForm.state;
  if( stateField.value == "" ) {
    stateMessage.innerHTML=stateRequired;
    stateField.focus() ;
    return false;
  } 
  if( !stateField.value == "" ) {
    stateMessage.innerHTML="";
  } 
  
  // City Field
  var cityMessage = document.getElementById('cityMessage');
  var cityField = document.registerForm.city;
  if( cityField.value == "" ) {
    cityMessage.innerHTML=cityRequired;
    cityField.focus() ;
    return false;
  } 
  if( !phoneField.value == "" ) {
    phoneMessage.innerHTML="";
  } 
}

/*
|-----------------------------------
|---------- Login Validate ---------
|-----------------------------------
*/
function LoginValidate() {
  // Email Field
  var emailMessage = document.getElementById('emailMessage');
  var emailField = document.registerForm.email;
  if( emailField.value == "" ) {
    emailMessage.innerHTML=emailRequired;
    emailField.focus() ;
    return false;
  } 
  if( !emailField.value == "" ) {
    emailMessage.innerHTML="";
  } 
  if( emailField.value.length > 40) {
    emailMessage.innerHTML=emailCount;
    emailField.focus() ;
    return false;
  } 
  if( emailField.value.length <= 40) {
    emailMessage.innerHTML="";
  }

  // Password Field
  var passwordMessage = document.getElementById('passwordMessage');
  var passwordField = document.registerForm.password;
  if( passwordField.value == "" ) {
    passwordMessage.innerHTML=passRequired ;
    passwordField.focus() ;
    return false;
  } 
  if( !passwordField.value == "" ) {
    passwordMessage.innerHTML="" ;
  } 
  if( passwordField.value.length < 8 ) {
    passwordMessage.innerHTML=passCount ;
    passwordField.focus() ;
    return false;
  } 
  if( passwordField.value.length >= 8 ) {
    passwordMessage.innerHTML="" ;
  } 
}

/* 
|------------------------------------------
|---------- Edit Profile Validate ---------
|------------------------------------------
*/
function EditProfileValidate() {
  // Name Field
  var nameMessage = document.getElementById('nameMessage');
  var nameField = document.registerForm.name;
  var matchString = /^[A-Za-z\u0600-\u06FF\u0750-\u077F ]+$/;
  if( nameField.value == "" ) {
    nameMessage.innerHTML=nameRequired;
    nameField.focus() ;
    return false;
  }
  if( !nameField.value == "" ) {
    nameMessage.innerHTML="";
  }
  if( !nameField.value.match(matchString) ) {
    nameMessage.innerHTML=nameString;
    nameField.focus() ;
    return false;
  }
  if( nameField.value.match(matchString)  ) {
    nameMessage.innerHTML="";
  }
  if( nameField.value.length > 40) {
    nameMessage.innerHTML=nameCount;
    nameField.focus() ;
    return false;
  } 
  if( nameField.value.length <= 40) {
    nameMessage.innerHTML="";
  }

  // Email Field
  var emailMessage = document.getElementById('emailMessage');
  var emailField = document.registerForm.email;
  if( emailField.value == "" ) {
    emailMessage.innerHTML=emailRequired;
    emailField.focus() ;
    return false;
  } 
  if( !emailField.value == "" ) {
    emailMessage.innerHTML="";
  } 
  if( emailField.value.length > 40) {
    emailMessage.innerHTML=emailCount;
    emailField.focus() ;
    return false;
  } 
  if( emailField.value.length <= 40) {
    emailMessage.innerHTML="";
  }

  // Phone Field
  var phoneMessage = document.getElementById('phoneMessage');
  var phoneField = document.registerForm.phone;
  var matchNumber = /^[0-9]/;
  if( phoneField.value == "" ) {
    phoneMessage.innerHTML=phoneRequired;
    phoneField.focus() ;
    return false;
  } 
  if( !phoneField.value == "" ) {
    phoneMessage.innerHTML="";
  } 
  if( !phoneField.value.match(matchNumber) ) {
    phoneMessage.innerHTML=phoneNumber;
    phoneField.focus() ;
    return false;
  }
  if( phoneField.value.match(matchNumber)  ) {
    phoneMessage.innerHTML="";
  }

  // Password Field
  var passwordMessage = document.getElementById('passwordMessage');
  var passwordField = document.registerForm.password;
  var passwordConf = document.registerForm.password_confirmation;
  if( passwordField.value !==  passwordConf.value) {
    passwordMessage.innerHTML=passConfirm ;
    passwordConf.focus() ;
    return false;
  } 
  if( passwordField.value ===  passwordConf.value ) {
    passwordMessage.innerHTML="" ;
  }

  // Country Field
  var countryMessage = document.getElementById('countryMessage');
  var countryField = document.registerForm.country;
  if( countryField.value == "" ) {
    countryMessage.innerHTML=countryRequired;
    countryField.focus() ;
    return false;
  } 
  if( !countryField.value == "" ) {
    countryMessage.innerHTML="";
  } 

  // State Field
  var stateMessage = document.getElementById('stateMessage');
  var stateField = document.registerForm.state;
  if( stateField.value == "" ) {
    stateMessage.innerHTML=stateRequired;
    stateField.focus() ;
    return false;
  } 
  if( !stateField.value == "" ) {
    stateMessage.innerHTML="";
  } 
  
  // City Field
  var cityMessage = document.getElementById('cityMessage');
  var cityField = document.registerForm.city;
  if( cityField.value == "" ) {
    cityMessage.innerHTML=cityRequired;
    cityField.focus() ;
    return false;
  } 
  if( !phoneField.value == "" ) {
    phoneMessage.innerHTML="";
  } 
}
</script>


<!-- 
error : function (jqXHR, exception) {
  alert(jqXHR.responseText);
  window.location.href = APP_URL + '/login';
} 
-->