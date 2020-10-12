<?php
require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de Peliculas Actuales</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>titulo</th>
                    <th>Descripcion</th>
                    <th>Puntaje</th>
                    <th>Generos</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($movieList as $movie) {
                    ?>
                        <tr>
                            <td><?php echo $movie->getTitle() ?></td>
                            <td><?php echo $movie->getDescription() ?></td>
                            <td><?php echo $movie->getRating() ?></td>
                            <td><?php echo $movie->getGenre() ?></td>
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


