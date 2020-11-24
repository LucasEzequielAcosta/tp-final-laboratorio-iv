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
                    <th>Entradas</th>
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
                                    foreach($entradaList as $entrada)
                                    {
                                        if($entrada->getIdCompra() == $compra->getIdCompra())
                                        {
                                            foreach($funcionList as $funcion)
                                            {
                                                if($entrada->getFuncion() == $funcion->getIdFuncion())
                                                    $cin= $funcion->getCine();
                                            }
                                        }
                                    }

                                    echo $cin;

                                 ?></td>

<!-- FECHA FUNCION -->      <td><?php
                                    foreach($entradaList as $entrada)
                                    {
                                        if($entrada->getIdCompra() == $compra->getIdCompra())
                                        {
                                            foreach($funcionList as $funcion)
                                            {
                                                if($entrada->getFuncion() == $funcion->getIdFuncion())
                                                    $fech= $funcion->getFecha();
                                            }
                                        }
                                    }

                                    echo $fech;
                                ?></td>

<!-- HORA FUNCION -->       <td><?php
                                    foreach($entradaList as $entrada)
                                    {
                                        if($entrada->getIdCompra() == $compra->getIdCompra())
                                        {
                                            foreach($funcionList as $funcion)
                                            {
                                                if($entrada->getFuncion() == $funcion->getIdFuncion())
                                                    $tim= str_replace(":00", "", $funcion->getHorario()) . " hs.";
                                            }
                                        }
                                    }

                                    echo $tim;
                                ?></td>

<!-- CANTIDAD -->           <td><?php
                                    $cant=0;
                                    foreach($entradaList as $entrada)
                                    {
                                        if($entrada->getIdCompra() == $compra->getIdCompra())
                                        {
                                            ++$cant;
                                        }
                                    }
                                    echo $cant;
                                
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