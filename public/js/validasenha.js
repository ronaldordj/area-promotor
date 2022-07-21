var password = document.getElementById("senha"), confirm_password = document.getElementById("repitaSenha");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("As senhas estão diferentes");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;