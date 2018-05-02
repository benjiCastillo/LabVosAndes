$('#signIn').css('display','none');
$('#ingresarLink').css('display','none');
function login(){
    var user = $('#user').val();
    var password = $('#password').val();
    console.log("Datos enviados");
    $('#incorrecto').css('display','none');
    $('#correcto').css('display','none');
    $('#cargando').css('display','block');
    $.post("http://localhost/~edev/LabVosAndes/api/public/user/login",
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

function saveUser(){
    console.log('saveUser');
    var pwd1 = $('#Spassword').val();
    var pwd2 = $('#Spassword2').val();
    var nombre = $('#Snombre').val();
    var user = $('#Suser').val();
    var clave = $('#clave').val();
    console.log(inputTest(nombre, user, pwd1, pwd2, clave));
    if(inputTest(nombre, user, pwd1, pwd2, clave)){
    if(pwdTest(pwd1, pwd2)){
         $('#testInput').text('Cargando ..');   
        if(clave == 'vosandes'){
            $('#testInput').text('');
            $.post("http://localhost/LabVosAndes/api/public/user/",
            {   _nombre:nombre,
                _user: user,
                _password: pwd1
            },
            function(data, status){
                console.log("Data: " + data + "\nStatus: " + status);
                console.log(data)
                if(data.message == 1){
                    console.log("datos insertados con exito");
                    $('#testInput').text('Datos insertados con exito!');
                    $('#Spassword').val('');
                    $('#Spassword2').val('');
                    $('#Snombre').val('');
                    $('#Suser').val('');
                    $('#clave').val('');   
                }else{
                    console.log("error nombre de usuario ya registrado");
                    $('#testInput').text('Error nombre de usuario ya registrado')
                }
                console.log("datos recibidos");
                  
            });
        }else{
            $('#testInput').text('Clave no valida');
            console.log('Clave no valida');
        }
        
    }else{
        console.log('Las password no son iguales');
        $('#testInput').text('Las password no son iguales');
    }
    }else{
        console.log('campos sin llenar');
    }
}


function showCreateAccount(){
    $('#logIn').css('display','none');
    $('#incorrecto').css('display','none');
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

// util
function pwdTest(pwd1, pwd2){
    if(pwd1 == pwd2) return true; 
    else
        return false;
}
function inputTest(nombre, user, password, password2, clave){
    var cont = 0 ;
    if(nombre != '') cont ++;
        else {
            $('#testInput').text('Hay Campos Vacios');
             console.log('nombre esta vacio');
        } 
    if(user != '') cont ++;
        else {
            $('#testInput').text('Hay Campos Vacios');
            console.log('user esta vacio'); 
        } 
    if(password != '') cont ++;
        else {
            $('#testInput').text('Hay Campos Vacios');
            console.log('password esta vacio');
        }  
    if(password2 != '') cont ++;
        else {
            $('#testInput').text('Hay Campos Vacios');
            console.log('password2 esta vacio');
        }  
    if(clave != '') cont ++;
        else {
            $('#testInput').text('Hay Campos Vacios');
            console.log('clave esta vacio');
        }      

     if(cont == 5) {
         $('#testInput').text('');
         return true;
     }   
        else return false;


}