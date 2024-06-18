function validarFormulario() {
    // Obtener valores de los campos
    var nombre = document.getElementById('nombre').value;
    var precio = document.getElementById('precio').value;
    var cantidad = document.getElementById('cantidad').value;

    // Variables de error
    var nombreError = document.getElementById('nombreError');
    var precioError = document.getElementById('precioError');
    var cantidadError = document.getElementById('cantidadError');

    // Inicializar las variables de validación
    var esValido = true;

    // Validar el nombre (solo letras)
    if (!/^[a-zA-Z\s]+$/.test(nombre)) {
        nombreError.classList.remove('hidden');
        esValido = false;
    } else {
        nombreError.classList.add('hidden');
    }

    // Validar el precio (número positivo)
    if (isNaN(precio) || precio <= 0) {
        precioError.classList.remove('hidden');
        esValido = false;
    } else {
        precioError.classList.add('hidden');
    }

    // Validar la cantidad (número no negativo)
    if (isNaN(cantidad) || cantidad < 0) {
        cantidadError.classList.remove('hidden');
        esValido = false;
    } else {
        cantidadError.classList.add('hidden');
    }

    // Retornar el estado de validación
    return esValido;
}
