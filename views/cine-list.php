<?php
if(isset($_SESSION))
{
    
    $currentUser= $_SESSION['loggedUser'];
    if($currentUser->getType() == 'admin')
    {
        require_once('admin-nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de cines</h2>
            <table class="table bg-light-alpha">
                <thead>
                    <th>Nombre</th>
                    <th>Capacidad</th>
                    <th>Direccion</th>
                    <th>Precio</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($cineList as $cine) {
                    ?>
                        <tr>
                            <td><?php echo $cine->getName() ?></td>
                            <td><?php echo $cine->getCapacity() ?></td>
                            <td><?php echo $cine->getadress() ?></td>
                            <td><?php echo $cine->getPrice() ?></td>                            
                            <td>
                                <form action="<?php echo FRONT_ROOT ?>cine/Delete" method="post">
                                    <button type="submit" name="<?php echo $cine->getName(); ?>" value="<?php echo $cine->getName(); ?>">
                                        <img width="20" height="20" src="<?php echo IMG_PATH?>delete.png" alt="Eliminar_Cine">
                                    </button>
                                </form>
                            </td>                            
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

    else
    {
        require_once(VIEWS_PATH.'nav.php');
        require_once(VIEWS_PATH.'login.php');
              
    }
}
?>