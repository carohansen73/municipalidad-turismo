document.addEventListener("DOMContentLoaded", (event) => {
    event.preventDefault;

    console.log("entro js");
    let serviceSelect =  document.getElementById("serviceSelect");
    console.log(serviceSelect);

    serviceSelect.addEventListener('change', function () {
        console.log("entro func");
        let serviceId = this.value;

        console.log(serviceId);

        // Limpio el select de amenities antes de hacer la petición
        let amenitiesSelect = document.getElementById('amenitiesSelect');
        amenitiesSelect.innerHTML = "";

        if(serviceId){
            //hago la solicitud AJAX y me traigo la samenities
            fetch('/amenities/'+serviceId)

                .then(response => response.json())
                .then(data => {
                    //creo a sopciones del select en base al servicio seleccionado
                    data.forEach(amenity => {
                        let option = document.createElement('option');
                        option.value = amenity.id;
                        option.text = amenity.name
                        amenitiesSelect.appendChild(option);
                    });
                });
               // .catch(error => console.error('Error: ', error));

        }
    })
});
