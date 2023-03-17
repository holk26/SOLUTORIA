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

    <script>
        // Obtener todos los botones "Editar" y agregar un controlador de eventos de clic
        const btnsEditar = document.querySelectorAll('.btn-editar');
        btnsEditar.forEach(btn => {
            btn.addEventListener('click', () => {
                const fila = btn.closest('tr');
                const inputsEditables = fila.querySelectorAll('.editable');

                // Cambiar el botón "Editar" a "Actualizar"
                btn.innerText = 'Actualizar';
                btn.classList.replace('btn-primary', 'btn-success');

                // Hacer que las celdas editables sean editables
                inputsEditables.forEach(input => {
                    input.contentEditable = true;
                    input.classList.add('bg-light');
                });

                // Agregar un controlador de eventos de clic al botón "Actualizar"
                btn.addEventListener('click', () => {
                    // Obtener los datos de la fila
                    const id = fila.querySelector('td:first-child').innerText;
                    const codigo = fila.querySelector('.editable:nth-child(2)').innerText;
                    const nombre = fila.querySelector('.editable:nth-child(3)').innerText;
                    const unidad_medida = fila.querySelector('.editable:nth-child(4)').innerText;
                    const fecha = fila.querySelector('.editable:nth-child(5)').innerText;
                    const valor = fila.querySelector('.editable:nth-child(6)').innerText;

                    // Enviar una solicitud POST Ajax con los datos de la fila
                    const url = '/editar/editaFila';
                    const data = {
                        id,
                        codigo,
                        nombre,
                        unidad_medida,
                        fecha,
                        valor
                    };
                    fetch(url, {
                            method: 'POST',
                            body: JSON.stringify(data),
                            headers: {
                                'Content-Type': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => console.log(data))
                        .catch(error => console.error(error));

                    // Cambiar el botón "Actualizar" a "Editar"
                    btn.innerText = 'Editar';
                    btn.classList.replace('btn-success', 'btn-primary');

                    // Hacer que las celdas editables no sean editables
                    inputsEditables.forEach(input => {
                        input.contentEditable = false;
                        input.classList.remove('bg-light');
                    });
                });
            });
        });

        // Obtener todos los botones "Eliminar" y agregar un controlador de eventos de clic
        const btnsEliminar = document.querySelectorAll('.btn-eliminar');
        btnsEliminar.forEach(btn => {
            btn.addEventListener('click', () => {
                const fila = btn.closest('tr');

                // Eliminar la fila
                fila.remove();
            });
        });
        /*
        $(document).ready(function() {
            $('.btn-editar').on('click', function() {
                var fila_id = $(this).data('id');
                var fila = $('#fila-' + fila_id);

                fila.find('.editable').each(function() {
                    var contenido = $(this).html();
                    $(this).html('<input type="text" class="form-control" value="' + contenido + '">');
                });

                $(this).text('Actualizar');
            });
        });
        */
        let table = new DataTable('#myTable', {
            responsive: true
        });

        function editeIndicadorById(id) {
            alert("Vas a editar: " + id);
        }

        function eliminarIndicadorById(id) {
            alert("Vas a eliminar: " + id);
        }
    </script>
</div>