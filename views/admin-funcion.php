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
            <table class="table bg-light-alpha">
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
                                        <img width="20" height="20" src="<?php echo IMG_PATH ?>delete.png" alt="Eliminar_Cine">
                                    </button>
                                </form>

                                <button onclick="openNav<?php echo $funcion->getIdFuncion(); ?>()">
                                    <img width="20" height="20" src="<?php echo IMG_PATH ?>modify.png" alt="Modificar_Cine">
                                </button>

                                <div id="myNav<?php echo $funcion->getIdFuncion(); ?>" class="overlay">
                                    <a href="javascript:void(0)" class="closebtn" onclick="closeNav<?php echo $funcion->getIdFuncion(); ?>()">&times;</a>
                                    <div class="overlay-content">
                                        <h1 style="color:white"><strong>Modificar Funcion</strong></h1>
                                        <form action="<?php echo FRONT_ROOT ?>funcion/Modify" method="post">
                                            <section id="listado" class="mb-5">
                                                <div class="container">
                                                    <input type="hidden" name="idFuncion" value="<?php echo $funcion->getIdFuncion(); ?>">

                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label style="color:white" for="">Cine</label>
                                                                <input type="text" name="cine" value="<?php echo $funcion->getCine(); ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label style="color:white" for="">Sala</label>
                                                                <input type="text" name="sala" value="<?php echo $funcion->getNombreSala(); ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label style="color:white" for="">Pelicula</label>
                                                                <input type="text" name="pelicula" value="<?php echo $this->movieDao->getMovieById($funcion->getIdMovie())->getTitle(); ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group">
                                                                <label style="color:white" for="">Fecha</label>
                                                                <input type="text" name="fecha" value="<?php echo $funcion->getHorario(); ?>" class="form-control" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button type="submit" name="button" class="btn btn-dark ml-auto d-block" onclick="closeNav<?php echo $funcion->getIdFuncion(); ?>()" href="javascript:void(0)">Modificar</button>
                                                </div>
                                            </section>
                                        </form>
                                    </div>
                                </div>

                                <script>
                                    function openNav<?php echo $funcion->getIdFuncion(); ?>() {
                                        document.getElementById("myNav<?php echo $funcion->getIdFuncion(); ?>").style.width = "100%";
                                    }

                                    function closeNav<?php echo $funcion->getIdFuncion(); ?>() {
                                        document.getElementById("myNav<?php echo $funcion->getIdFuncion(); ?>").style.width = "0%";
                                    }
                                </script>
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