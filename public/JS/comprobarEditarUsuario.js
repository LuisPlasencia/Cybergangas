function comprobarEditarUsuario(){

    var nombre = document.formularioEditarUsuario.nombre.value;
    var pass1 = document.formularioEditarUsuario.pass.value;
    var pass2 = document.formularioEditarUsuario.pass2.value;


//Comprobar parámetros no sean null
    if(!nombre){
        window.alert("Has de introducir un nombre de usuario");
        return 0;
    }

//Comprobar que el nombre tenga al menos 5 caracteres
    if(nombre.length < 5){
        window.alert("El nombre de usuario ha de tener al menos 5 caracteres");
        return 0;
    }

    if(nombre.length > 255){
        window.alert("El nombre de usuario es inválido");
        return 0;
    }


//Si va a modificar la contraseña, que ambas coincidan

    if(pass1){
        if(!pass2){
            window.alert("Has de introducir ambas contraseñas");
            return 0;
        }

        if(pass1.length > 255 || pass2.length > 255){
            window.alert("La contraseña es inválida");
            return 0;
        }

        //Comprobar que las contraseñas son iguales
        if(pass1.localeCompare(pass2)){
            window.alert("Las contraseñas no son iguales");
            return 0;
        }

        //Comprobar que la contraseña tenga 6 elementos al menos
        if(pass1.length < 6){
            window.alert("La contraseña ha de tener al menos 6 caracteres");
            return 0;
        }

    }

    document.formularioEditarUsuario.submit();
}


