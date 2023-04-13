window.addEventListener("DOMContentLoaded", domLoaded);

let fn;
let ln;
let pass;
let id;
let phone;
//pattern="[0-9]{3}[\-]|[ ][0-9]{3}[\-]|[ ][0-9]{4}"

let email;
let checkbox;

let transaction;
let submit;
let reset;

let emailreq;
//pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{3,6}$"

let verifyList

function domLoaded() {

    fn = document.getElementById("firstName");
    ln = document.getElementById("lastName");
    pass = document.getElementById("password");
    id = document.getElementById("id");
    phone = document.getElementById("phone");
    email = document.getElementById("email");
    checkbox = document.getElementById("emailConfirm");
    transaction = document.getElementById("transaction");
    submit = document.getElementById("submit");
    reset = document.getElementById("reset");
    emailreq = document.getElementById("emailreq");
    
    fn.focus();
    

    fn.addEventListener("focusout", vFN);


    checkbox.addEventListener("click", checkboxClicked);

    submit.addEventListener("click", submitForm);

    reset.addEventListener("click", resetForm);

}

alphaOnly = /[^A-Za-z]/


function foc(elem) {
    setTimeout (() => {
        elem.focus();
    }, 1);
}

function vFN() {
    str = fn.value;
    if (alphaOnly.test(str)) {
        alert("First name may only contain letters.");
        
        foc(fn);

    } else if (str.length == 0) {
        alert("First name must be entered");
        foc(fn);
        
    } else {
        ln.focus();
        ln.addEventListener("focusout", vLN);
    }
}

function vLN() {
    str = ln.value;
    if (alphaOnly.test(str)) {
        alert("Last name may only contain letters.");
        foc(ln);
    } else if (str.length == 0) {
        alert("Last name must be entered.");
        foc(ln);
    }  else {
        pass.focus();
        pass.addEventListener("focusout", vPASS);
    }
}

function vPASS() {

    let password = pass.value;
    

    let upperCase = /[A-Z]/;
    let special = /[^A-Za-z 0-9]/g;
    let numeric = /\d/;

    let up = upperCase.test(password);
    let sp = special.test(password);
    let num = numeric.test(password);

    let upper = up ? "Has an" : "No";
    let specialText = sp ? "Has an" : "No";
    let number = num ? "Has an" : "No";

    if (password.legnth == 0) {
        alert("Password must be entered");
        foc(pass);
    } else if (password.length > 14) {
        alert("Password may not be longer than 14 characters");
        foc(pass);
    } else if (!(up && sp && num)) {
        alert("Invalid Password:\n\n"+ upper + " upper case letter\n" + specialText + " special character\n" + number + " number");
        foc(pass);
    } else {
        id.focus();
        id.addEventListener("focusout", vID);
    }

}


function vID() {
    let regID = /[^0-9]/;

    if (id.value.length != 6) {
        alert("ID must be 6 numbers.");
        foc(id);
    } else if (regID.test(id.value)) {
        alert("ID must consist of only numbers.");
        foc(id);
    } else {
        phone.focus();
        phone.addEventListener("focusout", vPHONE);
    }
}

function vPHONE() {
    let reg1 = /^[0-9]{3}[ ][0-9]{3}[ ][0-9]{4}$/
    let reg2 = /^[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}$/
    
    if (!reg1.test(phone.value) && !reg2.test(phone.value)) {
        alert("Phone number must have 10 numbers and be separated by dashes or spaces");
        foc(phone);
    }
}

function vEMAIL() {
    let regEmail = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-zA-Z]{3,6}$/;

    if (!regEmail.test(email.value)) {
        alert("Please input a valid email");
        foc(email);
    }
}


function checkboxClicked() {
    if (checkbox.checked) {
        emailreq.classList.add("required");
        foc(email);
        email.addEventListener("focusout", vEMAIL);
    } else {
        emailreq.classList.remove("required");
        email.removeEventListener("focusout", vEMAIL);
        email.value = "";
    }
}

function submitForm() {
    if (validateForm()) {
        verifyForm();
    }
}

function validateForm() {
    if (transaction.value == "default") {
        alert("Please select a transaction");
        transaction.focus();
        return false;
    }
    return true;
}


function verifyForm() {
    document.getElementById("loginForm").submit();
}


function resetForm() {
    fn.value = "";
    ln.value = "";
    pass.value = "";
    id.value = "";
    phone.value = "";
    email.value = "";

    checkbox.checked = false;
    document.getElementById("default").selected = true;
    checkboxClicked();

    ln.removeEventListener("focusout", vLN);
    pass.removeEventListener("focusout", vPASS);
    id.removeEventListener("focusout", vID);
    phone.removeEventListener("focusout", vPHONE);
    email.removeEventListener("focusout", vEMAIL);
}

