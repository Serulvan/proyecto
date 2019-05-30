$(document).ready(function (){
    $('#login_form').submit(function (e){
        e.preventDefault();
        var user = $("#user").val();
        var pass = $("#pass").val();
        login(user, pass);
    });
});

function login(user, pass){
    $.ajax({
        url: "ajax/AJAX_login.php",
        type: 'POST',
        cache: false,
        data: {
            user: user,
            pass: pass
        },
        success: function (data, textStatus, jqXHR) {
            data = JSON.parse(data);
            if(data !== null && typeof data === "object"){ 
                if(parseInt(data.entrar) === 1){
                    window.location.href = "menu.php";
                }else{
                    alert("Usuario o contraseña incorrecto.");
                }
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            
        }
    });
}