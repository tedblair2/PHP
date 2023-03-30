const passwordinput=document.querySelector(".form form input[type='password']"),
toggle=document.querySelector(".form .field i");


const changePassword=()=>{
    if(passwordinput.type=="password"){
        passwordinput.type="text"
        toggle.classList.add("active")
    }else{
        passwordinput.type="password"
        toggle.classList.remove("active")
    }
}