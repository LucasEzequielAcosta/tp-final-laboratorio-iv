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
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } $plata= 0; ?>
            <h2 class="mb-4">Comprar</h2>
            
            <table class="table bg-light-alpha table-striped">
                <thead>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Película</th>
                    <th>Dia</th>
                    <th>Horario</th>
                    <th>Cantidad de Entradas</th>
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
                            <td><?php echo $cantidad; ?></td>
                            <td><strong>$</strong><?php foreach ($salaList as $sala){
                                if($funcion->getNombreSala() == $sala->getName())
                                {    echo ($sala->getPrice() * $cantidad); $plata= $sala->getPrice() * $cantidad; }
                            }  ?></td>
                        </tr>
                    <?php
                    }
                }
                    ?>
                    </tr>
                </tbody>
            </table>

            <form action="<?php echo FRONT_ROOT ?>compra/confirmBuy" method="POST">
            <input type="hidden" name="movieName" value="<?php echo $movieName; ?>">
            <input type="hidden" name="idFunc" value="<?php echo $idFuncion; ?>">            
            <input type="hidden" name="precio" value="<?php echo $plata; ?>">                        
            <input type="hidden" name="cantidadEntradas" value="<?php echo $cantidad; ?>">
            <button type="submit" class="btn btn-success ml-3" name="confirm" value="">
                Confirmar
            </button>
            </form>
        </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
?>