let nouveauMdpUtilisateur = document.querySelector("#nouveauMdpUtilisateur");
let confirmNouveauMdpUtilisateur = document.querySelector("#confirmNouveauMdpUtilisateur");

nouveauMdpUtilisateur.addEventListener("keyup", function(){
    verificationMdp();
})

confirmNouveauMdpUtilisateur.addEventListener("keyup", function(){
    verificationMdp();
})

function verificationMdp(){
    if(nouveauMdpUtilisateur.value == confirmNouveauMdpUtilisateur.value){
        document.querySelector('#submit').disabled = false;
        document.querySelector('#container2').classList.add('d-none');
    } else {
        document.querySelector('#submit').disabled = true;
        document.querySelector('#container2').classList.remove('d-none');
    }
}


