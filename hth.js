window.addEventListener("DOMContentLoaded", domLoaded);

let fn;
let ln;
let pass;
let id;
let phone;
let email;
let checkbox;
let transaction;
let submit;
let reset;

let emailreq;

let verifyList = [
                ["test", "test", "passTest4$", "123456", "123-456-7890", "test@test.net"],
                ["Nice", "Person", "5%goaT", "654321", "123-456-7891", "nice@person.com"],
                ["John", "Doe", "Jj3#", "456123", "123-456-7892", "johndoe@gmail.com"],
                ["Inigo", "Montoya", "Hello!1", "111111", "123-456-7893", "prepare@to.die"]]

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

    checkbox.addEventListener("click", checkboxClicked);

    submit.addEventListener("click", submitForm);

    reset.addEventListener("click", resetForm);

}

function checkboxClicked() {
    if (checkbox.checked) {
        emailreq.classList.add("required");
    } else {
        emailreq.classList.remove("required");
    }
}

function submitForm() {
    if (validateForm()) {
        verifyForm();
    }
}

function validateForm() {
    let input = document.querySelectorAll("input");
    if (checkbox.checked) {
        for (let i = 0; i < input.length - 1; i++) {
            if (!(input[i].value)) {
                alert(input[i].placeholder + " has not been entered");
                input[i].focus();
                return false;
            }
        }
    } else {
        for (let i = 0; i < input.length - 1; i++) {
            if (!(input[i].value) && (input[i].id != "email")) {
                alert(input[i].placeholder + " has not been entered");
                input[i].focus();
                return false;
            }
        }
    }
    if (transaction.value == "default") {
        alert("Please select a transaction");
        transaction.focus();
        return false;
    }

    let password = pass.value;
    if (password.length > 14) {
        alert("Password may not be longer than 14 characters");
        pass.focus();
        return false;
    }

    let upperCase = /[A-Z]/;
    let special = /[^A-Za-z 0-9]/g;
    let numeric = /\d/;

    let up = upperCase.test(password);
    let sp = special.test(password);
    let num = numeric.test(password);

    let upper = up ? "Has an" : "No";
    let specialText = sp ? "Has an" : "No";
    let number = num ? "Has an" : "No";

    if (!(up && sp && num)) {
        alert("Invalid Password:\n\n"+ upper + " upper case letter\n" + specialText + " special character\n" + number + " number");
        pass.focus();
        return false;
    }

    if (id.value.length != 6) {
        alert("ID must be 6 numbers.");
        id.focus();
        return false;
    }

    let phoneNum = /[0-9]{3}[\-]|[ ][0-9]{3}[\-]|[ ][0-9]{4}/

    if (!(phoneNum.test(phone.value))) {
        alert("Phone number must have 10 numbers and be separated by dashes or spaces");
        phone.focus();
        return false;
    }

    let emailReg = /[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-zA-Z]{3,6}$/

    if (checkbox.checked && !(emailReg.test(email.value))) {
        alert("Not a valid email");
        email.focus();
        return false;
    }

    return true;



}


function verifyForm() {
    let input = document.querySelectorAll("input");
    let match;

    if (checkbox.checked) {
        for (let i = 0; i < verifyList.length; i++) {
            match = true;
            for (let j = 0; j < verifyList[0].length; j++) {
                if ((input[j].id == "email")) {
                    input[j].value = input[j].value.toLowerCase();
                }

                if ((verifyList[i][j] != input[j].value) && (input[j].id != "phone")) {
                    match = false;
                    break;
                }
            }

            if (match) {
                alert("Success!\n" + fn.value + " " + ln.value + "\nTransaction: " + transaction.options[transaction.selectedIndex].text);
                return;
            }
        }
    } else {
        for (let i = 0; i < verifyList.length; i++) {
            match = true;
            for (let j = 0; j < verifyList[0].length; j++) {
                if ((verifyList[i][j] != input[j].value) && (input[j].id != "phone") && (input[j].id != "email")) {
                    match = false;
                    break;
                }
            }

            if (match) {
                alert("Success!\n" + fn.value + " " + ln.value + "\nTransaction: " + transaction.options[transaction.selectedIndex].text);
                return;
            }
        }
    }


    alert(fn.value + " " + ln.value + "\nCannot be Found");
}


// function getTransaction() {
//     switch (transaction.value) {
//         case "bookStay":
//             return "Book a Stay"
//         case "cancelStay"
//     }
// }


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
}


//User has entered all data. Email-address if checkbox is checked

//User password: max 14 characters. 
//Have at least one uppercase letter, one special character, one numeric

//ID: 6 digit number

//phone #: 10 digits,
// spaces or dashes

//email: domain regex fix

//If invalid, one alert at a time.



//Verify existing user

//Alert user not found first and last name

//Alert Welcome message, first and last name, transaction