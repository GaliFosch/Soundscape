function formhash(form, password){
    let p = document.createElement("input");
    p.name = "c_password";
    p.type = "hidden";
    p.value = hex_sha512(password.value);
    form.appendChild(p);
    password.value = "";
    form.submit();
}

let form = document.getElementById("user-info-form");

let submitBtn = document.getElementById("submit-btn")

if (submitBtn !== null) {
    submitBtn.addEventListener("click", () => formhash(form, form.password));
}