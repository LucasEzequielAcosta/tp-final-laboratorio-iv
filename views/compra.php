<?php
require_once(VIEWS_PATH . "header.php");

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'client') {
        require_once(VIEWS_PATH . 'client-nav.php');
    }
}
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Comprar</h2>
            
            <table class="table bg-light-alpha">
                <thead>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Película</th>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Precio</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($funcionList as $funcion) {
                        if($idFuncion == $funcion->getIdFuncion())
                        {
                        $originalDate = $funcion->getFecha();
                        $newDate = date("d/m/Y", strtotime($originalDate));
                    ?>
                        <tr>
                            <td><?php echo $funcion->getCine() ?></td>
                            <td><?php echo $funcion->getNombreSala() ?></td>
                            <td><?php echo $movieName  ?></td>
                            <td><?php echo $newDate ?></td>
                            <td><?php echo $funcion->getHorario() ?></td>
                            <td><?php  ?></td>
                        </tr>
                    <?php
                    }
                }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
?>