window.addEventListener("DOMContentLoaded", domLoaded);

let fn;
let ln;
let id;

let submit;

function domLoaded() {
    fn = document.getElementById("firstName");
    ln = document.getElementById("lastName");
    id = document.getElementById("id");

    submit = document.getElementById("submit");

    submit.addEventListener("click", submitForm);
}

function submitForm() {
    if (fn.value == "" || ln.value == "" || id.value == "") {
        alert("Please fill out form to verify");
        return false;
    }
    return true;
}