function comprobarReview(){
    var review = document.formularioReview.review.value;
    var puntuacion = document.formularioReview.puntuacion.value;


//Comprobar parámetros no sean null
    if(!review){
        window.alert("Has de introducir una review!");
        return 0;
    }

    if(!puntuacion){
        window.alert("Has de introducir una puntuación!");
        return 0;
    }

//review no debe tener más de 255 caracteres
    if(review.length > 255){
        window.alert("Review excesivamente larga. Inténtelo de nuevo");
        return 0;
    }

//puntuacion entre 1 y 5 estrellas

    if(puntuacion > 5 || puntuacion < 1){
        window.alert("Puntuacion no válida");
        return 0;
    }


    document.formularioReview.submit();



}
