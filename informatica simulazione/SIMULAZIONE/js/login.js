$(document).ready(function() {
    $("#login").click(function () {
        event.preventDefault();
        let email =document.getElementById("email").value;
        let password =document.getElementById("password").value;

        $.get("../php/login.php", { email: email, password: password }, function(data) {
            dataParsed = JSON.parse(data);
            if(dataParsed["statoLogin"] == true) {
                window.location.href = "../html/homeCliente.php";
            }
            else {
                alert("email o password sono errati!");
            }
        });
    });
    $("#buttonAdmin").click(function () {
        window.location.href = "../html/loginAdmin.html";
    });
});
