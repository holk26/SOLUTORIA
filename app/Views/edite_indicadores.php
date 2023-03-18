<?php
//var_dump($dataI);
?>

<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

<div class="container">
    <h2>Modo edicion</h2>
    <div class="mb-3"></div>

    <table id="myTable" class="table display table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>id</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Unidad de medida</th>
                <th>Fecha</th>
                <th>Valor</th>
                <th>Accion</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($dataI as $index => $indicador) : ?>
                <tr id="fila-<?php echo $index; ?>">
                    <td><?php echo $indicador['id']; ?></td>
                    <td class="editable"><?php echo $indicador['codigo']; ?></td>
                    <td class="editable"><?php echo $indicador['nombre']; ?></td>
                    <td class="editable"><?php echo $indicador['unidad_medida']; ?></td>
                    <td class="editable"><?php echo $indicador['fecha']; ?></td>
                    <td class="editable"><?php echo $indicador['valor']; ?></td>
                    <td>
                        <button type="button" class="btn btn-primary btn-sm btn-editar" data-id="<?php echo $index; ?>">Editar</button>
                        <button type="button" class="btn btn-danger btn-sm btn-eliminar">Eliminar</button>
                    </td>
                </tr>
            <?php endforeach; ?>

        </tbody>
    </table>
    </main>
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="..." class="rounded me-2" alt="...">
                <strong class="me-auto">SOLUTORIA</strong>
                <small>11 mins ago</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                OK
            </div>
        </div>
    </div>

    <script>
        const btnsEditar = document.querySelectorAll('.btn-editar');
        btnsEditar.forEach(btn => {
            let editando = false;
            btn.addEventListener('click', () => {
                const fila = btn.closest('tr');
                const inputsEditables = fila.querySelectorAll('.editable');

                if (editando) {
                    // Obtener los datos de la fila
                    const id = fila.querySelector('td:first-child').innerText;
                    const codigo = fila.querySelector('.editable:nth-child(2)').innerText;
                    const nombre = fila.querySelector('.editable:nth-child(3)').innerText;
                    const unidad_medida = fila.querySelector('.editable:nth-child(4)').innerText;
                    const fecha = fila.querySelector('.editable:nth-child(5)').innerText;
                    const valor = fila.querySelector('.editable:nth-child(6)').innerText;

                    // Enviar una solicitud POST Ajax con los datos de la fila
                    const url = '<?php echo base_url('Editar/create'); ?>';
                    const data = {
                        id,
                        codigo,
                        nombre,
                        unidad_medida,
                        fecha,
                        valor
                    };
                    $.post(url, data, function(data) {
                            mostrarMensaje("Actualizacion completa.");
                        })
                        .fail(function(xhr, status, error) {
                            mostrarMensaje("Error al enviar la solicitud: " + status);
                        });

                    // Cambiar el botón "Actualizar" a "Editar"
                    btn.innerText = 'Editar';
                    btn.classList.replace('btn-success', 'btn-primary');

                    // Hacer que las celdas editables no sean editables
                    inputsEditables.forEach(input => {
                        input.contentEditable = false;
                        input.classList.remove('bg-light');
                    });
                } else {
                    // Cambiar el botón "Editar" a "Actualizar"
                    btn.innerText = 'Actualizar';
                    btn.classList.replace('btn-primary', 'btn-success');

                    // Hacer que las celdas editables sean editables
                    inputsEditables.forEach(input => {
                        input.contentEditable = true;
                        input.classList.add('bg-light');
                    });
                }

                editando = !editando;
            });
        });


        // Obtener todos los botones "Eliminar" y agregar un controlador de eventos de clic
        const btnsEliminar = document.querySelectorAll('.btn-eliminar');
        btnsEliminar.forEach(btn => {
            btn.addEventListener('click', () => {
                const fila = btn.closest('tr');
                const id = fila.querySelector('td:first-child').innerText;

                // Preguntar al usuario si está seguro de eliminar
                const confirmacion = confirm("¿Estás seguro de que quieres eliminar este registro?");

                if (confirmacion) {
                    // Enviar una solicitud POST Ajax con el ID de la fila
                    const url = '<?php echo base_url('Editar/delete'); ?>';
                    const data = {
                        id
                    };
                    $.post(url, data, function(data) {
                            console.log(data);
                            mostrarMensaje("Eliminación completa.");
                            // Eliminar la fila
                            fila.remove();
                        })
                        .fail(function(xhr, status, error) {
                            console.log("Error al enviar la solicitud: " + status);
                        });
                }
            });
        });



        let table = new DataTable('#myTable', {
            responsive: true
        });

        function editeIndicadorById(id) {
            alert("Vas a editar: " + id);
        }

        function eliminarIndicadorById(id) {
            alert("Vas a eliminar: " + id);
        }

        function mostrarMensaje(mensaje) {
            // Obtener el elemento con la clase "toast-body"
            const toastBody = $('.toast-body');

            // Actualizar el contenido del elemento con el mensaje recibido como argumento
            toastBody.text(mensaje);

            // Mostrar el elemento toast
            $('#liveToast').toast('show');
        }
    </script>
</div>