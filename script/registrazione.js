function checkName(event){

 const x=document.querySelector(".nome input");
    if(x.value.lenght>0 || x.value.lenght<16){
       
document.querySelector("#error_n").classList.add("hidden");
}
else{
    document.querySelector("#error_n").classList.remove("hidden");
}
}

function checkSurname(event){
    const x=document.querySelector(".cognome input");
    if(x.value.lenght>0 || x.value.lenght<16){
        document.querySelector("#error_s").classList.add("hidden")
    }else
{
    document.querySelector("#error_s").classList.remove("hidden");
   
}
}


function onJsonUser(json) {
    if (!json.exists) {

      
        document.querySelector('#error_us').classList.add('hidden');
      
    }
     else 
    {
        document.querySelector('#error_us').textContent = "Questo username è già presente nei databases";
        document.querySelector('#error_us').classList.remove('hidden');
     
    }
}
function checkUser(event){
    const x=document.querySelector(".username input");
    if(!/^[a-z](?=(?:[a-z]*\d){0,4}(?![a-z]*\d))(?=[a-z\d]{3,11}$)[a-z\d]+$/i.test(x.value)){
        document.querySelector("#error_us").classList.remove("hidden");
      
    }else
    {
        fetch("check_user.php?q="+encodeURIComponent(x.value)).then(Onresponse).then(onJsonUser);
    }
}


function onjsonEm(json){
    if (!json.exists) {

       
        document.querySelector('#error_em').classList.add('hidden');
       
    }
     else 
    {
        document.querySelector('#error_em').textContent = "Questa e-mail è già presente nei databases";
        document.querySelector('#error_em').classList.remove('hidden');
      
    }
}
function checkEm(event){
    const x=document.querySelector(".email input");
    if(!/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(x.value)){
        document.querySelector("#error_em").classList.remove("hidden");
      
    }else
    {
        fetch("check_em.php?q=" + encodeURIComponent(x.value)).then(Onresponse).then(onjsonEm);
    }
}

function checkPass(event){
    const x=document.querySelector(".password input");
    if(x.value.lenght>8 || x.value.lenght<16){
        document.querySelector("#error_pass").classList.add("hidden")
  
    }else
{
    document.querySelector("#error_pass").classList.remove("hidden");
   
}
}
function checkAnotTimePass(event){
    const x=document.querySelector(".confirm_password input");
    if(x.value === document.querySelector(".password input").value){
        document.querySelector("#error_cp").classList.add("hidden");
        
    }
    else{
        document.querySelector("#error_cp").classList.remove("hidden");
       
    }
}

function verifica(event) {

  if (form.nome.value.length == 0 || form.cognome.length == 0 ||
    form.username.length == 0 || form.Password.length == 0 ||
    form.confirm_password.length == 0 || form.Email.length == 0) {
    alert('Non hai compilato tutti i campi. Riprova!');
    event.preventDefault();
  }

}
const form = document.forms['registration_form'];
form.addEventListener('submit', verifica);


function Onresponse(response){
return (response.ok? response.json(): null);
}



document.querySelector('.cognome input').addEventListener('blur',checkSurname)
document.querySelector('.nome input').addEventListener('blur',checkName)
document.querySelector('.email input').addEventListener('blur', checkEm);
document.querySelector('.username input').addEventListener('blur', checkUser);
document.querySelector('.password input').addEventListener('blur', checkPass);
document.querySelector('.confirm_password input').addEventListener('blur', checkAnotTimePass);
