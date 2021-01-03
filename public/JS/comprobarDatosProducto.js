
function comprobarDatosProducto(){

    var nombreProducto = document.getElementById("nombreProducto").value;
    var descripcion = document.getElementById("descripcion").value;
    var precio = document.getElementById("precio").value;
    var imagen = document.getElementById('imagen').value;
    var descuentoActivo = document.getElementById('descuentoActivo').value;


    if(nombreProducto == null || nombreProducto === ""){
        window.alert("Ha de introducir nombre de producto");
        return;
    }

    if(descripcion == null || descripcion === ""){
        window.alert("Ha de introducir descripcion del producto");
        return;
    }

    if(precio == null || precio === ""){
        window.alert("Ha de introducir precio");
        return;
    }

    if(precio == null || precio === ""){
        window.alert("Ha de seleccionar una imagen");
        return;
    }

    if(descuentoActivo == null || descuentoActivo === ""){
        window.alert("Ha de seleccionar descuento Activo o no");
        return;
    }


    if(nombreProducto.length > 255){
        window.alert("Nombre inválido");
        return;
    }
    if(descripcion.length > 255){
        window.alert("Descripción inválida");
        return;
    }
    if(precio.length > 255){
        window.alert("Precio inválido");
        return;
    }
    if(imagen.length > 255){
        window.alert("Imagen inválida");
        return;
    }
    if(descuentoActivo.length > 255){
        window.alert("Descuento Activo no válido");
        return;
    }

    if(precio < 0){
        window.alert("Precio inválido");
        return;
    }

    if(descuentoActivo < 0 || descuentoActivo > 1){
        window.alert("Descuento Activo no válido");
        return;
    }


    document.getElementById("formularioAddProduct").submit();

}
