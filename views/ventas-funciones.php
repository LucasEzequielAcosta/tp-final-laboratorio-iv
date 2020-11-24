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
            <h2 class="mb-4">Ventas por Función</h2>
            
            <table class="table bg-light-alpha table-striped">
                <thead>
                    <th>Fecha</th>
                    <th>Horario</th>                    
                    <th>Cine</th>           
                    <th>Total</th>
                    <th>Entradas Vendidas</th>
                </thead>
                <tbody>
                    <?php 
                        foreach($funcionList as $funcion)
                        {
                    ?>
                        <tr>
                            <td><?php echo $funcion->getFecha(); ?></td>
                            
                            <td><?php echo str_replace(":00", "", $funcion->getHorario()) . " hs."; ?></td>

                            <td><?php echo $funcion->getCine(); ?></td>

                            <td><?php 
                                    $total = 0;                                    
                                    $stop= 0;
                                    foreach($compraList as $compra)
                                    {
                                        $stop= 0;                                        
                                        foreach($entradaList as $entrada)
                                        {
                                            if($entrada->getFuncion() == $funcion->getIdFuncion() && $entrada->getIdCompra() == $compra->getIdCompra() && $stop!=1)
                                            {   $total+= $compra->getTotalCompra();
                                                $stop=1;
                                            }
                                        }                                        
                                    }
                                    
                                    if($total == 0)
                                    {
                                        echo '<p style="color: red;">SIN VENTAS</p>';
                                    }

                                    else
                                    {
                                        echo '<strong>$</strong>' . $total;
                                    }
                                ?></td>

                                <td><?php
                                    $cantEntradas = 0;
                                    foreach($entradaList as $entrada)
                                    {
                                        if($entrada->getFuncion() == $funcion->getIdFuncion())
                                            ++$cantEntradas;
                                    }
                                    echo $cantEntradas;
                                ?></td>
                        </tr>

                        <?php  } ?>                    
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php
require_once(VIEWS_PATH . "footer.php");
    }



    else
    {
        require_once(VIEWS_PATH.'nav.php');
        require_once(VIEWS_PATH.'login.php');
    }
    
}
?>