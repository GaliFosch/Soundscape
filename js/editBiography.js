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
        textArea.innerText = value.innerText;
        form.style.display = formDispl;
        value.style.display = "none";
        editButton.style.display = "none";
    })

    form.addEventListener("submit", (event)=>{
        event.preventDefault();
        const formData = new FormData(this);

        fetch("process_edit_profile.php",{
            method: 'POST',
            body: formData
        })
            .then(respone=> respone.text())
            .then(text=>{
                if(text === "true"){
                    value.innerText = textArea.innerText;
                }else{
                    alert("Error: we couldn't update your biography. Retry later.")
                }
                value.style.display = valueDispl;
                editButton.style.display = editButtonDispl;
                form.style.display = "none";
            })
    })
})