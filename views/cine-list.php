<?php
require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de cines</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>direccion</th>
                    <th>Precio</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($cineList as $cine) {
                    ?>
                        <tr>
                            <td><?php echo $cine->getName() ?></td>
                            <td><?php echo $cine->getCapacity() ?></td>
                            <td><?php echo $cine->getadress() ?></td>
                            <td><?php echo $cine->getPrice() ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>