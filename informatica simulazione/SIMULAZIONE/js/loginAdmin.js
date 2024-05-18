$(document).ready(function() {
    $("#login").click(function () {
        let email =document.getElementById("email").value;
        let password =document.getElementById("password").value;

        $.get("../php/loginAdmin.php", { email: email, password: password }, function(data) {
            dataParsed = JSON.parse(data);
            if(dataParsed["statoLogin"] == true) {
                window.location.href = "../html/homeAdmin.html";
            }
            else {
                alert("email o password sono errati!");
            }
        });
    });
});
