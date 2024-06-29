document.addEventListener("DOMContentLoaded", ()=>{
    const container = document.getElementById("ImageEditContainer");
    const form = document.getElementById("ImageEditForm");
    const fileInput = document.getElementById("NewImg");

    document.getElementById("EditProfileImage").addEventListener("click", ()=>{
        container.style.display="block";
        fileInput.value = "";
    });

    document.getElementById("UndoImgEdit").addEventListener("click", ()=>container.style.display="");

    form.addEventListener("submit", (event)=>{
        event.preventDefault();
        
    })
})