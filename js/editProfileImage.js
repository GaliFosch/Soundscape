document.addEventListener("DOMContentLoaded", ()=>{
    const container = document.getElementById("ImageEditContainer");
    const form = document.getElementById("ImageEditForm");
    const fileInput = document.getElementById("NewImg");
    const profileImage = document.getElementById("ProfileImage");

    document.getElementById("EditProfileImage").addEventListener("click", ()=>{
        container.style.display="block";
        fileInput.value = "";
    });

    document.getElementById("UndoImgEdit").addEventListener("click", ()=>container.style.display="");

    form.addEventListener("submit", (event)=>{
        event.preventDefault();

        const formData = new FormData(form);

        fetch("process_edit_profileImage.php",{
            method: "POST",
            body: formData
        })
            .then(response=> response.json())
            .then(data=>{
                if(data.error === 0){
                    console.log(data)
                    profileImage.setAttribute("src", data.message);
                }else{
                    alert("Error:" + data.message);
                }
                container.style.display = "";
            })
    })
})