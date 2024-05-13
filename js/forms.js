function formhash(form, password){
    let p = document.createElement("input");
    form.appendChild(p);
    p.name = "c_password";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
    password.value = "";
    form.submit();
}

let form = document.getElementsByTagName("form")[0];

let inputs = form.getElementsByTagName("input");

let submit = 0;

for(let i = 0; i<inputs.length; i++){
    if(inputs[i].type === "submit"){
        submit = inputs[i];
    }
}
if(submit !== 0){
    submit.addEventListener("click", () => formhash(form,form.password));
}