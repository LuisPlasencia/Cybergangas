
function comprobarDatosRegister(){

    var nombre = document.getElementById("nombre").value;
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("password2").value;
    var email = document.getElementById("email").value;
    var aceptarPolitica = document.getElementById("aceptarPolitica");
    var recibirNovedades = document.getElementById("recibirNovedades");


    if(nombre == null || nombre === ""){
        window.alert("Debe introducir un nombre de usuario");
        return;
    }

    if(email == null || email === ""){
        window.alert("Debe introducir email");
        return;
    }

    if(pass1 == null || pass1 === ""){
        window.alert("Debe introducir contraseña");
        return;
    }

    //Comprobar que la contraseña tenga 6 elementos al menos
    if(pass1.length < 6){
        window.alert("La contraseña ha de tener al menos 6 caracteres");
        return 0;
    }

    if(pass2 == null || pass2 === ""){
        window.alert("Debe introducir la segunda contraseña");
        return;
    }

    if(pass1 !== pass2){
        window.alert("Las contraseñas no coinciden");
        return;
    }

    if(!aceptarPolitica.checked) {
        window.alert("Tiene que aceptar la pólitica");
        return;
    }

    //Comprobar que el email tiene estructura algo@algo.algo
    var re = /\S+@\S+\.\S+/;
    if(!re.test(email)){
        window.alert("Introduzca un email válido");
        return 0;
    }

    //Comprobar que el nombre tenga al menos 5 caracteres
    if(nombre.length < 5){
        window.alert("El nombre de usuario ha de tener al menos 5 caracteres");
        return 0;
    }

    if(nombre.length > 255){
        window.alert("Introduzca un nombre válido");
        return 0;
    }
    if(pass1.length > 255){
        window.alert("Introduzca una contraseña válida");
        return 0;
    }
    if(pass2.length > 255){
        window.alert("Introduzca una contraseña válida");
        return 0;
    }
    if(email.length > 255){
        window.alert("Introduzca un email válido");
        return 0;
    }


    document.getElementById("formularioRegister").submit();

}

