<?php
require_once(VIEWS_PATH . "header.php");

if (isset($_SESSION)) {

    $currentUser = $_SESSION['loggedUser'];
    if ($currentUser->getType() == 'client') {
        require_once(VIEWS_PATH . 'client-nav.php');
        
    

?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
                    <?php if ($message) { ?>
                        <h3 style="color: red;"><?php echo $message ?></h3>
                    <?php } ?>
            <h2 class="mb-4">Mis Compras</h2>
            
            <table class="table bg-light-alpha table-striped">
                <thead>                    
                    <th>Película</th>
                    <th>Cine</th>
                    <th>Fecha Función</th>
                    <th>Hora Función</th>
                    <th>Costo</th>
                    <th>Fecha Compra</th>
                </thead>
                <tbody>
                    <?php
                            foreach($compraList as $compra)
                            {
                                if($compra->getUserCompra() == $currentUser->getUser())
                                {
                    ?>
                        <tr>
<!-- PELICULA -->           <td><?php 
                                     foreach($entradaList as $entrada)
                                     {
                                        if($entrada->getIdCompra() == $compra->getIdCompra())
                                        {
                                            foreach($funcionList as $funcion)
                                            {
                                                if($funcion->getIdFuncion() == $entrada->getFuncion())
                                                {
                                                    foreach($movieList as $movie)
                                                    {
                                                        if($movie->getId() == $funcion->getIdMovie())
                                                        {
                                                            $mov= $movie->getTitle();
                                                            
                                                        }
                                                    }
                                                    
                                                }
                                            }
                                            
                                        }
                                     }
                                     
                                    echo $mov;
                                ?></td>

<!-- CINE -->               <td><?php
                                    foreach($funcionList as $funcion)
                                    {
                                        if($entrada->getFuncion() == $funcion->getIdFuncion())
                                            echo $funcion->getCine();
                                    }

                                 ?></td>

<!-- FECHA FUNCION -->      <td><?php 
                                    foreach($funcionList as $funcion)
                                    {
                                        if($entrada->getFuncion() == $funcion->getIdFuncion())
                                            echo $funcion->getFecha();
                                    }
                                ?></td>

<!-- HORA FUNCION -->       <td><?php
                                    foreach($funcionList as $funcion)
                                    {
                                        if($entrada->getFuncion() == $funcion->getIdFuncion())
                                            echo str_replace(":00", "", $funcion->getHorario());
                                    }
                                ?></td>

<!-- COSTO -->              <td><strong>$</strong><?php echo $compra->getTotalCompra(); ?></td>

<!-- FECHA COMPRA -->       <td><?php echo $compra->getFechaCompra(); ?></td>
                        </tr>

                        <?php }  } ?>                    
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