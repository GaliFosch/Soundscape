function followProcedure(follow){
    if(follow.classList.contains("fa-user-plus")){
        follow.classList.remove("fa-user-plus")
        follow.classList.add("fa-user-check")
    }else{
        follow.classList.remove("fa-user-check")
        follow.classList.add("fa-user-plus")
    }
}

let follow = document.getElementById("follow")

follow.addEventListener("click", ()=>followProcedure(follow))