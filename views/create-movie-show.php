<?php
require_once(VIEWS_PATH . "header.php");

session_start();

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'admin') {
        require_once('admin-nav.php');
?>
        <main class="py-5">
            <section id="listado" class="mb-5">
                <div class="container">
                    <h2 class="mb-4">Crear Funcion de la pelicula <?php echo $title ?>

                        <h3>Selecionar Sala</h3>

                        <table class="table bg-light-alpha">
                            <thead>
                                <th>Cine</th>
                                <th>Sala</th>
                                <th>Dia</th>
                                <th>Horario</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($salaList as $sala) {
                                ?>
                                    <tr>
                                        <td><?php echo $sala->getCine() ?></td>
                                        <td><?php echo $sala->getName() ?></td>
                                        <form action="<?php echo FRONT_ROOT ?>funcion/addMovieShow" method="POST">
                                            <td>
                                                <input type="date" class="form-control" name="date" required>
                                            </td>
                                            <td>
                                                <input type="time" max="23:00" min="12:00" class="form-control" name="time" required>
                                            </td>
                                                <input type="hidden" class="form-control" name="idMovie" value="<?php echo $idMovie; ?>" required>
                                                <input type="hidden" class="form-control" name="cine" value="<?php echo $sala->getCine(); ?>" required>
                                            <td>
                                                <button type="submit" name="nombreSala" value="<?php echo $sala->getName(); ?>" class="btn btn-success ml-3">Crear Funcion</button>
                                            </td>
                                        </form>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>

                </div>
            </section>
        </main>

<?php

    } else {
        require_once(VIEWS_PATH . 'nav.php');
        //require_once(VIEWS_PATH.'login.php');         
    }

    require_once(VIEWS_PATH . "footer.php");
}
?>