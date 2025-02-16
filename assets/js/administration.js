const options = document.querySelectorAll('.delete-team');
options.forEach(element => {
    element.addEventListener('submit', function(e){
        e.preventDefault();
        if(confirm('¿Desea eliminar el equipo seleccionado? Esta acción será irreversible')){
            element.submit();
        }
    });
});