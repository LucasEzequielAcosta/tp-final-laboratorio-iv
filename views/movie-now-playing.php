<?php

session_start();
if(isset($_SESSION))
{
    
    $currentUser= $_SESSION['loggedUser'];
    if($currentUser->getType() == 'admin')
    {
        require_once('admin-nav.php');
    }

    elseif($currentUser->getType() == 'client')
    {
        require_once('client-nav.php');
    }
    
 




?>
<main class="py-5">
    <div class="container">
        <div class="form-group">
        <strong>Buscar por Género</strong>:
        <div class="btn-group">
                <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Seleccionar...
                </button>
                <div class="dropdown-menu">
                    
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>    

                    
                </div>

                
            </div>            
        </div>
        <br>
        <strong>Buscar por Fecha</strong>: <input type="text" id="datepicker">

        
    </div>
    
    <br><br>
    <section id="listado" class="mb-5">
    
        <div class="container">
            <h2 class="mb-4">Listado de Peliculas Actuales</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>titulo</th>
                    <th>Descripcion</th>
                    <th>Puntaje</th>
                    <th>Generos</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($movieList as $movie) {
                    ?>
                        <tr>
                            <td><?php echo $movie->getTitle() ?></td>
                            <td><?php echo $movie->getDescription() ?></td>
                            <td><?php echo $movie->getRating() ?></td>
                            <td><?php echo $movie->getGenre() ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</main>


<?php
}
?>