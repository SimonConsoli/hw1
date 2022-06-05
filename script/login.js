

function emptyForm(event){
    
    if(login.username.value.length==0 || login.password.value.length==0){
        event.preventDefault();
        document.querySelector(".login_err").classList.remove("hidden");
    }
}




const login = document.forms['login_form'];
login.addEventListener('submit', emptyForm);