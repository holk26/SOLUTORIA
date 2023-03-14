<main>
    <h1>Datos</h1>
    <p id="token"><?= esc($token["token"]) ?></p>
    <p>El token expira: <?= esc($token["expiracion"]) ?></p>
    <a href="mailto:foo@bar.com">mail</a>
    <a href="http://hola.com" target="_blank" rel="noopener noreferrer">dfdf</a>
		<!-- Contenido principal de la página -->
</main>
<script>
        // Definir la URL de la API y el Token de acceso
var url = "https://postulaciones.solutoria.cl/api/indicadores";
var token = "<?= esc($token["token"]) ?>";

// Crear un objeto XMLHttpRequest
var xhr = new XMLHttpRequest();

// Configurar la solicitud GET a la API
xhr.open("GET", url, true);
xhr.setRequestHeader("Authorization", token);

// Definir la función a ejecutar cuando se reciba la respuesta
xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
        if (xhr.status === 200) {
            // La solicitud fue exitosa
            var data = JSON.parse(xhr.responseText);  // Convertir la respuesta a un objeto JavaScript
            console.log(data);  // Imprimir la respuesta en la consola
        } else {
            // La solicitud falló
            console.log("Error al realizar la solicitud:", xhr.status);
        }
    }
};

// Enviar la solicitud GET a la API
xhr.send();


</script>