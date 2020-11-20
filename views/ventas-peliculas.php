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
            <h2 class="mb-4">Ventas totales por Película</h2>
            
            <table class="table bg-light-alpha table-striped">
                <thead>
                    <th>Película</th>
                    <th> </th>           
                    <th>Total</th>
                </thead>
                <tbody>
                    <?php 
                        foreach($movieList as $movie)
                        {
                    ?>
                        <tr>
                            <td><?php echo $movie->getTitle(); ?></td>

                            <td></td>

                            <td><?php 
                                    $total = 0;
                                    foreach($entradaList as $entrada)
                                    {
                                        foreach($compraList as $compra)
                                        {
                                            foreach($funcionList as $funcion)
                                            {
                                                if($funcion->getIdMovie() == $movie->getId() && $entrada->getFuncion() == $funcion->getIdFuncion() && $entrada->getIdCompra() == $compra->getIdCompra())
                                                    $total+= $compra->getTotalCompra();
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