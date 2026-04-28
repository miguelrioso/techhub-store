document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".form-agregar").forEach(form => {

        form.addEventListener("submit", function(e) {
            e.preventDefault();

            let datos = new FormData(this);

            fetch(window.location.href, {
                method: "POST",
                body: datos
            })
            .then(response => response.text())
            .then(() => {
                // en vez de reload, volvemos a cargar limpio
                window.location.href = window.location.href;
            })
            .catch(error => console.log(error));
        });

    });

});