window.addEventListener("DOMContentLoaded", domLoaded);

let dateIn;
let dateOut;
let id;
let address;
let phone;
let pet;
let submit;

function domLoaded() {
    dateIn = document.getElementById("checkIn");
    dateOut = document.getElementById("checkOut");
    id = document.getElementById("id");
    address = document.getElementById("address");
    phone = document.getElementById("phone");
    pet = document.getElementById("pet");
    submit = document.getElementById("reservationForm");


    submit.addEventListener("submit", submit(e));
}


function submit(e) {
    $all = document.querySelector();
    for ($i = 0; i < count($all); i++) {
        if ($all[i].value == "") {
            alert("Please fill out the form");
            e.preventDefault();
        }
    }

    let reg1 = /^[0-9]{3}[ ][0-9]{3}[ ][0-9]{4}$/
    let reg2 = /^[0-9]{3}[\-][0-9]{3}[\-][0-9]{4}$/
    
    if (!reg1.test(phone.value) && !reg2.test(phone.value)) {
        alert("Phone number must have 10 numbers and be separated by dashes or spaces");
        e.preventDefault();
    }

}