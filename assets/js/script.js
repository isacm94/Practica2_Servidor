function menos(id) {

    var cant = document.getElementById('cantidad[' + id + ']').value;

    if (cant > 1)
        cant--;

    document.getElementById('cantidad[' + id + ']').value = cant;
}

function mas(id) {
    document.getElementById('cantidad[' + id + ']').value ++;
}
