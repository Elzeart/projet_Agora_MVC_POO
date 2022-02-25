
// alert("Yéhh");

let btnmodificationMail = document.querySelector("#btnmodificationMail");
let btnValidationModificationMail = document.querySelector("#btnValidationModificationMail");

let mail = document.querySelector("#mail");
let formModificationMail = document.querySelector("#formModificationMail");

btnmodificationMail.addEventListener("click", function(){
    mail.classList.add("d-none");
    formModificationMail.classList.remove("d-none");
})

document.querySelector("#btnSuprCompte").addEventListener("click", function(){
    document.querySelector("#suppressionCompte").classList.toggle("d-none");
})
