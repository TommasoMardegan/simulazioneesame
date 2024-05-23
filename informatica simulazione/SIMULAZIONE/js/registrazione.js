$(document).ready(function() {
    event.preventDefault();
    $("#registrazioneButton").click(function () {
        let email =document.getElementById("email").value;
        let password =document.getElementById("password").value;
        let codiceFiscale =document.getElementById("codiceFiscale").value;
        let dataNascita =document.getElementById("dataNascita").value;
        let nome =document.getElementById("nome").value;
        let cognome =document.getElementById("cognome").value;
        let numeroCarta =document.getElementById("numero").value;
        let cvvCarta =document.getElementById("cvv").value;
        let dataScadenzaCarta =document.getElementById("dataScadenza").value;
        let citta =document.getElementById("citta").value;
        let via =document.getElementById("via").value;
        let numeroCivico =document.getElementById("numeroCivico").value;
        let provincia =document.getElementById("provincia").value;
        let regione =document.getElementById("regione").value;

        $.get("../php/registrazione.php", { 
            email: email, 
            password: password,
            codiceFiscale: codiceFiscale,
            dataNascita: dataNascita,
            nome: nome,
            cognome: cognome,
            numeroCarta: numeroCarta,
            cvvCarta: cvvCarta,
            dataScadenzaCarta: dataScadenzaCarta,
            citta: citta,
            via: via,
            numeroCivico: numeroCivico,
            provincia: provincia,
            regione: regione
        }, function(data) {
            dataParsed = JSON.parse(data);
            if(dataParsed["statoRegistrazione"] == true) {
                alert("registrazione avvenuta con successo!");
                window.location.href = "../html/login.html";
            }
            else {
                alert("parametri non ammessi!");
            }
        });
    });
});
