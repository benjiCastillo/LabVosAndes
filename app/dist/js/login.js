$('#signIn').css('display', 'none');
$('#ingresarLink').css('display', 'none');

function login() {
    var user = $('#user').val();
    var password = $('#password').val();

    $('#incorrecto').css('display', 'none');
    $('#correcto').css('display', 'none');
    $('#cargando').css('display', 'block');
    $.post("http://localhost/LabVosAndes/api/usuarios/auth",
        {
            user: user,
            password: password
        },
        function (data, status) {
            $('#cargando').css('display', 'none');
            if (data.error == 1) {
                $('#incorrecto').css('display', 'block');
            } else {
                $('#correcto').css('display', 'block');
                data.user = user;
                
                sessionStorage.setItem('user', JSON.stringify(data));
                window.location.href = 'app';
            }
        });
}

function saveUser() {
    var pwd1 = $('#Spassword').val();
    var pwd2 = $('#Spassword2').val();
    var nombre = $('#Snombre').val();
    var user = $('#Suser').val();
    var clave = $('#clave').val();
    if (inputTest(nombre, user, pwd1, pwd2, clave)) {
        if (pwdTest(pwd1, pwd2)) {
            $('#testInput').text('Cargando ..');
            if (clave == 'vosandes') {
                $('#testInput').text('');
                $.post("http://localhost/LabVosAndes/api/usuarios/add",
                    {
                        nombre: nombre,
                        user: user,
                        password: pwd1
                    },
                    function (data, status) {
                        if (data.error == 0) {
                            $('#testInput').text('Datos insertados con exito!');
                            $('#Spassword').val('');
                            $('#Spassword2').val('');
                            $('#Snombre').val('');
                            $('#Suser').val('');
                            $('#clave').val('');
                        } else {
                            $('#testInput').text('Error nombre de usuario ya registrado')
                        }


                    });
            } else {
                $('#testInput').text('Clave no valida');
            }

        } else {
            $('#testInput').text('Las password no son iguales');
        }
    }
}


function showCreateAccount() {
    $('#logIn').css('display', 'none');
    $('#incorrecto').css('display', 'none');
    $('#signIn').css('display', 'block');
    $('#crearLink').css('display', 'none');
    $('#ingresarLink').css('display', 'block');
}

function showLogIn() {
    $('#logIn').css('display', 'block');
    $('#signIn').css('display', 'none');
    $('#crearLink').css('display', 'block');
    $('#ingresarLink').css('display', 'none');
}

// util
function pwdTest(pwd1, pwd2) {
    return (pwd1 == pwd2) ? true : false;
}
function inputTest(nombre, user, password, password2, clave) {
    var cont = 0;
    if (nombre != '') cont++;
    else {
        $('#testInput').text('Hay Campos Vacios');

    }
    if (user != '') cont++;
    else {
        $('#testInput').text('Hay Campos Vacios');
    }
    if (password != '') cont++;
    else {
        $('#testInput').text('Hay Campos Vacios');
    }
    if (password2 != '') cont++;
    else {
        $('#testInput').text('Hay Campos Vacios');
    }
    if (clave != '') cont++;
    else {
        $('#testInput').text('Hay Campos Vacios');
    }

    if (cont == 5) {
        $('#testInput').text('');
        return true;
    }
    else return false;


}