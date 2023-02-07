document.addEventListener("DOMContentLoaded", function() {
    const table = document.querySelector('#tableServicios'); 
    
    table.addEventListener('click', function (e) {

        console.log(e.target.parentElement);
        if(e.target.tagName === 'TD'){
            window.location.href = `/servicios/servicio?id=${e.target.parentElement.dataset.id}`;
        }
    });
});