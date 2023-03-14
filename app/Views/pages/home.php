<h4>Home</h4>
<script>
    $.ajax({
   url: "procesar_ajax",
   type: "POST",
   data: { parametro1: valor1, parametro2: valor2 },
   success: function(resultado) {
      // Manejar los datos devueltos por la función procesar_ajax()
   },
   error: function(jqXHR, textStatus, errorThrown) {
      // Manejar errores aquí
   }
});
</script>