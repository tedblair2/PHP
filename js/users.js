const searchbtn=document.querySelector(".users .search button"),
searchBar=document.querySelector(".users .search input"),
userslist=document.querySelector(".users .users-list")

searchbtn.onclick=()=>{
    searchBar.classList.toggle("active")
    searchBar.focus()
    searchbtn.classList.toggle("active")
}
searchBar.onkeyup=()=>{
    let searchTxt=searchBar.value
    if(searchTxt != ""){
        searchBar.classList.add("active")
    }else{
        searchBar.classList.remove("active")
    }
    const xhr = new XMLHttpRequest()
    xhr.open("POST", "php/search.php", true)
    xhr.onload = () => {
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response
                userslist.innerHTML=data
            }
        }
    }
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded")
    xhr.send("searchTerm="+searchTxt)
}

setInterval(()=>{
    const xhr = new XMLHttpRequest()
    xhr.open("GET", "php/loadusers.php", true)
    xhr.onload = () => {
        if(xhr.readyState===XMLHttpRequest.DONE){
            if(xhr.status===200){
                let data=xhr.response
                if(!searchBar.classList.contains("active")){
                    userslist.innerHTML=data
                }
            }
        }
    }
    xhr.send()
},500)