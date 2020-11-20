<?php
require_once(VIEWS_PATH . "header.php");

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'admin') {
        require_once('admin-nav.php');
    }
}
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <?php if ($message) { ?>
                <h3 style="color: red;"><?php echo $message ?></h3>
            <?php } ?>
            <h2 class="mb-4">Listado de Funciones</h2>
            <table class="table bg-light-alpha table-striped">
                <thead>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Película</th>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($funcionList as $funcion) {
                        $originalDate = $funcion->getFecha();
                        $originalHour = $funcion->getHorario();
                    ?>
                        <tr>
                            <td><?php echo $funcion->getCine() ?></td>
                            <td><?php echo $funcion->getNombreSala() ?></td>
                            <td><?php echo $this->movieDao->getMovieById($funcion->getIdMovie())->getTitle();  ?></td>
                            <td><?php echo date("d/m/Y", strtotime($originalDate)); ?></td>
                            <td><?php echo date("H:i A", strtotime($originalHour)); ?></td>
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>funcion/Delete" method="post">
                                    <button type="submit" name="<?php echo $funcion->getIdFuncion(); ?>" value="<?php echo $funcion->getIdFuncion(); ?>">
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>delete.png" alt="Eliminar_Funcion">
                                    </button>
                                </form>                                
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <button class="btn btn-success ml-3">
                <a class="link" href="<?php echo FRONT_ROOT ?>movie/showNowPlayingView" style="color:white">Agregar mas funciones</a>
            </button>
        </div>
    </section>
</main>



<?php



require_once(VIEWS_PATH . "footer.php");


?>