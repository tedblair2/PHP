const form=document.querySelector(".typing-area"),
inputField=form.querySelector(".input_msg"),
btnSubmit=form.querySelector("button"),
chatArea=document.querySelector(".chat-box")


form.onsubmit=(e)=>{
    e.preventDefault();
}
btnSubmit.onclick=()=>{
    const xhr = new XMLHttpRequest()
    xhr.open("POST", "php/chat.php", true)
    xhr.onload = () => {
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                inputField.value=""
            }
        }
    }
    let formdata=new FormData(form)
    xhr.send(formdata)
}

setInterval(()=>{
    const xhr = new XMLHttpRequest()
    xhr.open("POST", "php/get_chats.php", true)
    xhr.onload = () => {
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response
                chatArea.innerHTML=data
            }
        }
    }
    let formdata=new FormData(form)
    xhr.send(formdata)
},500)