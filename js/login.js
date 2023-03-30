const form = document.querySelector(".login form"),
submitBtn = form.querySelector(".btn input"),
errorTxt=document.querySelector(".form .error-txt")

form.onsubmit = (e) => {
    e.preventDefault()
}

submitBtn.onclick = () => {
    const xhr = new XMLHttpRequest()
    xhr.open("POST", "php/signin.php", true)
    xhr.onload = () => {
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response
                if(data=="success"){
                    location.href="users.php"
                }else{
                    errorTxt.style.display="block";
                    errorTxt.innerHTML=data
                }
            }
        }
    }
    let formdata=new FormData(form)
    xhr.send(formdata)
}
