
function comprobarDatosLogin(){

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if(email == null || email === ""){
        window.alert("Ha de introducir el email");
        return;
    }

    if(password == null || password === ""){
        window.alert("Ha de introducir contraseña");
        return;
    }

    if(email.length > 255){
        window.alert("Email inválido");
        return;
    }

    if(password.length > 255){
        window.alert("Contraseña inválida");
        return;
    }

    //Comprobar que el email tiene estructura algo@algo.algo
    var re = /\S+@\S+\.\S+/;
    if(!re.test(email)){
        window.alert("Introduzca un email válido");
        return 0;
    }

    document.getElementById("formularioLogin").submit();
}
