$('#signIn').css('display','none');
$('#ingresarLink').css('display','none');
function login(){
    var user = $('#user').val();
    var password = $('#password').val();
    console.log("Datos enviados");
    $('#incorrecto').css('display','none');
    $('#correcto').css('display','none');
    $('#cargando').css('display','block');
    $.post("http://localhost/LabVosAndes/api/public/user/login",
    {
        _user: user,
        _password: password
    },
    function(data, status){
        console.log("Data: " + data + "\nStatus: " + status);
        console.log(data)
        console.log("datos recibidos");
        $('#cargando').css('display','none');
        if(data.message.respuesta){
            $('#incorrecto').css('display','block');
        }else{
            $('#correcto').css('display','block');
            var dataUser = data.message;
            sessionStorage.setItem('user',JSON.stringify(dataUser));
            window.location.href = 'app';
        }
    });

}
function showCreateAccount(){
    $('#logIn').css('display','none');
    $('#signIn').css('display','block');
    $('#crearLink').css('display','none');
    $('#ingresarLink').css('display','block');
}

function showLogIn(){
    $('#logIn').css('display','block');
    $('#signIn').css('display','none');
       $('#crearLink').css('display','block');
    $('#ingresarLink').css('display','none');
}