document.addEventListener("DOMContentLoaded", ()=>{
    const container = document.getElementById("Biography");

    const editButton = document.getElementById("EditBiograpy");
    const editButtonDispl = editButton.style.display;
    
    const value = container.getElementsByTagName("p")[0];
    const valueDispl = value.style.display;

    const form = document.getElementById("BiographyForm");
    const formDispl = form.style.display;
    form.style.display = "none";

    const textArea = document.getElementById("bio");

    editButton.addEventListener("click", ()=>{
        console.log(value.innerText);
        textArea.innerText = value.innerText;
        form.style.display = formDispl;
        textArea.select();
        value.style.display = "none";
        editButton.style.display = "none";
    })

    form.addEventListener("submit", (event)=>{
        event.preventDefault();
        const formData = new FormData(form);

        fetch("process_edit_profile.php",{
            method: 'POST',
            body: formData
        })
            .then(respone=> respone.json())
            .then(data=>{
                if(data.error === 0){
                    value.innerText = data.message;
                }else{
                    alert("Error:" + data.message);
                }
                value.style.display = valueDispl;
                editButton.style.display = editButtonDispl;
                form.style.display = "none";
            })
    })

    document.getElementById("bioEditUndo").addEventListener("click", ()=>{
        value.style.display = valueDispl;
        editButton.style.display = editButtonDispl;
        form.style.display = "none";
    })
})