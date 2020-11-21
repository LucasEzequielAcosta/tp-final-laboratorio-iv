<?php
require_once(VIEWS_PATH . "header.php");

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'admin') {
        require_once(VIEWS_PATH . 'admin-nav.php');
        require_once(VIEWS_PATH . 'sales-nav.php');
    

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } ?>
            <h2 class="mb-4">Ventas individuales de Entradas</h2>
            
            <table class="table bg-light-alpha table-striped">
                <thead>
                    <th>Cine</th>
                    <th>Sala</th>
                    <th>Película</th>
                    <th>Día de Función</th>
                    <th>Horario Función</th>

                    <th>Número de Entrada</th>
                    <th>Fecha de Compra</th>                    
                    <th>Precio</th>
                </thead>
                <tbody>
                    <?php
                    foreach($entradaList as $entrada)
                    {

                    foreach ($funcionList as $funcion) {
                        if($funcion->getIdFuncion() == $entrada->getFuncion())
                        {
                            $originalDate = $funcion->getFecha();
                            $newDate = date("d/m/Y", strtotime($originalDate));
                    ?>
                        <tr>
                            <td><?php echo $funcion->getCine() ?></td>
                            <td><?php echo $funcion->getNombreSala() ?></td>
                            <td><?php foreach($movieList as $movie) { if($movie->getId() == $funcion->getidMovie()) { echo $movie->getTitle(); }}  ?></td>
                            <td><?php echo $newDate; ?></td>
                            <td><?php echo $funcion->getHorario() ?></td>

                            <td><?php echo $entrada->getNumeroEntrada(); ?></td>
                            <td><?php foreach($compraList as $compra) { if($entrada->getIdCompra() == $compra->getIdCompra()) { echo $compra->getFechaCompra(); }} ?></td>                            
                            <td><strong>$</strong><?php foreach ($salaList as $sala){
                                if($funcion->getNombreSala() == $sala->getName())
                                {    echo $sala->getPrice(); $salita= $sala->getName(); $plata= $sala->getPrice(); }
                            }  ?></td>
                        </tr>
                    <?php
                    }
                }
                    ?>
                    </tr>

            <?php } ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");

            }
        }
?>